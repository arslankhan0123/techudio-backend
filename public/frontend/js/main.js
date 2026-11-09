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

      // Send the form data to your backend here, then show the confirmation.
      bootstrap.Modal.getOrCreateInstance(document.getElementById('thankYouModal')).show()
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
          render()
        })
        item.appendChild(name)
        item.appendChild(remove)
        list.appendChild(item)
      })
      list.hidden = files.length === 0
    }

    function add(fileList) {
      if (!fileList || !fileList.length) return
      files = files.concat(Array.prototype.slice.call(fileList))
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
