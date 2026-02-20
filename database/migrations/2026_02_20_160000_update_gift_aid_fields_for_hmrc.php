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
        Schema::table('donations', function (Blueprint $table) {
            // Update Gift Aid fields to match HMRC requirements exactly
            $table->string('gift_aid_title', 4)->nullable()->change(); // Max 4 characters
            $table->string('gift_aid_first_name', 35)->nullable()->change(); // Max 35 characters
            $table->string('gift_aid_last_name', 35)->nullable()->change(); // Max 35 characters
            $table->string('gift_aid_address_line1', 40)->nullable()->change(); // House name/number - Max 40 characters
            $table->string('gift_aid_postcode', 10)->nullable()->change(); // Postcode with space
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('gift_aid_title')->nullable()->change();
            $table->string('gift_aid_first_name')->nullable()->change();
            $table->string('gift_aid_last_name')->nullable()->change();
            $table->string('gift_aid_address_line1')->nullable()->change();
            $table->string('gift_aid_postcode')->nullable()->change();
        });
    }
};
