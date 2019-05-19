<?php

if(!function_exists('d')) {

	function d(...$args)
	{
		dump($args);
	}
}

function array_key_value_exists(string $key, $value, array $array)
{
	foreach ($array as $item) {
		if (array_key_exists($key, $item)) {
			if ($item[$key] == $value)
				return true;
		}
	}

	return false;
}

if(!function_exists('collect')) {
  function collect(array $array) : App\Services\Collection
  {
    return new App\Services\Collection($array);
  }
}

function toMilliseconds(string $string) : string
{
  $time_array = explode(':', $string);
  $m = reset($time_array);
  $s_ms = explode('.', end($time_array));
  $s = $s_ms[0];
  $ms = $s_ms[1];

  return $ms + ($s * 1000) + ($m * 60000);
}

function fromMilliseconds(int $ms) : string
{
  return floor($ms/60000).':'.floor(($ms%60000)/1000).'.'.str_pad(floor($ms%1000),3,'0', STR_PAD_LEFT);
}

function view(string $view_file_name, array $params = [])
{
  $view_path = 'resource/views/' . $view_file_name;
  
  if (is_readable($view_path . '.blade.php')) {
    return App\Services\View::make($view_path, $params);
  }
}