<?php

namespace code\middlewares;

use code\utility\Escaper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EscaperMiddleware implements MiddlewareInterface {

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        $escaper = new Escaper();

        $post_values = $request->getParsedBody();
        if (!is_null($post_values)) {
            foreach ($post_values as $key => $value) {
                if (is_string($value)) {
                    $post_values[$key] = $escaper->escapeHTML($value);
                }
            }
            $request->withParsedBody($post_values);
        }
        return $handler->handle($request);
    }

}
