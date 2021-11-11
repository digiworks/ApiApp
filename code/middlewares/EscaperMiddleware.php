<?php

namespace code\middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EscaperMiddleware implements MiddlewareInterface {

    
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        
    }

}
