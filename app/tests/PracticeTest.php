<?php

class PracticeTest extends TestCase {

  /**
   * A basic functional test example.
   *
   * @return void
   */
  public function testHelloWorld()
  {
    $greeting = 'Hello World';

//  $this->assertTrue($greeting === 'Hello World');
    $this->assertEquals('Hello World', $greeting, "Test: whether $greeting is the same as 'Hello World'");
  }

  public function testSum()
  {

//    $sum = 4;
//    $this->assertEquals(4, $sum);

    $sum = null;
    $this->assertNotSame(0, $sum, "Testing whether null is the same as 0");
  }

  public function testIfContains()
  {

    $names = ['Darren', 'Jim', 'Joe'];
    $this->assertContains('Darren', $names, "is 'darren' in the array");
  }

  public function testIsInteger()
  {
    $age = 32;
    $this->assertInternalType('integer', $age); //true
  }

  public function testGeneratesAnchorTag()
  {
    $actual = link_me_to('dogs/1', 'Show Dog');
    $expect = "<a href='http://localhost/dogs/1'>Show Dog</a>";
    $this->assertEquals($expect, $actual);

  }

}
