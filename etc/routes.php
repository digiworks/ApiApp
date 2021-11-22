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
        ["route" => "/index", "method" => "GET", "controller" => "\controllers\UserController:login"],
                ["route" => "/userslist", "method" => "GET", "controller" => "\controllers\UserController:userslist"],
                ["route" => "/formuser", "method" => "GET", "controller" => "\controllers\UserController:formuser"],
        
        
                ["route" => "/dashboard", "method" => "GET", "controller" => "\controllers\DashboardController:dashboard"],
        
                // API Routes
        
                ["route" => "/api/user/save", "method" => "POST", "controller" => "\controllers\UserApiController:save"],
                ["route" => "/api/user/register", "method" => "POST", "controller" => "\controllers\UserApiController:register"],
                ["route" => "/api/user/get", "method" => "POST", "controller" => "\controllers\UserApiController:get"],
                ["route" => "/api/user/delete", "method" => "POST", "controller" => "\controllers\UserApiController:delete"],
                ["route" => "/api/user/paginate", "method" => "GET", "controller" => "\controllers\UserApiController:pager"],
                ["route" => "/api/user/token", "method" => "POST", "controller" => "\controllers\UserApiController:token"],
        
                ["route" => "/api/file/stream", "method" => "GET", "controller" => "\controllers\FileApiController:stream"],
                ["route" => "/api/file/js/{path:.*}", "method" => "GET", "controller" => "\controllers\FileApiController:js"],
                ["route" => "/api/file/css/{path:.*}", "method" => "GET", "controller" => "\controllers\FileApiController:css"],
            ]
];
