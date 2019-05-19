<?php

use App\LapHistory;
use PHPUnit\Framework\TestCase;

final class LapHistoryTest extends TestCase 
{

  public function testMissingConstructParameters()
  {
    $this->expectException( ArgumentCountError::class );
    new LapHistory();
  }
  
  public function testWrongOrderConstructParameters()
  {
    $this->expectException( TypeError::class );
    $reader = new \App\Services\Log\Reader("logs/race_2019_05_11.txt");

    $log_race = $reader->getContent();

    new LapHistory($log_race, '038');
  }
}