<?php

namespace App\Services\Log;

use App\LogRace;
use App\Services\Collection;
use App\Exceptions\LogFileNotFound;

class Reader
{

  private $content;
  protected $file_path;

  const  TIME = 'time';
  const  DRIVER_ID = 'driver_id';
  const  DRIVER_NAME = 'driver_name';
  const  LAP = 'lap';
  const  LAP_DURATION = 'lap_duration';
  const  LAP_AVARAGE_SPEED = 'lap_avarage_speed';

	function __construct(string $file_path)
	{
    $this->file_path = $file_path;
    if (is_readable($this->file_path))
			$this->loadFile();
		else
			throw new LogFileNotFound('Log file not found.');
	}

	public function getContent() : Collection
	{
		$lines = explode(PHP_EOL, trim($this->content));

    $data = collect([]);

		foreach ($lines as $line) {

      $columns = preg_split('/\s+/', $line);

			if ($columns !== "") {
				$data->push( new LogRace([
					self::TIME => $columns[0],
					self::DRIVER_ID => $columns[1],
					self::DRIVER_NAME => $columns[3],
					self::LAP => $columns[4],
					self::LAP_DURATION => $columns[5],
          self::LAP_AVARAGE_SPEED => $columns[6]
				]));
			}
    }

    return $data;
	}

  private function loadFile()
  {
    $fp = fopen($this->file_path, 'r');
    $this->content = fread($fp, filesize($this->file_path));
  }

}