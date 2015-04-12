<?php


$I = new FunctionalTester($scenario);
$I->am('An Administrator');
$I->wantTo('sign in to ims with a valid account');
$I->amOnPage('/admin');
$I->fillField('username', 'admin');
$I->fillField('password', 'admin');
$I->click('Submit');
$I->see('Welcome Back!');
$I->seeRecord('users', array('email' => 'admin@admin.com'));


//$I = new FunctionalTester($scenario);
//$I->am('An Administrator');
//$I->amGoingTo('sign in to ims with an invalid password');
//$I->amOnPage('/admin');
//$I->fillField('username', 'admin');
//$I->fillField('password', 'incorrectPassword');
//$I->click('Submit');
//$I->expect('to see a message regarding invalid credentials');
//$I->see('Invalid credentials');
//
//
//$I = new FunctionalTester($scenario);
//$I->am('An Administrator');
//$I->wantTo('sign in to ims with an invalid username');
//$I->amOnPage('/admin');
//$I->fillField('username', 'incorrectUsername');
//$I->fillField('password', 'admin');
//$I->click('Submit');
//$I->see('Invalid credentials');
//
//
//$I = new FunctionalTester($scenario);
//$I->am('An Administrator');
//$I->wantTo('sign in to ims with a username but no password');
//$I->amOnPage('/admin');
//$I->fillField('username', 'incorrectUsername');
//$I->click('Submit');
//$I->see('The password field is required');