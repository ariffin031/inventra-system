<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowing_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('borrowing_id')
                ->constrained('borrowings')
                ->cascadeOnDelete();

            $table->foreignId('tool_unit_id')
                ->constrained('tool_units')
                ->restrictOnDelete();

            $table->text('notes')->nullable();

            $table->timestamps();

            // Satu unit fisik tidak boleh tercatat dua kali
            // dalam transaksi peminjaman yang sama.
            $table->unique(
                ['borrowing_id', 'tool_unit_id'],
                'borrowing_unit_unique'
            );

            $table->index('tool_unit_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowing_details');
    }
};
