<?php //MyCalculator Class for Testing

class MyCalculator {

  protected $result = 0;

  /**
   * @return int
   */
  public function getResult()
  {
    return $this->result;
  }

  /**
   *
   */
  public function add()
  {
      $this->calculateAll(func_get_args(), '+');
  }

  /**
   *
   */
  public function subtract()
  {

    $this->calculateAll(func_get_args(), '-');
  }


  protected function calculateAll(array $nums, $symbol)
  {
    foreach ($nums as $num)
    {
      $this->calculate($num, $symbol);
    }
  }

  /**
   * @param $num
   * @param $symbol
   */
  protected function calculate($num, $symbol)
  {
    if ( ! is_numeric($num))
      throw new InvalidArgumentException;

    switch ($symbol)
    {
      case '+' :
        $this->result += $num;
        break;

      case '-' :
        $this->result -= $num;
        break;
    }
  }

}