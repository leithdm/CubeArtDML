<?php

class PagesControllerTest extends TestCase {


  public function testHome()
  {
    $response = $this->call('GET', '/');  //GET request to localhost:8000/
    $this->assertViewHas('galleryArt');   //verifies view has the variable, $galleryArt
    $this->assertViewHas('carouselArt');  //verifies view has the variable, $carouselArt
    $this->assertViewHas('recentArt');    //verifies view has the variable, $recentArt
    $this->assertViewHas('soldArt');      //verifies view has the variable, $soldArt

    //verifies controller must pass variable $galleryArt which is an instance of Eloquent\Collection
    $galleryArt = $response->original->getData()['galleryArt'];
    $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $galleryArt);

    //verifies controller must pass variable $carouselArt which is an instance of Eloquent\Collection
    $carouselArt = $response->original->getData()['carouselArt'];
    $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $carouselArt);

    //verifies controller must pass variable $recentArt which is an instance of Eloquent\Collection
    $recentArt = $response->original->getData()['recentArt'];
    $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $recentArt);

    //verifies controller must pass variable $soldArt which is an instance of Eloquent\Collection
    $soldArt = $response->original->getData()['soldArt'];
    $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $soldArt);

  }

}