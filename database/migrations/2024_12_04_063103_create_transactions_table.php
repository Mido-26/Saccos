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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User associated with the transaction
            $table->foreignId('initiator_id')->constrained('users')->onDelete('cascade'); // User who initiated the transaction
            $table->enum('type', ['deposit', 'withdrawal', 'loan_payment', 'loan_disbursement']); // Type of transaction
            $table->decimal('amount', 15, 2); // Transaction amount with precision for currency
            $table->string('transaction_reference')->unique(); // Unique identifier for the transaction
            $table->string('payment_method')->nullable(); // Payment method used (e.g., 'mobile money', 'bank transfer')
            $table->text('description')->nullable(); // Optional description or notes for the transaction
            $table->timestamp('completed_at')->nullable(); // Timestamp when the transaction was completed
            $table->json('metadata')->nullable(); // Additional information about the transaction in JSON format
            $table->timestamps(); // Timestamps for creation and last update
        
        

            // $table->text('failed_reason')->nullable(); // Reason for failure if the transaction fails
            // $table->ipAddress('ip_address')->nullable(); // Optional for tracking the IP address of the initiator
            
            // $table->enum('status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending'); // Transaction status
            // $table->foreignId('account_id')->nullable()->constrained('accounts')->onDelete('set null'); // SACCO account reference
            // $table->foreignId('loan_id')->nullable()->constrained('loans')->onDelete('set null'); // Reference for loan-related transactions
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
