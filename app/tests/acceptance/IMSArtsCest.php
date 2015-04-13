<?php

class IMSArtsCest {

  public function createANewArtItem(AcceptanceTester $I)
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
    $I->fillField('details','This is an acceptance test');
    $I->attachFile('picture', 'testArtPicture.jpg');
    $I->click('Add the item!');

    //confirm that the newly created art item is present.
    $I->seeCurrentUrlEquals('/ims/arts');
    $I->canSee('Successfully added the Art!');
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
    $I->canSee('The details field is required.');
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

  public function editNewArtItem(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('edit an art item. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/artists');
    $I->amOnPage('/ims/arts');
    $I->click('Last Updated');
    $I->click('Last Updated');
    $I->see('testCreateArt');
    $I->click(['class' => 'btn-info']); //click on link to show details of the art item
    $I->seeCurrentUrlEquals('/ims/arts/301/edit'); //confirm on edit page of newly created art item

    //perform edits
    $I->fillField('title','testCreateArtEdit');
    $I->fillField('subject','testSubjectEdit');
    $I->fillField('medium','testMediumEdit');
    $I->fillField('height','100');
    $I->fillField('width','100');
    $I->fillField('depth','100');
    $I->fillField('price','10000');
    $I->fillField('details','This is an acceptance test for editing an art item');
    $I->attachFile('picture', 'testArtPictureTwo.jpg');
    $I->click(['class' => 'btn-primary']);

    //confirm that the newly edited artist is present.
    $I->seeCurrentUrlEquals('/ims/arts');
    $I->canSee('Successfully updated the item of Art!');
    $I->click('Last Updated'); //filter the list based on 'last updated'
    $I->click('Last Updated'); //in order to put in desc mode
    $I->canSee('testCreateArtEdit');
    $I->canSee('testSubjectEdit');
    $I->canSee('testMediumEdit');
  }

  public function editArtItemUsingIncorrectDataTypes(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('edit the first art item on list using incorrect data types for the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/artists');
    $I->amOnPage('/ims/arts');
    $I->click(['class' => 'btn-info']); //click on link to show details of the first art item
    $I->seeCurrentUrlEquals('/ims/arts/1/edit'); //confirm on edit page of first art item

    //use of incorrect data types for filling out the form.
    $I->fillField('height','testEdit');
    $I->fillField('width','testEdit');
    $I->fillField('depth','testEdit');
    $I->fillField('price','testEdit');
    $I->attachFile('picture', 'testExcelFile.xlsx');
    $I->click(['class' => 'btn-primary']);

    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/arts/1/edit');
    $I->canSee('The height must be a number.');
    $I->canSee('The width must be a number.');
    $I->canSee('The depth must be a number.');
    $I->canSee('The price must be a number.');
    $I->canSee('The picture must be an image.');
  }

  public function deleteArtItem(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('delete an art item. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/arts');
    $I->amOnPage('/ims/arts');
    $I->click(['class' => 'btn-danger']); //click on button to delete the first art item from the list
    $I->seeCurrentUrlEquals('/ims/arts'); //confirm still on index page of art items
    $I->canSee('Successfully deleted the item of Art!');
  }

}
