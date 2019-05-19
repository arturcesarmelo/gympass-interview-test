<?php

namespace App;

use App\Lap;
use App\Driver;
use App\LogRace;
use App\LapHistory;
use App\Services\Collection;
use App\Services\Log\Reader;
use App\Services\RaceOutput;

class Race
{
  private $drivers;
  private $total_laps;
  private $duration;
  private $grid;

  public function start()
  {
    $reader = new Reader("logs/race_2019_05_11.txt");

    $log_race = $reader->getContent();

    $drivers = collect([]);
    $log_race->each(function($log) use (&$drivers, $log_race) {

      if (!Driver::alreadyCollected($drivers, $log->driver_id)) {
        
        $driver = new Driver($log);    

        $lap_history = new LapHistory($driver->id, $log_race);

        $driver->lap_history = $lap_history->history;
        $driver->race_duration = $lap_history->duration;
        $driver->average_speed = $lap_history->average_speed;
        $driver->better_lap = $lap_history->better_lap;
        $drivers->push($driver);
      }

    });

    $this->drivers = $drivers;
  }

  public function grid()
  {

    $result = [];
    $size = $this->drivers->count();
    $items = $this->drivers->all();

    for($i = 0; $i < $size; $i++) {

      for($j = 0; $j < ($size-1); $j++) {
        
        $current = $items[$j];
        $next = $items[$j + 1];
        
        if( $current->race_duration > $next->race_duration ) {
          $items[$j] = $next;
          $items[$j + 1] = $current;
        }
      }
    }

    $this->grid = collect($items);

    return $this->grid;
  }

  public function output()
  {
      $output = new RaceOutput($this->grid);
      $output->render();
  }

}