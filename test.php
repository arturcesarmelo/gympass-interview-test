<?php

include 'vendor/autoload.php';

$command = './vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox tests';
$output = [];
exec($command, $output);

$terminal = new App\Services\Terminal;

$terminal->danger($output[0] . PHP_EOL);
foreach($output as $message) {
  if (preg_match('/✔/', $message))
    echo $terminal->success($message . PHP_EOL);
  else if (preg_match('/✘/', $message))
    echo $terminal->danger($message . PHP_EOL);
  else
    echo $message . PHP_EOL;
}