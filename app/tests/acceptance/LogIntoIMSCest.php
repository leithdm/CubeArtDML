<?php

class LogIntoIMSCest {

  public function logIntoIMSAndSeeWelcomeMessage(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to IMS with a valid username and password.
    I should be directed to /ims/dashboard with a welcome message and a logged in message');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->see('Welcome Back!');
    $I->see('You are now logged in');
  }

  public function bePresentedWithAnIMSLoginPage(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('navigate to "http://localhost:8888/admin", which will be a login page to the IMS.');
    $I->amOnPage('/admin');
    $I->see('Login to IMS');
    $I->see('Username');
    $I->see('Password');
    //will perform a number of attempts to access parts of the ims by typing them in directly into browser
    $I->amGoingTo('try and access "http://localhost:8888/ims/dashboard. I expect to be redirected back to the IMS login page as I am
    not authenticated.');
    $I->amOnPage('/ims/dashboard');
    $I->seeCurrentUrlEquals('/admin'); //back to login Page
    $I->amGoingTo('try and access "http://localhost:8888/ims/arts. I expect to be redirected back to the IMS login page as I am
    not authenticated.');
    $I->amOnPage('/ims/arts');
    $I->seeCurrentUrlEquals('/admin'); //back to login Page
    $I->amGoingTo('try and access "http://localhost:8888/ims/artists. I expect to be redirected back to the IMS login page as I am
    not authenticated.');
    $I->amOnPage('/ims/artists');
    $I->seeCurrentUrlEquals('/admin'); //back to login Page
    $I->amGoingTo('try and access "http://localhost:8888/ims/orders. I expect to be redirected back to the IMS login page as I am
    not authenticated.');
    $I->amOnPage('/ims/orders');
    $I->seeCurrentUrlEquals('/admin'); //back to login Page
    $I->amGoingTo('try and access "http://localhost:8888/ims/customers. I expect to be redirected back to the IMS login page as I am
    not authenticated.');
    $I->amOnPage('/ims/customers');
    $I->seeCurrentUrlEquals('/admin'); //back to login Page
  }

  public function logOutOfIMS(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to IMS with a valid username and password. I then want to logout and see a logged out message');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->see('Welcome Back!');
    $I->see('You are now logged in');
    $I->click('Logout');
    $I->seeCurrentUrlEquals('');
    $I->see('See you next time!');
    $I->see('You are now logged out');
  }

  public function logInWithWrongPassword(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to ims with an invalid password. When logging into the IMS I should be shown helpful validation messages
    if I enter in the wrong password');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin'); //this is a valid username
    $I->fillField('password', 'incorrectPassword'); //this is an invalid password. The password should be "admin"
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/admin');
    $I->see('Invalid credentials'); //flash message stating "Invalid Credentials"
  }

  public function logInWithWrongUsername(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to ims with an incorrect username. When logging into the IMS I should be shown helpful validation messages
    if I enter an incorrect username');
    $I->amOnPage('/admin');
    $I->fillField('username', 'incorrectUsername'); //this is an invalid username. The username should be "admin"
    $I->fillField('password', 'admin'); //this is a valid password
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/admin');
    $I->see('Invalid credentials'); //flash message stating "Invalid Credentials"
  }

  public function logInWithUsernameButNoPassword(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to IMS with a username but no password. When logging into the IMS I should be shown helpful validation messages
    if I dont enter a password');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin'); //this is a valid username. The password field has not be filled in.
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/admin');
    $I->see('The password field is required'); //flash message stating "password is required"
  }

  public function logInWithoutUsernameOrPassword(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to IMS without filling in a username or password. When logging into the IMS I should be shown helpful validation messages
    if I try to login without inputting a username or password');
    $I->amOnPage('/admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/admin');
    $I->see('The password field is required'); //flash message
    $I->see('The username field is required.'); //flash message
  }

}
