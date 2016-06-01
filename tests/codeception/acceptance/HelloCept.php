<?php

use tests\codeception\_pages\HelloPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('hello page');

HelloPage::openBy($I);

$I->see('hello', 'h3');
