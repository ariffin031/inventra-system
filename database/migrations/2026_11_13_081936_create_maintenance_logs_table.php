<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tool_unit_id')
                ->constrained('tool_units')
                ->restrictOnDelete();

            $table->foreignId('reported_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('handled_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('status', [
                'reported',
                'in_progress',
                'completed',
                'cancelled'
            ])->default('reported');

            $table->text('description');

            $table->dateTime('started_at')->nullable();
            $table->dateTime('completed_at')->nullable();

            $table->text('repair_notes')->nullable();

            $table->decimal('repair_cost', 15, 2)->nullable();

            $table->timestamps();

            $table->index(['tool_unit_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_logs');
    }
};
