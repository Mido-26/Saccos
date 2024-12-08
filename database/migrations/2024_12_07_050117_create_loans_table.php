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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict'); // User associated with the loan
            $table->integer('loan_duration'); // Loan duration in Month monthly_repayment
            $table->decimal('monthly_payments', 10, 2); // Principal loan amount
            $table->decimal('principal_amount', 10, 2); // Principal loan amount
            $table->decimal('loan_amount', 10, 2); // Total loan amount (principal + interest)
            $table->decimal('interest_rate', 5, 2); // Interest rate as percentage
            $table->text('description')->nullable(); // Optional description of the loan
            $table->enum('status', ['pending', 'approved', 'rejected', 'disbursed', 'completed', 'defaulted'])->default('pending'); // Loan status
            $table->timestamp('disbursed_at')->nullable(); // Timestamp when the loan was disbursed
            $table->timestamp('approved_at')->nullable(); // Timestamp when the loan was approved
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null'); // User who approved the loan
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
