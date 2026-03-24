<?php

use App\Models\MedicineCategory;
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
    Schema::create('medicines', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('instruction')->nullable();
      //need to evaluate
      $table->foreignIdFor(MedicineCategory::class,  'medicine_category_id')->constrained()->cascadeOnDelete();
      $table->float('purchase_price');
      $table->float('sale_price');
      $table->integer('quantity');
      $table->string('company');
      $table->date('expire_date');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('medicines');
  }
};
