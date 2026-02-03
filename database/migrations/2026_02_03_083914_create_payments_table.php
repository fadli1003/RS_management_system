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
    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(User::class, 'patient_id')
            ->constrained()
            ->cascadeOnDelete()
            ->nullable();
      $table->foreignIdFor(User::class, 'doctor_id')
            ->constrained()
            ->cascadeOnDelete()
            ->nullable();
      $table->float('sub_total');
      $table->float('taxes');
      $table->float('total');
      $table->float('amount_received');
      $table->float('amount_to_pay');
      $table->float('doctor_commission');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payments');
  }
};
