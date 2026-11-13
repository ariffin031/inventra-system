<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tool_units', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tool_id')
                ->constrained('tools')
                ->restrictOnDelete();

            $table->string('asset_code', 100)->unique();
            $table->uuid('qr_token')->unique();

            $table->string('serial_number', 100)->nullable()->unique();

            $table->enum('physical_condition', [
                'good',
                'fair',
                'damaged'
            ])->default('good');

            $table->enum('status', [
                'available',
                'borrowed',
                'maintenance',
                'damaged',
                'lost'
            ])->default('available');

            $table->string('location', 150)->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['tool_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tool_units');
    }
};
