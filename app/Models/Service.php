<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  protected $fillable = [
        'department_id','name','charge','doctor_commission'
    ];

    public function department(){
        return $this->belongsTo(Departement::class);
    }

    public function patients(){
        return $this->belongsToMany(User::class, 'patient_service', 'patient_id', 'user_id');
    }

    public function servicePackages(){
        return $this->belongsToMany(ServicePackage::class);
    }
}
