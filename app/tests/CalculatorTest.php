<?php

class CalculatorTest extends TestCase {

  /**
   * A basic functional test example.
   *
   * @return void
   */

  protected $calc;

  public function setUp()
  {
    $this->calc = new MyCalculator;
  }

  public function testInstance()
  {
     new MyCalculator;
  }

  public function testResultDefaultsToZero()
  {
    $this->assertSame(0, $this->calc->getResult());
  }

  public function testAddsNumber()
  {
    $this->calc->add(5);
    $this->assertSame(5, $this->calc->getResult());
  }

  /**
   * @expectedException InvalidArgumentException
   */

  public function testRequiresNumericValue()
  {
    $this->calc->add('five');
  }

  public function testAcceptsMultipleArguments()
  {
    $this->calc->add(3, 4, 5);
    $this->assertEquals(12, $this->calc->getResult());
    $this->assertNotEquals(12, 'twelve');
  }

  public function testSubtractsNumber()
  {
    $this->calc->subtract(4);
    $this->assertEquals(-4, $this->calc->getResult());
  }

}