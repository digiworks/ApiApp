<?php

namespace controllers;

use code\applications\ApiAppFactory;
use code\controllers\AppController;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserController extends AppController {

    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function table(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        try {
            $currentView = 'js/views/table.js';
            $this->setRequest($request)->setResponse($response)->setCurrentView($currentView)->render();
        } catch (Exception $ex) {
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getMessage());
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getTraceAsString());
        }
        return $response;
    }

    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function listuser(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/listuser.js';
        $this->setRequest($request)->setResponse($response)->setCurrentView($currentView)->render();
        return $this->getResponse();
    }

    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function login(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        try {
            $currentView = 'js/views/index.js';
            $this->setRequest($request)->setResponse($response)->setCurrentView($currentView)->render();
        } catch (Exception $ex) {
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getMessage());
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getTraceAsString());
        }
        return $response;
    }

    public function userslist(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        try {
            $currentView = 'js/views/user/list.js';
            $this->setRequest($request)->setResponse($response)->setCurrentView($currentView)->render();
        } catch (Exception $ex) {
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getMessage());
            ApiAppFactory::getApp()->getLogger()->error("error", $ex->getTraceAsString());
        }
        return $response;
    }

    public function formuser(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/user/form.js';
        $this->setRequest($request)->setResponse($response)->setCurrentView($currentView)->render();
        return $this->getResponse();
    }

    public function signup(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/user/signup.js';
        $this->setRequest($request)->setResponse($response)->useTheme("login")->setCurrentView($currentView)->render();
        return $this->getResponse();
    }

    public function signin(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/user/signin.js';
        $this->setRequest($request)->setResponse($response)->useTheme("login")->setCurrentView($currentView)->render();
        return $this->getResponse();
    }

    public function forgot(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/user/forgot.js';
        $this->setRequest($request)->setResponse($response)->useTheme("login")->setCurrentView($currentView)->render();
        return $this->getResponse();
    }

}
