<?php

use Illuminate\Support\Facades\Mail;
use function Pest\Laravel\post;

it('sends contact form emails to info mailbox', function () {
    $capturedCallback = null;

    Mail::shouldReceive('html')
        ->once()
        ->withArgs(function ($html, $callback) use (&$capturedCallback) {
            $capturedCallback = $callback;

            return is_string($html) && is_callable($callback);
        });

    $response = post(route('contact.store'), [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'subject' => 'Test Subject',
        'message' => 'This is a long enough message for validation.',
    ]);

    $response
        ->assertRedirect()
        ->assertSessionHas('success');

    expect($capturedCallback)->not->toBeNull();

    $message = \Mockery::mock();
    $message->shouldReceive('to')
        ->once()
        ->with('info@educatetheorphans.com')
        ->andReturnSelf();
    $message->shouldReceive('replyTo')
        ->once()
        ->with('jane@example.com', 'Jane Doe')
        ->andReturnSelf();
    $message->shouldReceive('subject')
        ->once()
        ->with('New Contact Form: Test Subject')
        ->andReturnSelf();

    $capturedCallback($message);
});

it('captures contact message in fallback log mailer when smtp auth is disabled', function () {
    $capturedFallbackCallback = null;

    $fallbackMailer = \Mockery::mock();
    $fallbackMailer->shouldReceive('html')
        ->once()
        ->withArgs(function ($html, $callback) use (&$capturedFallbackCallback) {
            $capturedFallbackCallback = $callback;

            return is_string($html) && is_callable($callback);
        });

    Mail::shouldReceive('mailer')
        ->once()
        ->with('log')
        ->andReturn($fallbackMailer);

    Mail::shouldReceive('html')
        ->once()
        ->andThrow(new Exception('SmtpClientAuthentication is disabled for the Tenant'));

    $response = post(route('contact.store'), [
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'subject' => 'Test Subject',
        'message' => 'This is a long enough message for validation.',
    ]);

    $response
        ->assertRedirect()
        ->assertSessionHas('success', 'Thanks! We received your message and will follow up soon while we resolve a temporary email delivery issue.');

    expect($capturedFallbackCallback)->not->toBeNull();

    $message = \Mockery::mock();
    $message->shouldReceive('to')
        ->once()
        ->with('info@educatetheorphans.com')
        ->andReturnSelf();
    $message->shouldReceive('replyTo')
        ->once()
        ->with('jane@example.com', 'Jane Doe')
        ->andReturnSelf();
    $message->shouldReceive('subject')
        ->once()
        ->with('New Contact Form (Fallback Logged): Test Subject')
        ->andReturnSelf();

    $capturedFallbackCallback($message);
});
