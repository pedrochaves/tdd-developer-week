<?php

$I = new FunctionalTester($scenario);
$I->wantTo('test the API with invalid expressions');

$I->sendPOST('/api/calculator/solve', ['expr' => 'a + b']);
$I->seeResponseIsJson();
$I->seeResponseCodeIs(422);
$I->seeResponseContainsJson([
    'error' => 422,
    'message' => 'Could not parse "a + b": has invalid characters',
    'expr' => 'a + b'
]);
$I->seeInDatabase('user_events', ['type' => 'equation.error']);
