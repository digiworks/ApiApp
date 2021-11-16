<?php

namespace controllers;

use code\applications\ApiAppFactory;
use code\controllers\AppController;
use code\service\ServiceTypes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DashboardController extends AppController {

    public function dashboard(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/dashboard/dashboard.js';
        $renderManager = ApiAppFactory::getApp()->getService(ServiceTypes::RENDER);
        $response->getBody()->write($renderManager->getRender()->renderView($currentView));

        return $response;
    }

}
