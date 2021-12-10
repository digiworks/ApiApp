<?php

namespace controllers;

use code\applications\ApiAppFactory;
use code\controllers\AppController;
use code\service\ServiceTypes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends AppController {

    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function home(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/user/signin.js';
        $renderManager = ApiAppFactory::getApp()->getService(ServiceTypes::RENDER);
        $response->getBody()->write($renderManager->getRender()->useTheme("login")->renderView($currentView));

        return $response;
    }

}
