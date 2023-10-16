<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$jsonData = file_get_contents('db.json');

$data = json_decode($jsonData, true);

$app = AppFactory::create();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, OPTIONS');
});


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("<h1>Hello World</h1>");
    return $response;
});

$app->get('/hero', function ($request, $response, $args) use ($data) {
    $queryParams = $request->getQueryParams();
    $name = isset($queryParams['name']) ? $queryParams['name'] : '';

    $filteredHeroes = array_filter($data['heroes'], function ($hero) use ($name) {
        return stristr($hero['name'], $name) !== false;
    });

    // Create the desired JSON structure
    $result = [];
    foreach ($filteredHeroes as $hero) {
        $result = [
            'id' => $hero['id'],
            'name' => $hero['name'],
            'primary_stat' => [
                'icon' => 'https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_strength.png',
                'name' => 'Strength',
            ],
            'hero_one_liner' => $hero['hero_one_liner'],
            'small_thumbnail' => $hero['small_thumbnail'],
            'big_thumbnail' => $hero['big_thumbnail'],
            'video_thumbnail' => $hero['video_thumbnail'],
            'source_link' => $hero['source_link'],
        ];
    }

    if (empty($result)) {
        $response = $response->withStatus(404);
        $response->getBody()->write(json_encode(['message' => 'No heroes found.']));
    } else {
        $response->getBody()->write(json_encode($result));
    }

    return $response
        ->withHeader('Content-Type', 'application/json');
});

$app->run();
