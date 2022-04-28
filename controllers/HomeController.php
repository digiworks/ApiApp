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

        try {
            $currentView = 'js/views/user/signin.js';
            $this->setRequest($request)->setResponse($response)->setCurrentView($currentView)->buildViewResponse()->render();
        } catch (Exception $ex) {
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getMessage());
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getTraceAsString());
        }
        return $this->getResponse();
    }

}
