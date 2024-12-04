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
        Schema::create('savings', function (Blueprint $table) {
            $table->id('id'); // Primary Key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign Key to User
            $table->decimal('account_balance', 15, 2)->default(0); // Account balance with 2 decimal places
            $table->decimal('interest_earned', 15, 2)->default(0); // Interest earned
            $table->dateTime('last_deposit_date')->nullable(); // Last deposit date
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savings');
    }
};
