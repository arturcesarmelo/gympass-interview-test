<?php

namespace App\Services;

use App\Services\Collection;

class RaceOutput
{

  private $grid;

  public function __construct(Collection $grid){
    $this->grid = $grid;
  }

  public function render()
  {
    $table = "<table border='1'>
      <thead>
        <tr>
          <th>Position</th>
          <th>Driver</th>
          <th>Laps</th>
          <th>Duration</th>
          <th>Average Speed</th>
          <th>Better lap</th>
        </tr>
      </thead>
      <tbody>";

      foreach($this->grid->all() as $key => $driver){
        $table .= "<tr><td># " . ($key + 1) . "</td>
        <td>{$driver->id} - {$driver->name}</td>
        <td>" . $driver->lap_history->count() . "</td>
        <td>" . fromMilliseconds($driver->race_duration) . "</td>
        <td>" . $driver->average_speed . "</td>
        <td>" . $driver->better_lap . "</td></tr>";
      }

      $table .= "</tbody><table>";
      
      echo $table;
  }
}