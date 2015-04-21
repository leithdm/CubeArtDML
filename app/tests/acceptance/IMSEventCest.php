<?php

class IMSEventCest {


  public function retrieveATableOfAllEvents(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('navigate to the events page of the IMS. I should see a table of all events, with relevant details.
    First I am going to log into the IMS.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the events section of IMS located at /ims/events');
    $I->amOnPage('/ims/events');
    $I->expect('to see information regarding each event in the database');
    $I->canSee('Thumbnail');
    $I->canSee('Event#');
    $I->canSee('Title');
    $I->canSee('Date of Event');
    $I->canSee('Last Updated');
    $I->expect('to see a link to edit any event item from the table. Here we will test the first art item');
    $I->canSeeLink('', 'ims/events/1/edit'); //this is a link
    $I->expect('to see a glyph-icon to delete any event item from the table. Here we will test whether we can see the icon');
    $I->canSeeElement(['class' => 'glyphicon-trash']); //this is a link
  }


  public function createANewEvent(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new event using the IMS. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the event section of IMS located at /ims/events');
    $I->amOnPage('/ims/events');
    $I->click('Add an event');
    //filling out the form for creating a new event
    $I->fillField('title','TitleTest');
    $I->fillField('date','2015/04/14 12:00');
    $I->fillField('about','TestAbout');
    $I->attachFile('picture', 'testArtistPicture.png');
    $I->click('Create the Event!');
    //confirm that the newly created event is present.
    $I->seeCurrentUrlEquals('/ims/events');
    $I->canSee('Successfully created the Event!');
    $I->click('Last Updated'); //filter the list based on 'last updated'
    $I->click('Last Updated'); //in order to put in desc mode
    $I->canSee('TitleTest');
  }

  public function createNewEventWithoutFillingInAnyFormDetails(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new event by trying to click create on a blank form. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the event section of IMS located at /ims/events');
    $I->amOnPage('/ims/events');
    $I->click('Add an event');
    //just click create without filling in the form
    $I->click('Create the Event!');
    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/events/create');
    $I->canSee('The title field is required.');
    $I->canSee('The about field is required.');
  }

  public function createNewEventUsingIncorrectDataTypes(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new event using incorrect data types for the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the event section of IMS located at /ims/events');
    $I->amOnPage('/ims/events');
    $I->click('Add an event');
    //use of incorrect data types for filling out the form.
    $I->fillField('date','testDate');
    $I->attachFile('picture', 'testExcelFile.xlsx');
    $I->click('Create the Event!');
    //confirm that field validation is working
    $I->expect('the "testDate" text for the date will be overwritten by a default date value, and a validation error will
    not be triggered.');
    $I->seeCurrentUrlEquals('/ims/events/create');
    $I->canSee('The picture must be an image.');
  }

  public function editNewEvent(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('edit an event. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the event section of IMS located at /ims/events');
    $I->amOnPage('/ims/events');
    $I->click(['class' => 'btn-info']); //click on link to show details of the event
    $I->seeCurrentUrlEquals('/ims/events/1/edit'); //confirm on edit page of newly created event
    //perform edits
    $I->fillField('title','TitleTestEdit');
    $I->fillField('date','2015/04/13 12:00');
    $I->fillField('about','TestAboutEdit');
    $I->attachFile('picture', 'testArtistPictureTwo.jpg');
    $I->click('Edit the Event!');
    //confirm that the newly created event is present.
    $I->seeCurrentUrlEquals('/ims/events');
    $I->canSee('Successfully updated the Event!');
    $I->click('Last Updated'); //filter the list based on 'last updated'
    $I->click('Last Updated'); //in order to put in desc mode
    $I->canSee('TitleTestEdit');
    $I->canSee('TestAboutEdit');
    $I->canSee('13-Apr-2015 12:00 pm');
  }

  public function editEventUsingIncorrectDataTypes(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('edit the first event on list using incorrect data types for the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the event section of IMS located at /ims/events');
    $I->amOnPage('/ims/events');
    $I->click(['class' => 'btn-info']); //click on link to show event of the first employee
    $I->seeCurrentUrlEquals('/ims/events/1/edit'); //confirm on edit page of newly created employee

    //use of incorrect data types for filling out the form.
    $I->fillField('date','testDateEdit');
    $I->attachFile('picture', 'testExcelFile.xlsx');
    $I->click('Edit the Event!');

    //confirm that field validation is working
    $I->expect('the "testDateEdit" text for the date will be overwritten by a default date value, and a validation error will
    not be triggered.');
    $I->seeCurrentUrlEquals('/ims/events/1/edit');
    $I->canSee('The picture must be an image.');
  }

  public function deleteEvent(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('delete an event. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the event section of IMS located at /ims/events');
    $I->amOnPage('/ims/events');
    $I->click(['class' => 'btn-danger']); //click on button to delete the first event from the list
    $I->seeCurrentUrlEquals('/ims/events'); //confirm still on index page of event
    $I->canSee('Successfully deleted the Event!');
  }
}
