<?php

namespace App;

use App\Lap;
use App\LogRace;
use App\Services\Collection;

class LapHistory
{
  public $history;
  public $duration;
  public $average_speed;
  public $better_lap;

  public function __construct(string $driver_id, Collection $log_race) {
    $this->extractLapDataFromLog($driver_id, $log_race);
  }

  private function extractLapDataFromLog(string $driver_id, Collection $log_race)
  {
    $laps = collect([]);
    $duration = 0;
    $log_race->each(function($log) use (&$laps, $driver_id, &$duration, &$average_speeds) {

      if ($log->driver_id == $driver_id) {
        $duration += \toMilliseconds($log->lap_duration); 
        $lap = new Lap($log);
        $laps->push($lap);
      }
    });

    $this->duration = $duration;
    $this->history = $laps;
    $this->average_speed = $this->raceAverageSpeed($laps);
    $this->better_lap = $this->betterLap($laps);
  }

  private function betterLap(Collection $laps)
  {
    $min_lap_duration = 0;
    $lap_number = 1;

    $laps->each(function($lap) use (&$min_lap_duration, &$lap_number) {
      if (!$min_lap_duration)
        $min_lap_duration = $lap->getDuration();

      if ($min_lap_duration > $lap->getDuration()) {
        $min_lap_duration = $lap->getDuration();
        $lap_number = $lap->getNumber();
      }
    });

    return $lap_number;
  }

  private function raceAverageSpeed(Collection $laps)
  {
    $average_speeds = collect([]);
    $laps->each(function($lap) use (&$average_speeds) {
      $average_speeds->push($lap->getAverageSpeed());
    });

    return $average_speeds->average(2);
  }
}