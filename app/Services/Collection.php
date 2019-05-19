<?php

namespace App\Services;

class Collection
{
	private $items = array();

	public function __construct(array $items)
	{
		$this->items = $items;
	}

	public function distinct($column) 
	{
		$result = [];

		foreach ($this->items as $value) {
			if (!in_array([$column => $value[$column]], $result)) {
				$result[] = [$column => $value[$column]]; 
			}
		}

		return $result;
	}

	public function push($data)
	{
    array_push($this->items, $data);
    return $this->items;
	}

	public function all()
	{
		return $this->items;
	}

	public function each($closure) {
		$result = [];
		foreach ($this->all() as $item) {
			$closure($item);
		}

		return $result;
  }
  
  public function count()
  {
    return sizeof($this->items);
  }

  public function get($key)
  {
    if (array_key_exists($key, $this->items))
      return $this->item[$key];
  }

  public function average(int $precision = 0)
  {
    $a = array_filter($this->items);
    
    $av = array_sum($a)/count($a);

    if ($precision)
      return round($av, $precision);

    return (float) $av;
  }

  public function first()
  {
    $items = $this->all();
    return reset($items);
  }


  public function last()
  {
    $items = $this->all();
    return end($items);
  }
}