<?php

namespace App\Enums;

trait HasValues
{
  public static function values()
  {
    return array_column(self::cases(), 'value');
  }

  public static function names()
  {
    return array_column(self::cases(), 'name');
  }
}
