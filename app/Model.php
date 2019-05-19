<?php

namespace App;

class Model
{

  public function toArray() : array
  {
    return get_object_vars($this);
  }

  public function hydrate(array $properties = [])
  {
    foreach($properties as $attribute => $value)
    {
      if (property_exists(get_called_class(), $attribute)) {
        $this->$attribute = $value;
      }
    }
  }
}