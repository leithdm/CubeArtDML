<?php

class IMSArtsCest {

  public function createANewArtInventoryItem(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new art inventory item using the IMS. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/arts');
    $I->amOnPage('/ims/arts');
    $I->click('Add an item');

    //filling out the form. Note: we have already migrated a database, with preset artists.
    $I->selectOption('artist','1');
    $I->selectOption('status','Available');
    $I->selectOption('category','Painting');
    $I->selectOption('year','1980');
    $I->fillField('title','testTitle');
    $I->fillField('subject','testSubject');
    $I->fillField('medium','testMedium');
    $I->fillField('height','1');
    $I->fillField('width','1');
    $I->fillField('depth','1');
    $I->fillField('price','1');
    $I->fillField('descriptionTextArea','abc');
    $I->click('Add the item!');

    //confirm that the newly created item is present
    $I->amOnPage('/ims/arts');
    $I->click('Art#');
    $I->canSee('Howdy, admin');
  }



}
