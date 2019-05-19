<?php

namespace App;

use App\Model;
use App\LogRace;
use App\Services\Collection;

class Driver extends Model
{
  public $id;
  public $name;
  public $lap_history;
  public $race_duration;
  public $average_speed;
  public $better_lap;

  public function __construct(LogRace $log_race)
  {
    $this->extractDriverData($log_race);
  }

  private function extractDriverData(LogRace $log_race)
  {
    $this->id = $log_race->driver_id;
    $this->name = $log_race->driver_name;

    return $this;
  }

  public static function alreadyCollected(Collection $drivers, string $driver_id) : bool
  {
    $bool = false;
    $drivers->each(function($driver) use (&$bool, $driver_id) {
      if ($driver->id == $driver_id)
        $bool = true;
    });

    return $bool;
  }
}
