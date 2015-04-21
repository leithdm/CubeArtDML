<?php

class IMSGalleryCest {

  public function changeTheDefaultGalleryImages(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('change all twelve of the default gallery images using the IMS. This test will change all 12 of the
    gallery images to different art items. We begin by logging into the IMS.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/arts');
    $I->amOnPage('/ims/gallery');
    //change the 1st gallery image
    $I->amGoingTo('change the 1st gallery image to a different art inventory item.');
    $I->click('picture1');
    $I->seeCurrentUrlEquals('/ims/gallery/1/edit');
    $I->selectOption('radio', '1'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#1) in the first position of the gallery');
    $I->see('Art#1');
    //change the 2nd gallery image
    $I->amGoingTo('change the 2nd gallery image to a different art inventory item.');
    $I->click('picture2');
    $I->seeCurrentUrlEquals('/ims/gallery/2/edit');
    $I->selectOption('radio', '2'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#2) in the first position of the gallery');
    $I->see('Art#2');
    //change the 3rd gallery image
    $I->amGoingTo('change the 3rd gallery image to a different art inventory item.');
    $I->click('picture3');
    $I->seeCurrentUrlEquals('/ims/gallery/3/edit');
    $I->selectOption('radio', '3'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#3) in the first position of the gallery');
    $I->see('Art#3');
    //change the 4th gallery image
    $I->amGoingTo('change the 4th gallery image to a different art inventory item.');
    $I->click('picture4');
    $I->seeCurrentUrlEquals('/ims/gallery/4/edit');
    $I->selectOption('radio', '4'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#4) in the first position of the gallery');
    $I->see('Art#4');
    //change the 5th gallery image
    $I->amGoingTo('change the 5th gallery image to a different art inventory item.');
    $I->click('picture5');
    $I->seeCurrentUrlEquals('/ims/gallery/5/edit');
    $I->selectOption('radio', '5'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#5) in the first position of the gallery');
    $I->see('Art#5');
    //change the 6th gallery image
    $I->amGoingTo('change the 6th gallery image to a different art inventory item.');
    $I->click('picture6');
    $I->seeCurrentUrlEquals('/ims/gallery/6/edit');
    $I->selectOption('radio', '6'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#6) in the first position of the gallery');
    $I->see('Art#6');
    //change the 7th gallery image
    $I->amGoingTo('change the 7th gallery image to a different art inventory item.');
    $I->click('picture7');
    $I->seeCurrentUrlEquals('/ims/gallery/7/edit');
    $I->selectOption('radio', '7'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#7) in the first position of the gallery');
    $I->see('Art#7');
    //change the 8th gallery image
    $I->amGoingTo('change the 8th gallery image to a different art inventory item.');
    $I->click('picture8');
    $I->seeCurrentUrlEquals('/ims/gallery/8/edit');
    $I->selectOption('radio', '8'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#8) in the first position of the gallery');
    $I->see('Art#8');
    //change the 9th gallery image
    $I->amGoingTo('change the 9th gallery image to a different art inventory item.');
    $I->click('picture9');
    $I->seeCurrentUrlEquals('/ims/gallery/9/edit');
    $I->selectOption('radio', '9'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#9) in the first position of the gallery');
    $I->see('Art#9');
    //change the 10th gallery image
    $I->amGoingTo('change the 10th gallery image to a different art inventory item.');
    $I->click('picture10');
    $I->seeCurrentUrlEquals('/ims/gallery/10/edit');
    $I->selectOption('radio', '10'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#10) in the first position of the gallery');
    $I->see('Art#10');
    //change the 11th gallery image
    $I->amGoingTo('change the 11th gallery image to a different art inventory item.');
    $I->click('picture11');
    $I->seeCurrentUrlEquals('/ims/gallery/11/edit');
    $I->selectOption('radio', '11'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#11) in the first position of the gallery');
    $I->see('Art#11');
    //change the 12th gallery image
    $I->amGoingTo('change the 12th gallery image to a different art inventory item.');
    $I->click('picture12');
    $I->seeCurrentUrlEquals('/ims/gallery/12/edit');
    $I->selectOption('radio', '12'); //select a different art item for the gallery
    $I->click(['class' => 'btn-info']); //click on save button
    $I->seeCurrentUrlEquals('/ims/gallery'); //back on the gallery page. Edit has passed.
    $I->expect('to see a new Art item (Art#12) in the first position of the gallery');
    $I->see('Art#12');
  }
}
