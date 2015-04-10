<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('test the clear button');

$I->amGoingTo('clear the expression and the result');
$I->amOnPage('/');
$I->typeExpression('1 + 1 * 1');
$I->click('#btn-clear');
$I->dontSee('20', '#screen');


