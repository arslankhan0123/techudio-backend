<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuoteRequestController extends Controller
{
    public function index(Request $request)
    {
        $quotes = QuoteRequest::query()
            ->when($request->search, fn ($q, $s) => $q->where(fn ($q) => $q
                ->where('full_name', 'like', "%{$s}%")
                ->orWhere('email', 'like', "%{$s}%")
                ->orWhere('company', 'like', "%{$s}%")))
            ->when($request->status === 'unread', fn ($q) => $q->unread())
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.quotes.index', compact('quotes'));
    }

    public function show(QuoteRequest $quote)
    {
        if (! $quote->read_at) {
            $quote->update(['read_at' => now()]);
        }

        return view('admin.quotes.show', compact('quote'));
    }

    public function download(QuoteRequest $quote, int $index)
    {
        $file = $quote->attachments[$index] ?? abort(404);

        return Storage::download($file['path'], $file['name']);
    }

    public function destroy(QuoteRequest $quote)
    {
        foreach ($quote->attachments ?? [] as $file) {
            Storage::delete($file['path']);
        }
        $quote->delete();

        return redirect()->route('admin.quotes.index')->with('success', 'Quote request deleted.');
    }
}
