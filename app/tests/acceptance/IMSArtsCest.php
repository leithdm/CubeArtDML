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
    $I->fillField('title','testCreateArt');
    $I->fillField('subject','testSubject');
    $I->fillField('medium','testMedium');
    $I->fillField('height','1');
    $I->fillField('width','1');
    $I->fillField('depth','1');
    $I->fillField('price','5000');
    $I->fillField('descriptionTextArea','This is an acceptance test');
    $I->attachFile('picture', 'testArtPicture.jpg');
    $I->click('Add the item!');

    //confirm that the newly created art item is present.
    $I->amOnPage('/ims/arts');
    $I->click('Last Updated'); //filter the list based on 'last updated'
    $I->click('Last Updated'); //in order to put in desc mode
    $I->canSee('testCreateArt');
    $I->canSee('testSubject');
    $I->canSee('testMedium');
    $I->canSee('1.00');
    $I->canSee('5,000');
  }

  public function createNewArtItemWithoutFillingInAnyFormFields(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new art inventory item without filling in any of the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/arts');
    $I->amOnPage('/ims/arts');
    $I->click('Add an item');

    //just click create without filling in the form
    $I->click('Add the item!');

    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/arts/create');
    $I->canSee('The artist field is required.');
    $I->canSee('The title field is required.');
    $I->canSee('The subject field is required.');
    $I->canSee('The medium field is required.');
    $I->canSee('The height field is required.');
    $I->canSee('The width field is required.');
    $I->canSee('The depth field is required.');
    $I->canSee('The price field is required.');
    $I->canSee('The description text area field is required.');
  }

  public function createNewArtItemUsingIncorrectDataTypes(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('try to create a new art inventory using incorrect data types for the fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/arts');
    $I->amOnPage('/ims/arts');
    $I->click('Add an item');

    //use of incorrect data types for filling out the form.
    $I->fillField('height','test');
    $I->fillField('width','test');
    $I->fillField('depth','test');
    $I->fillField('price','test');
    $I->attachFile('picture', 'testExcelFile.xlsx');
    $I->click('Add the item!');

    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/arts/create');
    $I->canSee('The height must be a number.');
    $I->canSee('The width must be a number.');
    $I->canSee('The depth must be a number.');
    $I->canSee('The price must be a number.');
    $I->canSee('The picture must be an image.');
  }


//  public function editNewArtInventoryItem(AcceptanceTester $I)
//  {
//    $I->am('An Administrator');
//    $I->amGoingTo('create a new art inventory item using the IMS and then edit it. I will login to the IMS first.');
//    $I->amOnPage('/admin');
//    $I->fillField('username', 'admin');
//    $I->fillField('password', 'admin');
//    $I->click('Submit');
//    $I->seeCurrentUrlEquals('/ims/dashboard');
//    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/arts');
//    $I->amOnPage('/ims/arts');
//    $I->click('Add an item');
//
//    //filling out the form. Note: we have already migrated a database, with preset artists.
//    $I->selectOption('artist','1');
//    $I->selectOption('status','Available');
//    $I->selectOption('category','Painting');
//    $I->selectOption('year','2015');
//    $I->fillField('title','testTitleEditNewArtItem');
//    $I->fillField('subject','testSubjectEditNewArtItem');
//    $I->fillField('medium','testMediumEditNewArtItem');
//    $I->fillField('height','10');
//    $I->fillField('width','10');
//    $I->fillField('depth','10');
//    $I->fillField('price','10000');
//    $I->fillField('descriptionTextArea','This is an acceptance test');
//    $I->attachFile('picture', 'testArtPicture.jpg');
//    $I->click('Add the item!');
//
//    //confirm that the newly created art item is present.
//    $I->amOnPage('/ims/arts');
//    $I->click('Last Updated'); //filter the list based on 'last updated'
//    $I->click('Last Updated'); //in order to put in desc mode
//    $I->canSee('testCreateArt');
//    $I->canSee('testSubject');
//    $I->canSee('testMedium');
//    $I->canSee('1.00');
//    $I->canSee('5,000');
//  }


}
