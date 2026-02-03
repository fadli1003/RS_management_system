<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lap extends Model
{
  protected $fillable = [
    'name',
    'template'
  ];

  public function lapReport()
  {
    return $this->belongsToMany(LapReport::class);
  }
}
