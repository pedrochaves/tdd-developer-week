<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('test the delete button');

$I->amGoingTo('remove the last number and add 5');
$I->amOnPage('/');
$I->typeExpression('500 + 25 * 40');
$I->click('#btn-del');
$I->click('#btn-del');
$I->see('500 + 25', '#screen');
