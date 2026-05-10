<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
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
        // Honeypot check — bots fill in hidden fields, real users don't
        if ($request->filled('website')) {
            return back()->with('success', 'Thank you! Your message has been sent.');
        }

        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Save to database first so no submission is ever lost
        $submission = ContactSubmission::create([
            'name'       => $validated['name'],
            'email'      => $validated['email'],
            'subject'    => $validated['subject'],
            'message'    => $validated['message'],
            'email_sent' => false,
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

            $submission->update(['email_sent' => true]);

            return back()->with('success', 'Thank you! Your message has been sent successfully. We\'ll be in touch as soon as we can.');
        } catch (\Exception $e) {
            // Submission is already saved to the database — log the failure and inform the user
            Log::error('Contact form email failed: ' . $e->getMessage(), [
                'submission_id' => $submission->id,
            ]);

            return back()->with('success', 'Thanks! We\'ve received your message and will be in touch soon.');
        }
    }

    public function destroy(ContactSubmission $submission): RedirectResponse
    {
        $submission->delete();

        return redirect()->route('dashboard')->with('success', 'Submission deleted.');
    }
}
