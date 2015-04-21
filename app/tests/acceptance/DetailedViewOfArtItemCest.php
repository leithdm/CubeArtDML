<?php

class DetailedViewOfArtItemCest {

  public function viewDetailedArtItem(AcceptanceTester $I)
  {
    $I->am('A shopper');
    $I->amGoingTo('visit a detailed page view of an art item e.g. the first art-item in the database.
    I expect to see a link to MORE BY this artist, and items YOU MIGHT LIKE');
    $I->amOnPage('art/Drawing/1');
    $I->see('MORE BY');
    $I->see('YOU MIGHT LIKE...');
    $I->seeElement(['class' => 'art-details-rightsidebar']);


  }

  public function canUseDisqusToLeaveAComment(AcceptanceTester $I)
  {
    $I->am('A shopper');
    $I->amGoingTo('be able to leave a comment regarding any item of art using DISQUS (3rd party javascript code embedded in each page)');
    $I->amOnPage('art/Drawing/1');
    $I->see('DISQUS');
  }
}