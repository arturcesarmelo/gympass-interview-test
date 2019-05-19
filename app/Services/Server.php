<?php

namespace App\Services;

use App\Services\Terminal;

class Server extends Terminal{

	public function __construct()
	{
		parent::__construct();

		$port = getopt('p');

		if (!$port)
			$port = '8000';

		echo $this->success("Server runing at http://localhost:{$port}\n\nPress Ctrl + C to quit.");

		exec("php -S localhost:{$port} bootstrap.php");
	}

}