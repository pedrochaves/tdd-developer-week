<?php

$I = new AcceptanceTester($scenario);

$I->wantTo('test the calculator');
$I->amGoingTo('get the result of 500 + 25 * 40');
$I->amOnPage('/');
$I->typeExpression('500 + 25 * 40');
$I->see('500 + 25 * 40', '#screen');
$I->click('#btn-solve');
$I->waitForText('1500', 2, '#screen');
