<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            // Payment information
            $table->string('stripe_payment_intent_id')->unique()->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('GBP');
            $table->enum('frequency', ['one-time', 'monthly'])->default('one-time');
            $table->enum('payment_method', ['card', 'direct_debit'])->default('card');
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');

            // Donor information
            $table->string('donor_email');
            $table->string('donor_name')->nullable();
            $table->string('donor_phone')->nullable();

            // Gift Aid information
            $table->boolean('gift_aid_eligible')->default(false);
            $table->string('gift_aid_title')->nullable();
            $table->string('gift_aid_first_name')->nullable();
            $table->string('gift_aid_last_name')->nullable();
            $table->string('gift_aid_address_line1')->nullable();
            $table->string('gift_aid_address_line2')->nullable();
            $table->string('gift_aid_city')->nullable();
            $table->string('gift_aid_postcode')->nullable();
            $table->date('gift_aid_declaration_date')->nullable();

            // Metadata
            $table->text('metadata')->nullable(); // JSON field for additional data
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('donor_email');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
