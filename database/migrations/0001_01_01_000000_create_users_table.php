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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('surname');
            $table->string('username')->unique();
            $table->text('avatar')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->foreignId('user_status_id')->default(1);
            $table->foreign('user_status_id')->references('id')->on('user_statuses');

            $table->foreignId('user_type_id')->nullable();
            $table->foreign('user_type_id')->references('id')->on('user_types');

            $table->foreignId('job_type_id')->nullable();
            $table->foreign('job_type_id')->references('id')->on('job_types');

            $table->foreignId('skill_level_id')->nullable();
            $table->foreign('skill_level_id')->references('id')->on('skill_levels');

            $table->foreignId('experience_id')->nullable();
            $table->foreign('experience_id')->references('id')->on('experiences');

            // add company later

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
