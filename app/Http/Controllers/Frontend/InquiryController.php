<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\QuoteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function storeQuote(Request $request): JsonResponse
    {
        $data = $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:100'],
            'services' => ['nullable', 'array'],
            'services.*' => ['string', 'max:255'],
            'otherServices' => ['nullable', 'string', 'max:5000'],
            'projectType' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:10000'],
            'assets' => ['nullable', 'array'],
            'assets.*' => ['string', 'max:255'],
            'budget' => ['nullable', 'string', 'max:100'],
            'timeline' => ['nullable', 'string', 'max:100'],
            'communication' => ['nullable', 'array'],
            'communication.*' => ['string', 'max:100'],
            'nda' => ['nullable', 'string', 'max:50'],
            'details' => ['nullable', 'string', 'max:10000'],
            'files' => ['nullable', 'array', 'max:10'],
            'files.*' => ['file', 'max:10240', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,png,jpg,jpeg,gif,webp,svg,zip,fig'],
            'agreeContact' => ['accepted'],
            'agreePrivacy' => ['accepted'],
        ], [
            'agreeContact.accepted' => 'Please agree to be contacted.',
            'agreePrivacy.accepted' => 'Please accept the privacy policy.',
        ]);

        $attachments = [];
        foreach ($request->file('files', []) as $file) {
            $attachments[] = [
                'name' => $file->getClientOriginalName(),
                'path' => $file->store('quote-attachments'),
                'size' => $file->getSize(),
            ];
        }

        QuoteRequest::create([
            'full_name' => $data['fullName'],
            'company' => $data['company'] ?? null,
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'country' => $data['country'] ?? null,
            'services' => $data['services'] ?? [],
            'other_services' => $data['otherServices'] ?? null,
            'project_type' => $data['projectType'] ?? null,
            'description' => $data['description'] ?? null,
            'assets' => $data['assets'] ?? [],
            'budget' => $data['budget'] ?? null,
            'timeline' => $data['timeline'] ?? null,
            'communication' => $data['communication'] ?? [],
            'nda' => $data['nda'] ?? null,
            'details' => $data['details'] ?? null,
            'attachments' => $attachments,
            'agree_contact' => true,
            'agree_privacy' => true,
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'message' => 'Our experts are reviewing your requirements and will contact you shortly with a personalized proposal.',
        ]);
    }

    public function storeContact(Request $request): JsonResponse
    {
        $data = $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:10000'],
        ]);

        ContactMessage::create([
            'full_name' => $data['fullName'],
            'company' => $data['company'] ?? null,
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'message' => $data['message'],
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'message' => 'Thanks for reaching out! Our team will get back to you shortly.',
        ]);
    }
}
