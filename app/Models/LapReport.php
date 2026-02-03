<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LapReport extends Model
{
    protected $fillable = [
    'date',
    'time',
    'patient_id',
    'doctor_id',
    'template_id',
    'report'
  ];

  public function lapTemplete()
  {
    return $this->hasOne(Lap::class);
  }
  public function template()
  {
    return $this->belongsTo(Lap::class, 'template_id');
  }

  public function patient()
  {
    return $this->belongsTo(User::class, 'patient_id', 'id');
  }

  public function doctor()
  {
    return $this->belongsTo(User::class, 'doctor_id', 'id');
  }
}
