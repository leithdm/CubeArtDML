<?php

class ArtistsTest extends TestCase {

  /**
   * A basic functional test example.
   * @return void
   */

  public function testIsInvalidWithoutFirstName() {
    $artist = new Artist;

    $this->assertFalse($artist->validate());
  }


}