<?php

namespace App\Exceptions;

class LogFileNotFound extends \Exception
{
  public function errorMessage() {
    //error message
    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    .': <b>'.$this->getMessage().'</b> on logs folder.';
    return $errorMsg;
  }
}