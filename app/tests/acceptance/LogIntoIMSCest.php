<?php

class LogIntoIMSCest {

  public function logInWithProperCredentials(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to ims with a valid username and password. I should be directed to /ims/dashboard with a welcome message
    and a logged in message');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->see('Welcome Back!');
    $I->see('You are now logged in');
  }

  public function logInWithWrongPassword(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to ims with an invalid password. When logging into the IMS I should be shown helpful validation messages
    if I enter in the wrong password');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'incorrectPassword');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/admin');
    $I->see('Invalid credentials');
  }

  public function logInWithWrongUsername(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to ims with an incorrect username. When logging into the IMS I should be shown helpful validation messages
    if I enter in the wrong password');
    $I->amOnPage('/admin');
    $I->fillField('username', 'incorrectUsername');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/admin');
    $I->see('Invalid credentials');
  }

  public function logInWithUsernameButNoPassword(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to ims with a username but no password. When logging into the IMS I should be shown helpful validation messages
    if I enter in the wrong password');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/admin');
    $I->see('The password field is required');
  }

  public function logInWithoutUsernameOrPassword(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('sign in to ims without filling in a username or password. When logging into the IMS I should be shown helpful validation messages
    if I enter in the wrong password');
    $I->amOnPage('/admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/admin');
    $I->see('The password field is required');
    $I->see('The username field is required.');
  }

}
