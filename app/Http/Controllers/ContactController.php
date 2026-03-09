<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle contact form submission
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Prepare the email content
        $emailContent = "
            <h2>New Contact Form Submission</h2>
            <p><strong>Name:</strong> {$validated['name']}</p>
            <p><strong>Email:</strong> {$validated['email']}</p>
            <p><strong>Subject:</strong> {$validated['subject']}</p>
            <p><strong>Message:</strong></p>
            <p>{$validated['message']}</p>
        ";

        // Send the email
        try {
            Mail::html($emailContent, function ($message) use ($validated) {
                $message->to('info@educatetheorphans.com')
                    ->replyTo($validated['email'], $validated['name'])
                    ->subject('New Contact Form: ' . $validated['subject']);
            });

            return back()->with('success', 'Thank you! Your message has been sent successfully. We\'ll be in touch within 48 hours.');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();

            Log::error('Contact form email error: ' . $errorMessage);

            try {
                Mail::mailer('log')->html($emailContent, function ($message) use ($validated) {
                    $message->to('info@educatetheorphans.com')
                        ->replyTo($validated['email'], $validated['name'])
                        ->subject('New Contact Form (Fallback Logged): ' . $validated['subject']);
                });

                Log::warning('Contact form message captured using log mailer fallback.');

                return back()->with('success', 'Thanks! We received your message and will follow up soon while we resolve a temporary email delivery issue.');
            } catch (\Exception $fallbackException) {
                Log::error('Contact form fallback logging error: ' . $fallbackException->getMessage());
            }

            if (str_contains($errorMessage, 'SmtpClientAuthentication is disabled')) {
                return back()->with('error', 'Our contact form is temporarily unavailable. Please email us directly at info@educatetheorphans.com and we will respond as soon as possible.')->withInput();
            }

            return back()->with('error', 'Sorry, there was an issue sending your message. Please try again or email us directly at info@educatetheorphans.com')->withInput();
        }
    }
}
