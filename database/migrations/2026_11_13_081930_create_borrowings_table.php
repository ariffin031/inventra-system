<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('issued_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('borrowing_code', 50)->unique();

            $table->dateTime('borrowed_at')->nullable();
            $table->dateTime('due_at');

            $table->dateTime('approved_at')->nullable();
            $table->dateTime('issued_at')->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'issued',
                'partially_returned',
                'returned',
                'cancelled'
            ])->default('pending');

            $table->string('purpose', 255)->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('due_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
