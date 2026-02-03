<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
  protected $fillable = [
    'name',
    'description',
    'charge',
    'doctor_commission'
  ];

  public function services()
  {
    return $this->belongsToMany(Service::class);
  }
}
