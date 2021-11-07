<?php

return [
    "routes" => [
                // Views Routes
        
                ["route" => "/", "method" => "GET", "controller" => "\controllers\HomeController:home"],
                ["route" => "/login", "method" => "GET", "controller" => "\controllers\UserController:signin"],
                ["route" => "/signup", "method" => "GET", "controller" => "\controllers\UserController:signup"],
                ["route" => "/forgot", "method" => "GET", "controller" => "\controllers\UserController:forgot"],
                ["route" => "/listuser", "method" => "GET", "controller" => "\controllers\UserController:listuser"],
                ["route" => "/table", "method" => "GET", "controller" => "\controllers\UserController:table"],
                ["route" => "/userslist", "method" => "GET", "controller" => "\controllers\UserController:userslist"],
                ["route" => "/createuser", "method" => "GET", "controller" => "\controllers\UserController:createuser"],
        
                // API Routes
        
                ["route" => "/api/user/save", "method" => "POST", "controller" => "\controllers\UserApiController:save"],
                ["route" => "/api/user/token", "method" => "POST", "controller" => "\controllers\UserApiController:token"],
            ]
];
