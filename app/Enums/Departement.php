<?php

namespace App\Enums\Enums;

use App\Enums\HasValues;

enum Departement : String
{
  use HasValues;
  case HR = 'Human Resource';
  case MANAGEMENT = 'Management';
  case STAFF = 'Staff';
  case TEEN = 'Teenager';
  case ELDER = 'Elder';
}
