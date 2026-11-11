<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations: create the `customers` table.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();                                // Primary key (auto increment)
            $table->string('name');                      // Customer name
            $table->string('email')->unique();           // Email address, no duplicates
            $table->text('address');                     // Full address (can be multi-line)
            $table->string('phoneNumber', 30);           // Phone number as text: keeps +, -, ( ) and leading 0
            $table->enum('gender', ['Male', 'Female']);  // Only Male or Female is allowed
            $table->date('birthday');                    // Customer's date of birth (YYYY-MM-DD)
            $table->timestamps();                        // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations: drop the `customers` table.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
