/* Techudio — form validation, thank-you overlay and file upload.
   Navbar, FAQ and "+N more" toggles are plain Bootstrap collapse (no code here). */
;(function () {
  'use strict'

  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

  /* Returns the error message for a field, or an empty string when it is valid */
  function errorFor(field) {
    if (field.type === 'checkbox') {
      return field.required && !field.checked ? field.dataset.errorRequired : ''
    }
    var value = field.value.trim()
    if (field.required && !value) return field.dataset.errorRequired
    if (field.type === 'email' && value && !emailPattern.test(value)) return field.dataset.errorInvalid
    return ''
  }

  function showError(field, message) {
    if (field.type === 'checkbox') return
    field.classList.toggle('is-invalid', Boolean(message))
    var feedback = field.parentElement.querySelector('.invalid-feedback')
    if (feedback) feedback.textContent = message
  }

  /* The two consent checkboxes share one message under the list */
  function showConsentError(form) {
    var slot = form.querySelector('[data-consent-error]')
    if (!slot) return
    var failing = Array.prototype.filter.call(
      form.querySelectorAll('input[type="checkbox"][required]'),
      function (box) {
        return !box.checked
      },
    )[0]
    slot.textContent = failing ? failing.dataset.errorRequired : ''
    slot.hidden = !failing
  }

  /* ---------- AJAX submit + SweetAlert ---------- */
  var MULTI = ['services', 'assets', 'communication']

  function swal(options) {
    if (!window.Swal) { alert(options.text || options.title); return Promise.resolve() }
    return Swal.fire(Object.assign({
      background: '#0d0d1a',
      color: '#e2e8f0',
      confirmButtonColor: '#7c3aed',
      iconColor: options.icon === 'error' ? '#f43f5e' : '#a78bfa',
    }, options))
  }

  function buildFormData(form) {
    var data = new FormData()
    new FormData(form).forEach(function (value, key) {
      if (value instanceof File) return // files are added from the dropzone below
      data.append(MULTI.indexOf(key) !== -1 ? key + '[]' : key, value)
    })
    var dropzone = form.querySelector('[data-dropzone]')
    if (dropzone && dropzone._files) {
      dropzone._files.forEach(function (file) { data.append('files[]', file) })
    }
    return data
  }

  function showServerErrors(form, errors) {
    var first = null
    Object.keys(errors).forEach(function (key) {
      var name = key.split('.')[0]
      var field = form.querySelector('[name="' + name + '"]')
      if (field && field.type !== 'checkbox' && field.type !== 'radio') {
        showError(field, errors[key][0])
        if (!first) first = field
      }
    })
    if (first) first.focus()
    var list = Object.keys(errors).map(function (k) { return '• ' + errors[k][0] }).join('<br>')
    swal({ icon: 'error', title: 'Please check the form', html: list })
  }

  function resetForm(form) {
    form.reset()
    var dropzone = form.querySelector('[data-dropzone]')
    if (dropzone && dropzone._reset) dropzone._reset()
  }

  function submitForm(form) {
    var button = form.querySelector('[type="submit"]')
    var label = button ? button.innerHTML : ''
    if (button) { button.disabled = true; button.innerHTML = 'Sending…' }

    fetch(form.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'X-Requested-With': 'XMLHttpRequest',
        Accept: 'application/json',
      },
      body: buildFormData(form),
    })
      .then(function (response) {
        return response.json().catch(function () { return {} }).then(function (body) {
          return { ok: response.ok, status: response.status, body: body }
        })
      })
      .then(function (res) {
        if (res.ok) {
          resetForm(form)
          return swal({
            icon: 'success',
            title: form.id === 'quoteForm' ? 'Quote request received!' : 'Message sent!',
            text: res.body.message,
            confirmButtonText: 'Great',
          })
        }
        if (res.status === 422 && res.body.errors) return showServerErrors(form, res.body.errors)
        if (res.status === 429) return swal({ icon: 'error', title: 'Too many attempts', text: 'Please wait a minute and try again.' })
        if (res.status === 419) return swal({ icon: 'error', title: 'Session expired', text: 'Please refresh the page and try again.' })
        swal({ icon: 'error', title: 'Something went wrong', text: res.body.message || 'Please try again in a moment.' })
      })
      .catch(function () {
        swal({ icon: 'error', title: 'Network error', text: 'Check your connection and try again.' })
      })
      .finally(function () {
        if (button) { button.disabled = false; button.innerHTML = label }
      })
  }

  function setUpForm(form) {
    var fields = form.querySelectorAll('[required], [data-error-invalid]')

    form.addEventListener('submit', function (event) {
      event.preventDefault()
      var firstInvalid = null
      fields.forEach(function (field) {
        var message = errorFor(field)
        showError(field, message)
        if (message && !firstInvalid) firstInvalid = field
      })
      showConsentError(form)

      if (firstInvalid) {
        firstInvalid.focus()
        return
      }

      submitForm(form)
    })

    // Clear a field's error as soon as the visitor edits it
    fields.forEach(function (field) {
      field.addEventListener(field.type === 'checkbox' || field.tagName === 'SELECT' ? 'change' : 'input', function () {
        if (field.type === 'checkbox') {
          var slot = form.querySelector('[data-consent-error]')
          if (slot && !slot.hidden) showConsentError(form)
        } else {
          showError(field, '')
        }
      })
    })
  }

  /* Drag-and-drop file picker: lists the chosen files and lets each be removed */
  function setUpDropzone(dropzone) {
    var zone = dropzone.querySelector('.dropzone__zone')
    var input = dropzone.querySelector('input[type="file"]')
    var list = dropzone.querySelector('.dropzone__files')
    var files = []

    function render() {
      list.textContent = ''
      files.forEach(function (file, index) {
        var item = document.createElement('li')
        var name = document.createElement('span')
        var remove = document.createElement('button')
        name.textContent = file.name
        remove.type = 'button'
        remove.textContent = 'Remove'
        remove.addEventListener('click', function () {
          files.splice(index, 1)
          dropzone._files = files
          render()
        })
        item.appendChild(name)
        item.appendChild(remove)
        list.appendChild(item)
      })
      list.hidden = files.length === 0
    }

    dropzone._files = files
    dropzone._reset = function () { files = []; dropzone._files = files; render() }

    function add(fileList) {
      if (!fileList || !fileList.length) return
      files = files.concat(Array.prototype.slice.call(fileList))
      dropzone._files = files
      render()
    }

    zone.addEventListener('click', function () {
      input.click()
    })
    zone.addEventListener('dragover', function (event) {
      event.preventDefault()
      zone.classList.add('is-dragging')
    })
    zone.addEventListener('dragleave', function () {
      zone.classList.remove('is-dragging')
    })
    zone.addEventListener('drop', function (event) {
      event.preventDefault()
      zone.classList.remove('is-dragging')
      add(event.dataTransfer.files)
    })
    input.addEventListener('change', function () {
      add(input.files)
      input.value = ''
    })
  }

  document.querySelectorAll('#quoteForm, #contactForm').forEach(setUpForm)
  document.querySelectorAll('[data-dropzone]').forEach(setUpDropzone)
})()


// Sticky header: add a shadow once the page is scrolled
;(function () {
  var header = document.querySelector('.site-header')
  if (!header) return
  var onScroll = function () { header.classList.toggle('is-scrolled', window.scrollY > 8) }
  window.addEventListener('scroll', onScroll, { passive: true })
  onScroll()
})()


// Scroll-reveal: sections and cards fade/slide in as they enter the viewport
;(function () {
  if (!('IntersectionObserver' in window)) return
  var selectors = ['main > section', '.service-card', '.step-card', '.work-card', '.faq-card', '.testimonial-card',
    '.stats__item', '.contact-card', '.quote-card', '.cta-banner', '.site-footer__inner']
  var seen = new Set(), targets = []
  selectors.forEach(function (sel) {
    document.querySelectorAll(sel).forEach(function (el) { if (!seen.has(el)) { seen.add(el); targets.push(el) } })
  })
  var counts = new Map()
  targets.forEach(function (el) {
    var n = counts.get(el.parentElement) || 0
    counts.set(el.parentElement, n + 1)
    el.style.setProperty('--tq-delay', Math.min(n, 6) * 90 + 'ms')
    el.classList.add('tq-reveal')
  })
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) return
      entry.target.classList.add('is-visible')
      io.unobserve(entry.target)
    })
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' })
  targets.forEach(function (el) { io.observe(el) })
})()


// Real-time card effects: per-card rhythm, light sweep, cursor spotlight and 3D tilt
;(function () {
  var cards = document.querySelectorAll('.service-card, .step-card, .work-card, .testimonial-card, .faq-card, .stats__item')
  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches
  cards.forEach(function (card, i) {
    card.style.setProperty('--tq-bob', (5 + (i % 4) * 0.8) + 's')
    card.style.setProperty('--tq-bob-delay', (-(i * 0.9) % 6) + 's')
    if (reduce) return
    if (!card.matches('.faq-card, .stats__item')) {
      var shine = document.createElement('span'); shine.className = 'tq-shine'; card.appendChild(shine)
    }
    var spot = document.createElement('span'); spot.className = 'tq-spot'; card.appendChild(spot)
    card.classList.add('tq-tilt')
    var strength = card.matches('.faq-card') ? 3 : 8
    card.addEventListener('pointermove', function (e) {
      var r = card.getBoundingClientRect()
      var x = (e.clientX - r.left) / r.width
      var y = (e.clientY - r.top) / r.height
      card.style.setProperty('--mx', x * 100 + '%')
      card.style.setProperty('--my', y * 100 + '%')
      card.style.setProperty('--ry', ((x - 0.5) * strength * 2).toFixed(2) + 'deg')
      card.style.setProperty('--rx', ((0.5 - y) * strength * 2).toFixed(2) + 'deg')
    })
    card.addEventListener('pointerleave', function () {
      card.style.setProperty('--rx', '0deg'); card.style.setProperty('--ry', '0deg')
    })
  })
})()


// Count-up numbers in the stats section when they scroll into view (e.g. "500+", "99.9%", "50M+")
;(function () {
  var els = document.querySelectorAll('.stats__value')
  if (!els.length || !('IntersectionObserver' in window)) return
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) return
      io.unobserve(entry.target)
      var el = entry.target
      var m = el.textContent.trim().match(/^([^\d]*)([\d.,]+)(.*)$/)
      if (!m) return
      var target = parseFloat(m[2].replace(/,/g, ''))
      var decimals = (m[2].split('.')[1] || '').length
      var start = performance.now(), dur = 1800
      function tick(now) {
        var p = Math.min((now - start) / dur, 1)
        var eased = 1 - Math.pow(1 - p, 3)
        el.textContent = m[1] + (target * eased).toFixed(decimals) + m[3]
        if (p < 1) requestAnimationFrame(tick)
      }
      requestAnimationFrame(tick)
    })
  }, { threshold: 0.5 })
  els.forEach(function (el) { io.observe(el) })
})()
