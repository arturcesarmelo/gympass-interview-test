<?php

use App\Race;
use App\Driver;
use App\LapHistory;
use App\Services\Log\Reader;
use PHPUnit\Framework\TestCase;

final class RaceTest extends TestCase 
{

  public function testAscendingBubbleSortingOnGridMethod()
  {
    $race = new Race();
    
    $race->start();
    $first = $race->grid()->first();
    $second = $race->grid()->all()[1];
    $third = $race->grid()->all()[2];

    $this->assertTrue($first->race_duration < $second->race_duration);
    $this->assertTrue($second->race_duration < $third->race_duration);
  } 
}