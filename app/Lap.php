<?php

namespace App;

use App\Model;
use App\LogRace;
use App\Services\Collection;
use App\Services\Log\Reader;

class Lap extends Model
{

  protected $number;
  protected $time;
  protected $duration;
  protected $avarage_speed;
  protected $fastier_lap = false;
  protected $fastier_lap_race = false;

  public function __construct(LogRace $logRace)
  {
    $this->number = $logRace->lap;
    $this->time = $logRace->time;
    $this->duration = $logRace->lap_duration;
    $this->avarage_speed = $logRace->lap_avarage_speed;
  }

  public function getAverageSpeed()
  {
    return $this->avarage_speed;
  }

  public function getDuration()
  {
    return $this->duration;
  }

  public function getNumber()
  {
    return $this->number;
  }
}
