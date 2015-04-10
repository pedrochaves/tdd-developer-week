<?php

use Calculator\Exception\InvalidExpressionException;
use Calculator\Factory\OperationFactory;
use Calculator\Parser\ExpressionNormalizer;
use Calculator\Parser\ExpressionValidator;
use Calculator\Parser\Parser;
use Event\UserEvent;
use Event\UserEventManager;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

$app->before(function (Request $request) {
    $content_type = $request->headers->get('Content-Type');
    if (strpos($content_type, 'application/json') === 0) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

$app->get('/', function() use ($app) {
    $lexer = new \Twig_Lexer($app['twig'], [
        'tag_comment'   => ['{#', '#}'],
        'tag_block'     => ['{%', '%}'],
        'tag_variable'  => ['[[', ']]'],
        'interpolation' => ['#{', '}'],
    ]);
    $app['twig']->setLexer($lexer);

    return $app['twig']->render('index.html.twig');
});

$app->post('/api/calculator/solve', function() use ($app) {
    $expression = $app['request']->get('expr', '');

    $parser = new Parser(
        new OperationFactory(),
        new ExpressionNormalizer(),
        new ExpressionValidator()
    );

    $event_manager = new UserEventManager($app['em']);

    try {
        $equation = $parser->parse($expression);
    } catch(InvalidExpressionException $e) {
        $event_manager->saveEquationError($expression, $e->getMessage());

        return new JsonResponse([
            'error' => 422,
            'message' => $e->getMessage(),
            'expr' => $expression
        ], 422);
    }

    $result = $equation->solve();

    $event_manager->saveEquationSolving($expression, $result);

    return new JsonResponse([
        'result' => $result,
        'expr' => $expression
    ]);
});
