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
    Schema::create('lap_reports', function (Blueprint $table) {
      $table->id();
      $table->date('date');
      $table->time('time');
      $table->foreignIdFor(User::class, 'patient_id')->constrained()->cascadeOnDelete();
      $table->foreignIdFor(User::class, 'doctor_id')->constrained()->cascadeOnDelete();
      //need to fix
      $table->foreignId('lap_id')->constrained()->cascadeOnDelete();
      $table->text('report');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('lap_reports');
  }
};
