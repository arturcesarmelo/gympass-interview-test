<?php

namespace App;

use App\Model;

class LogRace extends Model
{
  public $time;
  public $driver_id;
  public $driver_name;
  public $lap;
  public $lap_duration;
  public $lap_avarage_speed;

  public function __construct($attrs)
  {
    $this->hydrate($attrs);
  }
}
