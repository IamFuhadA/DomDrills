<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'min:2', 'max:100'],
            'email'   => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        // TODO: Send notification email or save to DB
        // Mail::to(config('mail.support_address', 'support@domdrills.com'))
        //     ->send(new ContactFormMail($validated));

        // Log it for now
        \Log::info('Contact form submission', $validated);

        return redirect()->route('contact')
                         ->with('success', 'Thank you for your message. We\'ll get back to you within one business day.');
    }
}
