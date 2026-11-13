<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')
                ->nullable()
                ->after('id')
                ->constrained('roles')
                ->restrictOnDelete();

            $table->string('phone', 20)->nullable();
            $table->string('identity_number', 50)->nullable()->unique();
            $table->enum('user_type', [
                'teacher',
                'student',
                'employee',
                'other'
            ])->default('other');

            $table->enum('registration_status', [
                'pending',
                'active',
                'rejected'
            ])->default('pending');

            $table->text('address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'role_id',
                'phone',
                'identity_number',
                'user_type',
                'registration_status',
                'address'
            ]);
        });
    }
};
