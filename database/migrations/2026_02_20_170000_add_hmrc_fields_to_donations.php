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
            // Add HMRC specific fields
            $table->string('aggregated_donations', 35)->nullable()->after('gift_aid_postcode');
            $table->boolean('sponsored_event')->default(false)->after('aggregated_donations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['aggregated_donations', 'sponsored_event']);
        });
    }
};
