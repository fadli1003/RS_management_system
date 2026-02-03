<?php

namespace App\Enums;

enum UserRole : string
{
  case admin = 'admin';
  case doctor = 'doctor';
  case patient = 'patient';
  case nurse = 'nurse';
  case accountant = 'accountant';
  case pharmacist = 'pharmacist';
  case laboratorist = 'laboratorist';
  case receptionist = 'receptionist';
  case staff = 'staff';
}
