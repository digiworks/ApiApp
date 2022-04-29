<?php

namespace controllers;

use code\applications\ApiAppFactory;
use code\controllers\AppController;
use code\service\ServiceTypes;
use DateTime;
use Firebase\JWT\JWT;
use models\Users;
use models\UsersQuery;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuupola\Base62;

class UserApiController extends AppController {

    /**
     * 
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function save(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $data = $request->getParsedBody();
        $user = new Users();
        if (!empty($data["Id"])) {
            $query = new UsersQuery();
            $model = $query->create()->findPK($data["Id"]);
            if (!is_null($model)) {
                $user = $model;
            }
        }
        unset($data["Id"]);
        $user->fromArray($data);
        $user->setStatus(isset($data["Status"]) && $data["Status"] == "on" ? 1 : 0);
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
        if (isset($data['Id'])) {
            $id = $data['Id'];
            $query = new UsersQuery();
            $user = $query->create()->findPK($id);
            if (!is_null($user)) {
                $model = $user->toArray();
                $message = "found";
            }
        }
        $result = [
            'model' => $model,
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
        if (isset($data['Id'])) {
            $id = $data['Id'];
            $query = new UsersQuery();
            $user = $query->create()->findById($id);
            if (!is_null($user)) {
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
        $order = isset($params['order']) ? $params['order'] : 'asc';
        $orderBy = isset($params['orderBy']) ? $params['orderBy'] : '';
        $filter = isset($params['filter']) ? json_decode($params['filter']) : [];
        $query = new UsersQuery();
        $data = $query->listPaginate($page, $per_page, $order, $orderBy, $filter);
        $totalCount = $query->getCount($filter);
        $result = [
            'data' => $data,
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
        $message = "ok";
        $data = $request->getParsedBody();
        $query = new UsersQuery();
        $user = $query->create()->findOneBy('email', $data['email']);
        if (is_null($user)) {
            $user = new Users();
            $user->setName($data['firstName']);
            $user->setsurname($data['lastName']);
            $user->setemail($data['email']);
            $user->sethash($user->passwordHash($data['password']));
            $user->save();
        } else {
            $message = "present";
        }
        $result = [
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
    public function token(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {
        $result = [];
        $this->response = $response;
        $this->request = $request;

        $data = $this->request->getParsedBody() ?: [];
        $requested_scopes = [];
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

        $query = new UsersQuery();
        /* @var $user \models\Users */
        $user = $query->create()->findOneBy('email', $data['email']);
        if (!is_null($user) && $user->passwordVerify($data['password']) && $user->getStatus()) {
            $now = new DateTime();
            $future = new DateTime("now +2 hours");
            $server = $request->getServerParams();

            $jti = (new Base62)->encode(random_bytes(16));

            $payload = [
                "iat" => $now->getTimeStamp(),
                "exp" => $future->getTimeStamp(),
                "jti" => $jti,
                "sub" => "1",
                "scope" => $scopes,
                "uid" => $user->getId()
            ];

            $secret = ApiAppFactory::getApp()->getService(ServiceTypes::CONFIGURATIONS)->get('env.jwt_secret');
            $token = JWT::encode($payload, $secret, "HS256");
            $result['message'] = "ok";
            $result["token"] = $token;
            $result["expires"] = $future->getTimeStamp();
        } else {
            $result['message'] = "ko";
        }
        $response->withStatus(201)->withHeader("Content-Type", "application/json")->getBody()
                ->write(json_encode($result, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        return $response;
    }

}
