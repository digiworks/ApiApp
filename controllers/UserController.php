<?php
namespace controllers;

use code\applications\ApiAppFactory;
use code\service\ServiceTypes;
use models\Users;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class UserController extends AppController
{
    
    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function table(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/table.js';
        $renderManager = ApiAppFactory::getApp()->getService(ServiceTypes::RENDER);
        $response->getBody()->write($renderManager->getRender()->renderView($currentView));

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
        $renderManager = ApiAppFactory::getApp()->getService(ServiceTypes::RENDER);
        $response->getBody()->write($renderManager->getRender()->renderView($currentView));

        return $response;
    }
    
    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function login(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/index.js';
        $renderManager = ApiAppFactory::getApp()->getService(ServiceTypes::RENDER);
        $response->getBody()->write($renderManager->getRender()->renderView($currentView));

        return $response;
    }
    
    public function userslist(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/user/list.js';
        $renderManager = ApiAppFactory::getApp()->getService(ServiceTypes::RENDER);
        $response->getBody()->write($renderManager->getRender()->renderView($currentView));

        return $response;
    }
    
    public function createuser(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/user/form.js';
        $renderManager = ApiAppFactory::getApp()->getService(ServiceTypes::RENDER);
        $response->getBody()->write($renderManager->getRender()->renderView($currentView));

        return $response;
    }
    
    
    public function signup(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/user/signup.js';
        $renderManager = ApiAppFactory::getApp()->getService(ServiceTypes::RENDER);
        $response->getBody()->write($renderManager->getRender()->useTheme("login")->renderView($currentView));

        return $response;
    }
    
     public function signin(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $currentView = 'js/views/user/signin.js';
        $renderManager = ApiAppFactory::getApp()->getService(ServiceTypes::RENDER);
        $response->getBody()->write($renderManager->getRender()->useTheme("login")->renderView($currentView));

        return $response;
    }
    
    public function forgot(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $this->response = $response;
        $this->request = $request;
        $currentView = 'js/views/user/forgot.js';
        $this->render($currentView, "login");
        return $response;
    }
    
}
