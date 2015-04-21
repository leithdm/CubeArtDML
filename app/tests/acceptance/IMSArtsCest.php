<?php

class IMSArtsCest {

  public function retrieveATableOfAllArtItems(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('navigate to the inventory page of the IMS. I should see a table of all art items, with relevant details.
    First I am going to log into the IMS.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/arts');
    $I->amOnPage('/ims/arts');
    $I->expect('to see information regarding each art item in the database');
    $I->canSee('Thumbnail');
    $I->canSee('Art#');
    $I->canSee('Status');
    $I->canSee('Artist');
    $I->canSee('Year');
    $I->canSee('Title');
    $I->canSee('Category');
    $I->canSee('Subject');
    $I->canSee('Medium');
    $I->canSee('H(in)');
    $I->canSee('W(in)');
    $I->canSee('D(in)');
    $I->canSee('Last Updated');
    $I->expect('to see a link to edit any art item from the table. Here we will test the first art item');
    $I->canSeeLink('', 'ims/arts/1/edit'); //this is a link
    $I->expect('to see a glyph-icon to delete any art item from the table. Here we will test whether we can see the icon');
    $I->canSeeElement(['class' => 'glyphicon-trash']); //this is a link
  }

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
    //filling out the form. Note: we have already migrated a test database, with some preset artists.
    $I->amGoingTo('choose the first artist from the test database');
    $I->selectOption('artist','1');
    $I->selectOption('status','Available'); //by default the status is set to available
    $I->selectOption('category','Painting');
    $I->selectOption('year','1980');
    $I->fillField('title','testCreateArt');
    $I->fillField('subject','testSubject');
    $I->fillField('medium','testMedium');
    $I->fillField('height','1');
    $I->fillField('width','11');
    $I->fillField('depth','12');
    $I->fillField('price','5000');
    $I->fillField('details','This is an acceptance test');
    $I->attachFile('picture', 'testArtPicture.jpg'); //test picture
    $I->click('Add the item!');
    $I->amGoingTo('confirm that the newly created art item is present in the database');
    $I->seeCurrentUrlEquals('/ims/arts');
    $I->canSee('Successfully added the Art!');
    $I->click('Last Updated'); //filter the list based on 'last updated'
    $I->click('Last Updated'); //in order to put in desc mode
    $I->canSee('testCreateArt');
    $I->canSee('testSubject');
    $I->canSee('testMedium');
    $I->canSee('1.00'); //height with decimals
    $I->canSee('5,000'); //the price
  }

  public function createNewArtItemWithoutFillingInAnyFormFields(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('try to create a new art inventory item without filling in any of the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/arts');
    $I->amOnPage('/ims/arts');
    $I->click('Add an item');
    $I->amGoingTo('try to create a new art inventory item by clicking create without filling in the form');
    $I->click('Add the item!');
    //confirm that field validation is working
    $I->expect('to see field validation messages');
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
    $I->click(['class' => 'btn-info']); //click on link to show details of the art item
    $I->seeCurrentUrlEquals('/ims/arts/1/edit'); //confirm on edit page of newly created art item
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
    //confirm that the newly edited art item is present.
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
    $I->attachFile('picture', 'testExcelFile.xlsx'); //use of an excel file instead of an image
    $I->click(['class' => 'btn-primary']);
    //confirm that field validation is working
    $I->expect('to see field validation errors');
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
