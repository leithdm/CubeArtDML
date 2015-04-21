<?php

class IMSStaffCest {

  public function retrieveATableOfAllStaffMembers(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('navigate to the staff page of the IMS. I should see a table of all employees, with relevant details.
    First I am going to log into the IMS.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the inventory section of IMS located at /ims/employees');
    $I->amOnPage('/ims/employees');
    $I->expect('to see information regarding each employee in the database');
    $I->canSee('Thumbnail');
    $I->canSee('Employee#');
    $I->canSee('First Name');
    $I->canSee('Last Name');
    $I->canSee('City');
    $I->canSee('Country');
    $I->canSee('Email');
    $I->canSee('Phone#1');
    $I->canSee('Last Updated');
    $I->expect('to see a link to edit any employee item from the table. Here we will test the first art item');
    $I->canSeeLink('', 'ims/employees/1/edit'); //this is a link
    $I->expect('to see a glyph-icon to delete any employee item from the table. Here we will test whether we can see the icon');
    $I->canSeeElement(['class' => 'glyphicon-trash']); //this is a link
  }

  public function createANewEmployee(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new employee using the IMS. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the staff section of IMS located at /ims/employees');
    $I->amOnPage('/ims/employees');
    $I->click('Add a staff member');
    //filling out the form for creating a new employee
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
    $I->attachFile('picture', 'testArtistPicture.png');
    $I->click('Create the Staff Member!');
    //confirm that the newly created artist is present.
    $I->seeCurrentUrlEquals('/ims/employees');
    $I->canSee('Successfully created the Employee!');
    $I->click('Last Updated'); //filter the list based on 'last updated'
    $I->click('Last Updated'); //in order to put in desc mode
    $I->canSee('FirstNameTest');
    $I->canSee('LastNameTest');
    $I->canSee('CityTest');
    $I->canSee('CountryTest');
    $I->canSee('test@test.com');
    $I->canSee('+00-1234-56789');
  }

  public function createNewEmployeeWithoutFillingInAnyFormDetails(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new employee by trying to click create on a blank form. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the employee section of IMS located at /ims/employees');
    $I->amOnPage('/ims/employees');
    $I->click('Add a staff member');
    //just click create without filling in the form
    $I->click('Create the Staff Member!');
    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/employees/create');
    $I->canSee('The first name field is required.');
    $I->canSee('The second name field is required.');
    $I->canSee('The address1 field is required.');
    $I->canSee('The address2 field is required.');
    $I->canSee('The address3 field is required.');
    $I->canSee('The city field is required.');
    $I->canSee('The country field is required.');
    $I->canSee('The email field is required.');
  }

  public function createNewEmployeeUsingIncorrectDataTypes(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new employee using incorrect data types for the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the employee section of IMS located at /ims/employees');
    $I->amOnPage('/ims/employees');
    $I->click('Add a staff member');

    //use of incorrect data types for filling out the form.
    $I->fillField('email','test');
    $I->attachFile('picture', 'testExcelFile.xlsx');
    $I->click('Create the Staff Member!');

    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/employees/create');
    $I->canSee('The email must be a valid email address.');
    $I->canSee('The picture must be an image.');
  }

  public function editNewEmployee(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('edit an employee. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the employee section of IMS located at /ims/employees and click on the
    first employee in the test database.');
    $I->amOnPage('/ims/employees');
    $I->click(['class' => 'btn-info']); //click on link to show details of the first employee
    $I->seeCurrentUrlEquals('/ims/employees/1/edit'); //confirm on edit page of newly created artist
    $I->amGoingTo('perform edits');
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
    $I->attachFile('picture', 'testArtistPictureTwo.jpg');
    $I->click('Edit the Employee!');
    //confirm that the newly edited artist is present.
    $I->seeCurrentUrlEquals('/ims/employees');
    $I->canSee('Successfully updated the Employee!');
    $I->click('Last Updated'); //filter the list based on 'last updated'
    $I->click('Last Updated'); //in order to put in desc mode
    $I->canSee('FirstNameTestEdit');
    $I->canSee('LastNameTestEdit');
    $I->canSee('CityTestEdit');
    $I->canSee('CountryTestEdit'); $I->canSee('test@testedit.com'); $I->canSee('+00');
  }

  public function editEmployeeUsingIncorrectDataTypes(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('edit the first employee on list using incorrect data types for the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the employee section of IMS located at /ims/employees. I will edit the first employee');
    $I->amOnPage('/ims/employees');
    $I->click(['class' => 'btn-info']); //click on link to show details of the first employee
    $I->seeCurrentUrlEquals('/ims/employees/1/edit'); //confirm on edit page of newly created employee
    //use of incorrect data types for filling out the form.
    $I->fillField('email','test');
    $I->attachFile('picture', 'testExcelFile.xlsx');
    $I->click('Edit the Employee!');
    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/employees/1/edit');
    $I->canSee('The email must be a valid email address.');
    $I->canSee('The picture must be an image.');
  }

  public function deleteEmployee(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('delete an employee. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the employee section of IMS located at /ims/employees');
    $I->amOnPage('/ims/employees');
    $I->click(['class' => 'btn-danger']); //click on button to delete the first employee from the list
    $I->seeCurrentUrlEquals('/ims/employees'); //confirm still on index page of employees
    $I->canSee('Successfully deleted the Employee!');
  }
}
