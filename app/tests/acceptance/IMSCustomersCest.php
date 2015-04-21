<?php

class IMSCustomersCest {

  public function retrieveATableOfAllCustomers(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('navigate to the customers page of the IMS. I should see a table of all customers, with relevant details.
    First I am going to log into the IMS.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the customers section of IMS located at /ims/customers');
    $I->amOnPage('/ims/customers');
    $I->expect('to see information regarding each customer in the database');
    $I->canSee('Customer#');
    $I->canSee('First Name');
    $I->canSee('Last Name');
    $I->canSee('City');
    $I->canSee('Country');
    $I->canSee('Phone#1');
    $I->canSee('Email');
    $I->canSee('Last Updated');
    $I->expect('to see a link to edit any customer item from the table. Here we will test the first customer');
    $I->canSeeLink('', 'ims/customers/1/edit'); //this is a link
    $I->expect('to see a glyph-icon to delete any customer from the table. Here we will test whether we can see the icon');
    $I->canSeeElement(['class' => 'glyphicon-trash']); //this is a link
  }

  public function createANewCustomer(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new customer using the IMS. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the customer section of IMS located at /ims/customers');
    $I->amOnPage('/ims/customers');
    $I->click('Add a customer');
    //filling out the form for creating a new customer
    $I->fillField('first_name','FirstNameTest');
    $I->fillField('middle_name','MiddleNameTest');
    $I->fillField('second_name','LastNameTest');
    $I->fillField('address1','Address1Test');
    $I->fillField('address2','Address2Test');
    $I->fillField('address3','Address3Test');
    $I->fillField('city','CityTest');
    $I->fillField('country','CountryTest');
    $I->fillField('email','test@test.com');
    $I->fillField('phone1','+00-1234-56789');
    $I->fillField('phone2','+00-1234-56789');
    $I->click('Create the Customer!');
    //confirm that the newly created customer is present.
    $I->seeCurrentUrlEquals('/ims/customers');
    $I->canSee('Successfully created the Customer!');
    $I->click('Last Updated'); //filter the list based on 'last updated'
    $I->click('Last Updated'); //in order to put in desc mode
    $I->canSee('FirstNameTest');
    $I->canSee('LastNameTest');
    $I->canSee('CityTest');
    $I->canSee('CountryTest');
    $I->canSee('test@test.com');
    $I->canSee('+00-1234-56789');
  }

  public function createNewCustomerWithoutFillingInAnyFormDetails(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new customer by trying to click create on a blank form. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the customer section of IMS located at /ims/customers');
    $I->amOnPage('/ims/customers');
    $I->click('Add a customer');
    //just click create without filling in the form
    $I->click('Create the Customer!');
    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/customers/create');
    $I->canSee('The first name field is required.');
    $I->canSee('The second name field is required.');
    $I->canSee('The address1 field is required.');
    $I->canSee('The address2 field is required.');
    $I->canSee('The address3 field is required.');
    $I->canSee('The city field is required.');
    $I->canSee('The country field is required.');
    $I->canSee('The email field is required.');
  }

  public function createNewCustomerUsingIncorrectDataTypes(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new customer using incorrect data types for the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the customer section of IMS located at /ims/customers');
    $I->amOnPage('/ims/customers');
    $I->click('Add a customer');

    //use of incorrect data types for filling out the form.
    $I->fillField('email','test');
    $I->click('Create the Customer!');

    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/customers/create');
    $I->canSee('The email must be a valid email address.');
  }

  public function editNewCustomer(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('edit a customer. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the customer section of IMS located at /ims/customers and edit the first customer');
    $I->amOnPage('/ims/customers');
    $I->click(['class' => 'btn-info']); //click on link to show details of the customer
    $I->seeCurrentUrlEquals('/ims/customers/1/edit'); //confirm on edit page of newly created artist
    //perform edits
    $I->fillField('first_name','FirstNameTestEdit');
    $I->fillField('middle_name','MiddleNameTestEdit');
    $I->fillField('second_name','LastNameTestEdit');
    $I->fillField('address1','Address1TestEdit');
    $I->fillField('address2','Address2TestEdit');
    $I->fillField('address3','Address3TestEdit');
    $I->fillField('city','CityTestEdit');
    $I->fillField('country','CountryTestEdit');
    $I->fillField('email','test@testedit.com');
    $I->fillField('phone1','+00');
    $I->fillField('phone2','+00-1');
    $I->click('Edit the Customer!');
    //confirm that the newly edited artist is present.
    $I->seeCurrentUrlEquals('/ims/customers');
    $I->canSee('Successfully updated the Customer!');
    $I->click('Last Updated'); //filter the list based on 'last updated'
    $I->click('Last Updated'); //in order to put in desc mode
    $I->canSee('FirstNameTestEdit');
    $I->canSee('LastNameTestEdit');
    $I->canSee('CityTestEdit');
    $I->canSee('CountryTestEdit');
    $I->canSee('test@testedit.com');
    $I->canSee('+00');
  }

  public function editCustomerUsingIncorrectDataTypes(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('edit the first customer on list using incorrect data types for the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the customer section of IMS located at /ims/customers');
    $I->amOnPage('/ims/customers');
    $I->click(['class' => 'btn-info']); //click on link to show details of the first employee
    $I->seeCurrentUrlEquals('/ims/customers/1/edit'); //confirm on edit page of newly created employee

    //use of incorrect data types for filling out the form.
    $I->fillField('email','testedit');
    $I->click('Edit the Customer!');

    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/customers/1/edit');
    $I->canSee('The email must be a valid email address.');
  }

  public function deleteCustomer(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('delete a customer. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the customer section of IMS located at /ims/customers');
    $I->amOnPage('/ims/customers');
    $I->click(['class' => 'btn-danger']); //click on button to delete the first customer from the list
    $I->seeCurrentUrlEquals('/ims/customers'); //confirm still on index page of customers
    $I->canSee('Successfully deleted the Customer!');
  }
}
