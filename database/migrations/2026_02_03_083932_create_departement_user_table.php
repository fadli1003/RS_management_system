<?php

use App\Models\User;
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
    Schema::create('departement_user', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->foreignId('departement_id')
            ->constrained()->references('users')->cascadeOnDelete();
      $table->foreignId('user_id')
            ->constrained()->references('users')->cascadeOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('departement_user');
  }
};
