<?php
error_reporting(E_ALL);

use code\applications\ApiAppFactory;
use code\renders\engines\BabelTranslator;
use code\renders\engines\V8;
use code\renders\JsRender;
use code\renders\theme\JsTheme;
use code\service\ServiceTypes;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/vendor/autoload.php';


$app = ApiAppFactory::create();
$app->init();
$app->run();
