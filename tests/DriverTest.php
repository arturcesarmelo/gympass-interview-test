<?php

use App\Driver;
use PHPUnit\Framework\TestCase;

final class DriverTest extends TestCase 
{

  public function testWrongConstructParameters()
  {
    $this->expectException( TypeError::class );
    $reader = new \App\Services\Log\Reader("logs/race_2019_05_11.txt");

    $log_race = $reader->getContent();
    $driver = new Driver($log_race);
  }
  
  public function testAlreadyCollectedWithWrongParameterOrder()
  {
    $this->expectException( TypeError::class );
    $reader = new \App\Services\Log\Reader("logs/race_2019_05_11.txt");

    $log_race = $reader->getContent();
    $bool = Driver::alreadyCollected('038', $log_race);
  }
  
  public function testAlreadyCollectedMissingParameters()
  {
    $this->expectException( ArgumentCountError::class );
    $reader = new \App\Services\Log\Reader("logs/race_2019_05_11.txt");

    $log_race = $reader->getContent();
    $bool = Driver::alreadyCollected($log_race);
  }
}