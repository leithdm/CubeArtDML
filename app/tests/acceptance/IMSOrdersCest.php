<?php

class IMSOrdersCest {

  public function retrieveATableOfAllOrders(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('navigate to the orders page of the IMS. I should see a table of all orders, with relevant details.
    First I am going to log into the IMS.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the orders section of IMS located at /ims/orders');
    $I->amOnPage('/ims/orders');
    $I->expect('to see information regarding each orders in the database');
    $I->canSee('Art Item');
    $I->canSee('P.O#');
    $I->canSee('Art#');
    $I->canSee('Customer');
    $I->canSee('Total Cost (€)');
    $I->canSee('Date of P.O');
    $I->canSee('Last Updated');
    $I->expect('to see a link to edit any orders item from the table. Here we will test the first order');
    $I->canSeeLink('', 'ims/orders/1/edit'); //this is a link
    $I->expect('to see a glyph-icon to delete any order from the table. Here we will test whether we can see the icon');
    $I->canSeeElement(['class' => 'glyphicon-trash']); //this is a link
  }

  public function createANewOrder(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new order using the IMS. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the order section of IMS located at /ims/orders');
    $I->amOnPage('/ims/orders');
    $I->click('Add an order');
    //filling out the form for creating a new order
    $I->selectOption('artItem','1');
    $I->selectOption('customer', '1');
    $I->fillField('sellingPrice', '10000');
    $I->click('Create the Purchase Order!');
    //confirm that the newly created order is present.
    $I->seeCurrentUrlEquals('/ims/orders');
    $I->canSee('Successfully added the Order!');
    $I->canSee('P.O#');
    $I->canSee('1');
    $I->canSee('Art#');
    $I->canSee('Customer');
    $I->canSee('Total Cost (€)');
    $I->canSee('10,000');
    $I->canSee('Date of P.O');
  }

  public function createNewOrderWithoutFillingInAnyFormDetails(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new order by trying to click create on a blank form. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the order section of IMS located at /ims/orders');
    $I->amOnPage('/ims/orders');
    $I->click('Add an order');

    //just click create without filling in the form
    $I->click('Create the Purchase Order!');

    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/orders/create');
    $I->canSee('The customer field is required.');
    $I->canSee('The art item field is required.');
    $I->canSee('The selling price field is required.');
  }

  public function createNewOrderUsingIncorrectDataTypes(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('create a new order using incorrect data types for the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the order section of IMS located at /ims/orders');
    $I->amOnPage('/ims/orders');
    $I->click('Add an order');
    //use of incorrect data types for filling out the form.
    $I->fillField('sellingPrice', 'test');
    $I->click('Create the Purchase Order!');
    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/orders/create');
    $I->canSee('The selling price must be a number.');
  }

  public function editNewOrder(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('edit a order. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the order section of IMS located at /ims/orders');
    $I->amOnPage('/ims/orders');
    $I->click(['class' => 'btn-info']); //click on link to show details of the order
    $I->seeCurrentUrlEquals('/ims/orders/1/edit'); //confirm on edit page of newly created order

    //filling out the form for creating a new order
    $I->selectOption('artItem','2');
    $I->selectOption('customer', '2');
    $I->fillField('sellingPrice', '20000');
    $I->click('Edit the Purchase Order');

    //confirm that the newly created order is present.
    $I->seeCurrentUrlEquals('/ims/orders');
    $I->canSee('Successfully updated the Order!');
    $I->canSee('P.O#');
    $I->canSee('1');
    $I->canSee('Art#');
    $I->canSee('Customer');
    $I->canSee('Total Cost (€)');
    $I->canSee('20,000');
    $I->canSee('Date of P.O');
  }

  public function editOrderUsingIncorrectDataTypes(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('edit the first order on list using incorrect data types for the form fields. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the order section of IMS located at /ims/orders');
    $I->amOnPage('/ims/orders');
    $I->click(['class' => 'btn-info']); //click on link to show details of the first order
    $I->seeCurrentUrlEquals('/ims/orders/1/edit'); //confirm on edit page of newly created order

    //use of incorrect data types for filling out the form.
    $I->fillField('sellingPrice', 'testEdit');
    $I->click('Edit the Purchase Order');

    //confirm that field validation is working
    $I->seeCurrentUrlEquals('/ims/orders/1/edit');
    $I->canSee('The selling price must be a number.');
  }

  public function deleteOrder(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('delete a order. I will login to the IMS first.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->amGoingTo('navigate to the order section of IMS located at /ims/orders');
    $I->amOnPage('/ims/orders');
    $I->click(['class' => 'btn-danger']); //click on button to delete the first order from the list
    $I->seeCurrentUrlEquals('/ims/orders'); //confirm still on index page of orders
    $I->canSee('Successfully deleted the P.O!');
  }
}
