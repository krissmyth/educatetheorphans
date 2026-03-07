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
        if (! Schema::hasColumn('donations', 'paypal_order_id')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->string('paypal_order_id')->unique()->nullable()->after('stripe_customer_id');
            });
        }

        if (! Schema::hasColumn('donations', 'paypal_transaction_id')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->string('paypal_transaction_id')->nullable()->after('paypal_order_id');
            });
        }

        if (! Schema::hasColumn('donations', 'payment_gateway')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->enum('payment_gateway', ['stripe', 'paypal'])->nullable()->after('payment_method');
            });
        }

        if (! Schema::hasColumn('donations', 'aggregated_donations')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->string('aggregated_donations')->nullable()->after('gift_aid_postcode');
            });
        }

        if (! Schema::hasColumn('donations', 'sponsored_event')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->boolean('sponsored_event')->default(false)->after('aggregated_donations');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('donations', 'paypal_order_id')) {
            Schema::table('donations', function (Blueprint $table) {
                $table->dropUnique(['paypal_order_id']);
            });
        }

        $columnsToDrop = array_filter([
            Schema::hasColumn('donations', 'paypal_order_id') ? 'paypal_order_id' : null,
            Schema::hasColumn('donations', 'paypal_transaction_id') ? 'paypal_transaction_id' : null,
            Schema::hasColumn('donations', 'payment_gateway') ? 'payment_gateway' : null,
        ]);

        if (! empty($columnsToDrop)) {
            Schema::table('donations', function (Blueprint $table) use ($columnsToDrop) {
                $table->dropColumn($columnsToDrop);
            });
        }
    }
};
