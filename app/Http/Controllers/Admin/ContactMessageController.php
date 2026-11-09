<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = ContactMessage::query()
            ->when($request->search, fn ($q, $s) => $q->where(fn ($q) => $q
                ->where('full_name', 'like', "%{$s}%")
                ->orWhere('email', 'like', "%{$s}%")
                ->orWhere('company', 'like', "%{$s}%")))
            ->when($request->status === 'unread', fn ($q) => $q->unread())
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.contacts.index', compact('messages'));
    }

    public function show(ContactMessage $contact)
    {
        if (! $contact->read_at) {
            $contact->update(['read_at' => now()]);
        }

        return view('admin.contacts.show', ['message' => $contact]);
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Message deleted.');
    }
}
