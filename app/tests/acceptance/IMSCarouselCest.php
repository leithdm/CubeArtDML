<?php

class IMSCarouselCest {

  public function changeTheDefaultCarouselImages(AcceptanceTester $I) {
    $I->am('An Administrator');
    $I->amGoingTo('change all three of the default carousel images using the IMS. This test will change all 3 of the
    carousel images to different art items. We begin by logging into the IMS.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/arts');
    $I->amOnPage('/ims/carousel');
    //change the 1st carousel image
    $I->amGoingTo('change the first carousel image to a different art inventory item.');
    $I->click('picture1');
    $I->seeCurrentUrlEquals('/ims/carousel/1/edit');
    $I->selectOption('radio', '5'); //select a different art item for the carousel
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/carousel'); //back on the carousel page. Edit has passed.
    $I->expect('to see a new Art item (Art#5) in the first position of the carousel');
    $I->see('Art#5');
    //change the 2nd carousel image
    $I->amGoingTo('change the second carousel image to a different art inventory item.');
    $I->click('picture2');
    $I->seeCurrentUrlEquals('/ims/carousel/2/edit');
    $I->selectOption('radio', '10'); //select a different art item for the carousel
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/carousel'); //back on the carousel page. Edit has passed.
    $I->expect('to see a new Art item (Art#10) in the second position of the carousel');
    $I->see('Art#10');
    //change the 3rd carousel image
    $I->amGoingTo('change the third carousel image to a different art inventory item.');
    $I->click('picture3');
    $I->seeCurrentUrlEquals('/ims/carousel/3/edit');
    $I->selectOption('radio', '15'); //select a different art item for the carousel
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/carousel'); //back on the carousel page. Edit has passed.
    $I->expect('to see a new Art item (Art#15) in the third position of the carousel');
    $I->see('Art#15');
  }
}
