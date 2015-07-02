<?php

class PagesControllerTest extends TestCase {

  public function testMainWebSiteRoutes()
  {
    $this->call('GET', '/'); //homepage
    $this->assertResponseOk();

    $this->call('GET', '/art/Painting'); //Painting category
    $this->assertResponseOk();

    $this->call('GET', '/art/Photography'); //Photography category
    $this->assertResponseOk();

    $this->call('GET', '/art/Drawing'); //Drawing category
    $this->assertResponseOk();

    $this->call('GET', '/art/Sculpture'); //Sculpture category
    $this->assertResponseOk();

    $this->call('GET', '/art/Collage'); //Collage category
    $this->assertResponseOk();

    $this->call('GET', '/events'); //events category
    $this->assertResponseOk();

    $this->call('GET', '/admin'); //admin category
    $this->assertResponseOk();
  }

}