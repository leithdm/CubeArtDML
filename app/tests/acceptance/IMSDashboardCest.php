<?php

class IMSDashboardCest {

  public function seeNavigationLinksOnIMSDashboard(AcceptanceTester $I)
  {
    $I->am('An Administrator');
    $I->amGoingTo('see links to Inventory, Artists, Customers, Orders, Staff, Events, Art Gallery, Carousel, and Reports
    when I log into the IMS and I am presented with the initial dashboard.');
    $I->amOnPage('/ims/dashboard');
    $I->expect('to be redirected to ims/admin as I am not logged in.');
    $I->amOnPage('/admin');
    $I->fillField('username', 'admin');
    $I->fillField('password', 'admin');
    $I->click('Submit');
    $I->seeCurrentUrlEquals('/ims/dashboard');
    $I->canSee('Welcome Back!');
    $I->canSeeLink('Inventory', 'ims/arts');
    $I->canSeeLink('Artists', 'ims/artists');
    $I->canSeeLink('Customers', 'ims/customers');
    $I->canSeeLink('Orders', 'ims/orders');
    $I->canSeeLink('Staff', 'ims/employees');
    $I->canSeeLink('Events', 'ims/events');
    $I->canSeeLink('Art Gallery', 'ims/gallery');
    $I->canSeeLink('Carousel', 'ims/carousel');
    $I->canSeeLink('Reports', 'ims/reports');

  }



}
