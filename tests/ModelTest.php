<?php

use App\Driver;
use App\Services\Log\Reader;
use PHPUnit\Framework\TestCase;

final class ModelTest extends TestCase 
{

  public function testToArrayShouldReturnValidArray()
  {
    $reader = new Reader("logs/race_2019_05_11.txt");
    $log_race = $reader->getContent();
    $log = $log_race->first();
    $driver = new Driver($log);

    $this->assertTrue(is_array($driver->toArray()));
  }
}