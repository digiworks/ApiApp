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
define('COREPATH_MIGRATIONS', COREPATH_ROOT . DIRECTORY_SEPARATOR . COREPATH_ETC . 'generated-migrations');
define('COREPATH_MAILS', COREPATH_ROOT . DIRECTORY_SEPARATOR . 'mails');

return Arr::mergeRecursive(
                [
                    "env" => [
                        "jwt_secret" => "AASDGFggsya12!23LklkjlljiIIlkjll@@l",
                        "version" => "0.1.0",
                        "debug" => false,
                        "admin_mail" => "",
                        "support_mail" => "",
                        "seo" => [
                        ],
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
                        ],
                        "debugger" => [// if service Debugger enabled
                            'url_key' => 'debug', // the key to pass to the url to turn on debug
                            'url_pass' => 'true', // the pass to turn on debug
                            'replace_error_handler' => true, // replace default php error handler
                            'error_reporting' => E_ALL, // error reporting flag
                            'catch_exceptions' => true, // sets exception handler to be this class method
                            'check_referer' => false, // check referer for key and pass ( good for ajax debugging )
                            'die_on_error' => true, // die if fatal error occurs ( with this class error handler )
                            'debug_console' => false, // only for Chrome,show messages in console ( phpConsole needed )
                            'allowed_ips' => null, // restrict access with ip's
                            'session_start' => false, // start session for persistent debugging
                            'show_interface' => true, // show the interface ( false to debug in console only )
                            'set_time_limit' => null, // set php execution time limit
                            'memory_limit' => null, // set php memory size	
                            'show_messages' => true, // show messages panel
                            'show_globals' => true, // show global variables in vars panel
                            'show_sql' => true, // show sql panel
                            'show_w3c' => true, // show the w3c panel
                            'minified_html' => true, // compress html for a lighter output
                            'trace_depth' => 10, // maximum depth for the backtrace
                            'max_dump_depth' => 6, // maximum depth for the dump function	
                            'panel_top' => '0px', // panel top position
                            'panel_right' => '0px', // panel right position
                            'default_category' => 'General', // default category for the messages
                            'enable_inspector' => true, // enable variables inspector, use declare(ticks=n); in code block
                            'code_coverage' => true, // enable code coverage analysis, use "full" to start globally
                            'trace_functions' => true, // enable function calls tracing, use "full" to start globally
                            'declare_ticks' => true,
                            'exclude_categories' => array('Event Manager', 'Autoloader') // exclude categories from the output
                        ],
                        "response" => [
                            "frameLevel" => 2,
                            "frameAllowFrom" => '',
                            "xssLevel" => 2,
                            "xssReport" => '',
                            "hstsMaxAge" => 31536000,
                            "hstsIncludeSubdomains" => true,
                            "contentTypeLevel" => 1,
                            "cspDirectives" => [
                                'default-src' => "'self' 'unsafe-inline' gstatic.com *.gstatic.com",
                                'connect-src' => "'self'",
                                'img-src' => "'self' 'unsafe-inline'",
                                'script-src' => "'self' 'unsafe-inline'",
                                'style-src' => "'self' 'unsafe-inline' gstatic.com *.gstatic.com"
                            ],
                            "hpkpPins" => [],
                            "hpkpMaxAge" => 10000,
                            "hpkpIncludeSubdomains" => true,
                            "hpkpReportUri" => ''
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
                        "before" => function ($response, $arguments) {
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
                            //['lib' => 'js/engines/react/react-table/6.11.5/react-table.js', 'tranlsator' => ''],
                            // // DatePicker and dependencies
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
                            ['lib' => "js/engines/react/components.js", 'tranlsator' => 'text/babel'],
                            ['lib' => 'js/engines/react/react-transition-group@2.4.0/dist/react-transition-group.js', 'tranlsator' => ''],
                            ['lib' => 'js/engines/react/primereact@7.0.1/primereact.all.js', 'tranlsator' => ''],
                            ['lib' => 'js/engines/react/primereact.js', 'tranlsator' => ''],
                        ],
                        "stylesheets" => [
                            "googleapis-css/css.css",
                            "material-icons/icon.css",
                            "react/react-table/6.11.5/react-table.css",
                            "apexcharts@3.30.0/dist/apexcharts.css",
                            "primereact@7.0.1/resources/themes/md-light-indigo/theme.css",
                            "primereact@7.0.1/resources/primereact.min.css",
                            "primeicons@5.0.0/primeicons.css"
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
