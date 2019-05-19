<?php

use App\Services\Collection;
use App\Services\Log\Reader;
use PHPUnit\Framework\TestCase;
use App\Exceptions\LogFileNotFound;

final class ReaderTest extends TestCase
{
  public function testLogFileNotFound()
  {
    $this->expectException(LogFileNotFound::class);
    new Reader('logs/log_2019_05_11.txt');
  }
  
  public function testLogFileFound()
  {
    $reader = new Reader('logs/race_2019_05_11.txt');
    $this->assertInstanceOf(Reader::class, $reader);
  }

  public function testGetContentShouldReturnCollection()
  {
    $reader = new Reader('logs/race_2019_05_11.txt');
    $this->assertInstanceOf(Collection::class, $reader->getContent());
  }
}
