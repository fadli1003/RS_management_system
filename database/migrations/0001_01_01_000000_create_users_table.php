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
      $table->enum('role', ['admin', 'patient', 'doctor', 'perawat', 'staff'])->default('patient');
      $table->string('first_name');
      $table->string('last_name');
      $table->string('national_id')->nullable();
      $table->string('email');
      $table->string('password')->nullable();
      $table->string('address')->nullable();
      $table->string('picture')->nullable();
      $table->date('birth_date')->nullable();
      $table->enum('gender', ['male', 'female'])->nullable();
      $table->unsignedInteger('phone')->nullable();
      $table->bigInteger('mobile')->nullable();
      $table->bigInteger('emergency')->nullable();
      $table->string('type');
      $table->timestamp('email_verified_at')->nullable();
      $table->string('medical_degree')->nullable();
      $table->string('specialist')->nullable();
      $table->string('biography')->nullable();
      $table->string('educational_qualification')->nullable();
      $table->string('blood_group')->nullable();
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
