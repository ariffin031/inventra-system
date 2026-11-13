<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_deliveries', function (Blueprint $table) {
            $table->id();

            $table->uuid('notification_id');

            $table->foreign('notification_id')
                ->references('id')
                ->on('notifications')
                ->cascadeOnDelete();

            $table->enum('channel', [
                'whatsapp',
                'email'
            ]);

            $table->string('recipient', 100);

            $table->enum('status', [
                'pending',
                'sent',
                'failed'
            ])->default('pending');

            $table->string('provider_message_id')->nullable();
            $table->text('error_message')->nullable();

            $table->timestamp('sent_at')->nullable();

            $table->timestamps();

            $table->index(['channel', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_deliveries');
    }
};
