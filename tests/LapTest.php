<?php

use App\Lap;
use PHPUnit\Framework\TestCase;

final class LapTest extends TestCase 
{

  public function testShouldBeInstantiated()
  {
    $reader = new \App\Services\Log\Reader("logs/race_2019_05_11.txt");

    $log_race = $reader->getContent();
    $lap = new Lap($log_race->first());

    $this->assertInstanceOf(Lap::class, $lap);
  }
  
  public function testMssingConstructParameter()
  {

    $this->expectException( ArgumentCountError::class );
    
    $lap = new Lap();

  }
  
  public function testWrongConstructParameter()
  {

    $this->expectException( TypeError::class );

    $reader = new \App\Services\Log\Reader("logs/race_2019_05_11.txt");

    $log_race = $reader->getContent();
    $lap = new Lap($log_race);

  }
}