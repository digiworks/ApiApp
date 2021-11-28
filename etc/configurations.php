<?php

use code\applications\ApiAppFactory;
use code\debugger\Debugger;
use code\logger\Logger;
use code\mailer\Mailer;
use code\middlewares\FilterMiddleware;
use code\middlewares\JsonBodyParserMiddleware;
use code\middlewares\SessionMiddleware;
use code\renders\engines\BabelTranslator;
use code\renders\engines\V8;
use code\renders\JsRender;
use code\renders\RenderManager;
use code\renders\theme\JsTheme;
use code\service\ServiceTypes;
use code\session\Session;
use code\storage\database\DataBase;
use code\storage\filesystem\FileSystem;
use code\utility\Arr;
use Symfony\Component\Mime\Email;
use Tuupola\Middleware\JwtAuthentication;
use Tuupola\Middleware\JwtAuthentication\RequestPathRule;

define('COREPATH_ROOT', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'));
define('COREPATH_BIN', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'bin');
define('COREPATH_CACHE', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'cache');
define('COREPATH_ETC', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'etc');
define('COREPATH_LOGS', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'logs');
define('COREPATH_RESOURCES', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'resources');
define('COREPATH_SOURCE', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'src');
define('COREPATH_TEMP', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'tmp');
define('COREPATH_TEMPLATES', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'templates');
define('COREPATH_VENDOR', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'vendor');
define('COREPATH_PUBLIC', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'www');
define('COREPATH_STATIC', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'static');
define('COREPATH_JS', COREPATH_ROOT . DIRECTORY_SEPARATOR . '');
define('COREPATH_CSS', COREPATH_STATIC . DIRECTORY_SEPARATOR . 'css');
define('COREPATH_MIGRATIONS', COREPATH_ROOT . DIRECTORY_SEPARATOR . COREPATH_ETC. 'generated-migrations');
define('COREPATH_MAILS', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'mails');

return Arr::mergeRecursive(
                [
                    "env" => [
                        "jwt_secret" => "AASDGFggsya12!23LklkjlljiIIlkjll@@l",
                        "version" => "0.1.0",
                        "admin_mail" => "",
                        "support_mail" => "",
                        "smtp" => [
                            'type' => 'smtp',
                            'host' => 'smtp.mailtrap.io',
                            'port' => '25',
                            'username' => 'my-username',
                            'password' => 'my-secret-password',
                            'priority' => Email::PRIORITY_NORMAL
                        ],
                        "apiGateway" => "",
                        "web" => [
                            "pageExpirationOffset" => 86400,
                            "jsExpirationOffset" => 86400,
                            "cssExpirationOffset" => 84600,
                            "streamExpirationOffset" => 86400,
                            "baseStaticFolderPath" => COREPATH_STATIC,
                            "baseJsFolderPath" => COREPATH_JS,
                            "baseCssFolderPath" => COREPATH_CSS,
                            "baseMailsFolderPath" => COREPATH_MAILS
                        ]
                    ],
                    "services" => [
                        ServiceTypes::FILESYSTEM => FileSystem::class,
                        ServiceTypes::LOGGER => Logger::class,
                        ServiceTypes::DATABASE => DataBase::class,
                        ServiceTypes::RENDER => RenderManager::class,
                        ServiceTypes::MAILER => Mailer::class, //Optional service
                        ServiceTypes::SESSION => Session::class, //Optional service
                        ServiceTypes::DEBUGGER => Debugger::class //Optional service
                    ],
                    "middlewares" => [
                        "JsonBodyParserMiddleware" => [
                            "class" => JsonBodyParserMiddleware::class
                        ],
                        "SessionMiddleware" => [
                            "class" => SessionMiddleware::class
                        ],
                        "JwtAuthentication" => function () {
                            $app = ApiAppFactory::getApp();

                            return new JwtAuthentication([
                                "secret" => $app->getService(ServiceTypes::CONFIGURATIONS)->get('env.jwt_secret'),
                                "algorithm" => ["HS256", "HS384"],
                                'logger' => $app->getLogger()->getLogger('info'),
                                'attribute' => "payload",
                                "rules" => [
                                    new RequestPathRule([
                                        "path" => "/",
                                        "ignore" => [
                                            "/login", 
                                            "/signup", 
                                            "/forgot", 
                                            "/api/user/token", 
                                            "/api/user/register",
                                            "/api/file/js",
                                            "/api/file/css"
                                            ]
                                        ]),
                                    ],
                                    "error" => function ($response, $arguments) {
                                        return $response->withHeader('Location', '/login')->withStatus(302);
                                        //new UnauthorizedResponse($arguments["message"], 401);
                                    },
                                    "before" =>  function ($response, $arguments) {
                                         ApiAppFactory::getApp()->addParams($arguments);
                                    },
                            ]);
                        },
                        "EscaperMiddleware" => [
                            "class" => FilterMiddleware::class
                        ]
                    ],
                    "render" => [
                        "class" => JsRender::class,
                        "onlyServerTrasnformation" => false,
                        "engine" => [
                            "class" => V8::class
                        ],
                        "imports" => [
                            ['lib' => 'js/lib/boot.js', 'tranlsator' => ''],
                            //['lib' => 'https://cdnjs.cloudflare.com/ajax/libs/date-fns/1.30.1/date_fns.js','tranlsator'=> ''],
                            ['lib' => 'js/engines/react/date-fns/1.30.1/date_fns.js', 'tranlsator' => ''],
                            ['lib' => 'js/engines/axios@0.24.0/dist/axios.js', 'tranlsator' => ''],
                            ['lib' => 'js/engines/apexcharts@3.30.0/dist/apexcharts.js', 'tranlsator' => '', 'use' => 'client'], // work only in browser
                            
                            //['lib' => 'https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.development.js','tranlsator'=> ''],
                            ['lib' => 'js/engines/react/17.0.2/umd/react.development.js', 'tranlsator' => ''],
                            //['lib' => 'https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom-server.browser.development.min.js','tranlsator'=> ''],
                            ['lib' => 'js/engines/react/react-dom/17.0.2/umd/react-dom-server.browser.development.min.js', 'tranlsator' => '', 'use' => 'server'],
                            ['lib' => 'js/engines/react/react-dom/17.0.2/umd/react-dom.development.min.js', 'tranlsator' => '', 'use' => 'client'],
                            //['lib' => 'https://cdn.jsdelivr.net/npm/simple-react-validator@1.6.1/dist/simple-react-validator.js','tranlsator'=> ''],
                            ['lib' => 'js/engines/react/lib/validator@1.0.0/form-validator.js', 'tranlsator' => ''],
                            ['lib' => 'js/engines/react/lib/validator@1.0.0/locale/it.js', 'tranlsator' => ''],
                            ['lib' => 'js/engines/react/i18next@21.4.0/dist/umd/i18next.js', 'tranlsator' => ''],
                            ['lib' => 'js/engines/react/react-i18next@11.13.0/react-i18next.js', 'tranlsator' => ''],
                            ['lib' => 'js/engines/react/react-dnd@14.0.4/dist/umd/ReactDnD.js', 'tranlsator' => ''],
                            ['lib' => 'js/lib/core.js', 'tranlsator' => ''],
                            //['lib' => 'https://unpkg.com/@mui/material@5.0.4/umd/material-ui.development.js','tranlsator'=> ''],
                            ['lib' => 'js/engines/react/material@5.0.6/umd/material-ui.development.js', 'tranlsator' => ''],
                            ['lib' => 'js/engines/react/mui.js', 'tranlsator' => ''],
                            // Semi-Ui                   
                            //min：['lib' => 'https://unpkg.com/@douyinfe/semi-ui@2.0.0/dist/umd/semi-ui-react.min.js','tranlsator'=> ''],
                            //normal: ['lib' => 'https://unpkg.com/@douyinfe/semi-ui@2.0.0/dist/umd/semi-ui-react.js','tranlsator'=> ''],
                            //['lib' => 'js/engines/react/semiui.js','tranlsator'=> ''],
                            //['lib' => 'https://cdnjs.cloudflare.com/ajax/libs/react-table/6.11.5/react-table.js','tranlsator'=> ''],
                            ['lib' => 'js/engines/react/react-table/6.11.5/react-table.js', 'tranlsator' => ''],
                            // DatePicker and dependencies
                            //['lib' => "https://cdn.jsdelivr.net/npm/date-object@latest/dist/umd/date-object.min.js",'tranlsator'=> ''],
                            ['lib' => "js/engines/react/date-object/dist/umd/date-object.min.js", 'tranlsator' => ''],
                            //['lib' => "https://cdn.jsdelivr.net/npm/react-element-popper@latest/build/browser.min.js",'tranlsator'=> ''],
                            ['lib' => "js/engines/react/react-element-popper/build/browser.min.js", 'tranlsator' => ''],
                            //['lib' => "https://cdn.jsdelivr.net/npm/react-multi-date-picker@latest/build/browser.min.js",'tranlsator'=> ''],
                            ['lib' => "js/engines/react/react-multi-date-picker/build/browser.min.js", 'tranlsator' => ''],
                            // Optional Plugin
                            //['lib' => "https://cdn.jsdelivr.net/npm/react-multi-date-picker@latest/build/date_picker_header.browser.js",'tranlsator'=> ''],
                            ['lib' => "js/engines/react/react-multi-date-picker/build/date_picker_header.browser.js", 'tranlsator' => ''],
                            ['lib' => "js/engines/react/reactmultidatepicker.js", 'tranlsator' => ''],
                            //['lib' => 'https://cdn.jsdelivr.net/npm/react-hook-form@7.17.5/dist/index.umd.js','tranlsator'=> ''],
                            //['lib' => 'js/engines/react/react-hook-form/7.17.5/dist/index.umd.js','tranlsator'=> ''],
                            ['lib' => "js/engines/react/components.js", 'tranlsator' => 'text/babel']
                        ],
                        "stylesheets" => [
                            "googleapis-css/css.css",
                            "material-icons/icon.css",
                            "react/react-table/6.11.5/react-table.css",
                            "apexcharts@3.30.0/dist/apexcharts.css"
                            //"https://unpkg.com/@douyinfe/semi-ui@2.0.0/dist/css/semi.css"
                        ],
                        "translator" => [
                            "class" => BabelTranslator::class
                        ],
                        "templates" => [
                            "deafult" => "app",
                            "themes" => [
                                "app" => [
                                    "class" => JsTheme::class,
                                    "path" => "js/templates/app.js"
                                ],
                                "login" => [
                                    "class" => JsTheme::class,
                                    "path" => "js/templates/login.js"
                                ]
                            ]
                        ]
                    ],
                    "components" => [
                        
                    ]
                ],
                require 'routes.php',
                require 'propel.php',
                require 'logs.php');
