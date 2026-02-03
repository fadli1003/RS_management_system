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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'patient_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class, 'doctor_id')->constrained()->cascadeOnDelete();
            $table->string('blood_pressure')->nullable();
            $table->string('diabetes')->nullable();
            $table->string('symptoms');
            $table->string('diagnosis');
            $table->string('advice')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
