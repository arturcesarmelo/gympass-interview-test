<?php

namespace app\Services;

class Terminal {

	private $foreground_colors = array();

	public function __construct() {
		$this->foreground_colors['info'] = '0;34';
		$this->foreground_colors['success'] = '0;32';
		$this->foreground_colors['danger'] = '0;31';
		$this->foreground_colors['warning'] = '1;33';
	}

	public function colorString($string, $foreground_color = null)
	{
		$colored_string = "";
		if (isset($this->foreground_colors[$foreground_color])) {
			$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
		}

		$colored_string .=  $string . "\033[0m";

		return $colored_string;
	}

	public function info( string $string ) : string
	{
		return $this->colorString($string, 'info');
	}

	public function success( string $string ) : string
	{
		return $this->colorString($string, 'success');
	}

	public function danger( string $string ) : string
	{
		return $this->colorString($string, 'danger');
	}

	public function warning( string $string ) : string
	{
		return $this->colorString($string, 'warning');
	}
}
