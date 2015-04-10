<?php

$I = new FunctionalTester($scenario);

$I->wantTo('test the equation solving API');
$I->sendPOST('/api/calculator/solve', ['expr' => '2 + 2']);
$I->seeResponseIsJson();
$I->seeResponseCodeIs(200);
$I->seeResponseContainsJson([
    'result' => 4,
    'expr' => '2 + 2'
]);
$I->seeInDatabase('user_events', ['type' => 'equation.solving']);

// SELECT COUNT(*) FROM user_events WHERE type = 'equation.solving'
