<?php
namespace controllers;

use code\applications\ApiAppFactory;
use code\service\ServiceTypes;
use DateTime;
use Firebase\JWT\JWT;
use models\Users;
use models\UsersQuery;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuupola\Base62;


class UserApiController extends AppController
{
    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function save(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

//        ob_start();
//        var_dump($request->getParsedBody());
//        error_log(ob_get_clean(), 4);
        $data = $request->getParsedBody();
        $user = new Users();
        $user->setName($data["name"]);
        $user->setsurname($data["surname"]);
        $user->setStatus($data["status"] == "on" ? 1:0);
        $user->save();
        $response->getBody()->write(json_encode(['succesful']));
        return $response;
    }
    
    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function get(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $this->response = $response;
        $this->request = $request;
        $message = "not found";
        $model = [];
        $data = $request->getParsedBody();
        if(isset($data['Id'])){
            $id = $data['Id'];
            $query = new UsersQuery();
            $user = $query->create()->findById($id);
            if(!is_null($user)){
                $model = $user->toArray();
                $message = "found";
            }
        }
         $result = [
            'model'=> $model,
            'message' => $message
        ];
        $this->response->withHeader("Content-Type", "application/json")->getBody()->write(json_encode($result, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        
        return $this->response;
    }
    
    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function delete(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $this->response = $response;
        $this->request = $request;
        $data = $request->getParsedBody();
        if(isset($data['Id'])){
            $id = $data['Id'];
            $query = new UsersQuery();
            $user = $query->create()->findById($id);
            if(!is_null($user)){
                $user->delete();
            }
        }
        $response->getBody()->write(json_encode(['succesful']));
        return $this->response;
    }
    
    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function pager(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        
        $this->response = $response;
        $this->request = $request;
        $params = $this->request->getQueryParams();
        $page = $params['page'];
        $per_page = $params['per_page'];
        $query = new UsersQuery();
        $data = $query->listPaginate($page, $per_page);
        $totalCount = $query->getCount();
        $result = [
            'data'=> $data,
            'page' => $page,
            'totalCount' => $totalCount
        ];
        $this->response->withHeader("Content-Type", "application/json")->getBody()->write(json_encode($result, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        return $this->response;
    }
    
    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function register(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $this->response = $response;
        $this->request = $request;
        
        
        return $this->response;
    }
    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function token(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $this->response = $response;
        $this->request = $request;
        
        $requested_scopes = $this->request->getParsedBody() ?: [];

        $valid_scopes = [
            "todo.create",
            "todo.read",
            "todo.update",
            "todo.delete",
            "todo.list",
            "todo.all"
        ];

        $scopes = array_filter($requested_scopes, function ($needle) use ($valid_scopes) {
            return in_array($needle, $valid_scopes);
        });

        $now = new DateTime();
        $future = new DateTime("now +2 hours");
        $server = $request->getServerParams();

        $jti = (new Base62)->encode(random_bytes(16));

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "sub" => "1",
            "scope" => $scopes
        ];

        $secret = ApiAppFactory::getApp()->getService(ServiceTypes::CONFIGURATIONS)->get('env.jwt_secret');
        $token = JWT::encode($payload, $secret, "HS256");

        $data["token"] = $token;
        $data["expires"] = $future->getTimeStamp();

        $response->withStatus(201)->withHeader("Content-Type", "application/json")->getBody()
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        return $response;
    }
}
