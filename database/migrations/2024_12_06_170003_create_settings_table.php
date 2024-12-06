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
        Schema::create('settings', function (Blueprint $table) {
            $table->id(); // Primary key

            // organization Information
            $table->string('organization_name')->nullable(false); // Organization name
            $table->string('organization_email')->nullable(false); // Organization email
            $table->string('organization_phone')->nullable(false); // Organization phone number
            $table->string('organization_address')->nullable(false); // Organization physical address
            $table->string('organization_logo')->nullable(); // Organization logo path (optional)

            // Savings and Loan Configuration
            $table->decimal('min_savings', 10, 2)->nullable(false); // Minimum savings
            $table->decimal('interest_rate', 5, 2)->nullable(false); // Interest rate in percentage
            $table->integer('loan_duration')->nullable(false); // Maximum loan duration in months
            $table->enum('loan_type', ['fixed', 'reducing'])->nullable(false); // Loan type: fixed or reducing balance
            $table->decimal('loan_max_amount', 15, 2)->nullable(false); // Maxmum loan calculation amount
            $table->string('currency', 3)->nullable(false); // Default currency (e.g., TZS, USD)

            // guarantor infomation
            $table->boolean('allow_guarantor')->default(false); // Guarantor allowed or not
            $table->integer('min_guarantor')->nullable(); // Minimum number of guarantors
            $table->integer('max_guarantor')->nullable(); // Maximum loans a guarantor can be referred to
            $table->decimal('min_savings_guarantor', 10, 2)->nullable(); // Minimum savings per guarantor
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
