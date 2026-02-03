<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
  use HasFactory;

  protected $fillable = [
    'department_id',
    'code',
    'status',
    'notes'
  ];

  public function department()
  {
    return $this->belongsTo(Departement::class);
  }

  public function bedallotments()
  {
    return $this->hasMany(BedAllotment::class);
  }
}
