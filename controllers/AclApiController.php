<?php

namespace controllers;

use code\controllers\AppController;
use models\UserPermissions;
use models\UserPermissionsQuery;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AclApiController extends AppController {
    
     public function saveUserPermission(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        $data = $request->getParsedBody();
        $userpermission = new UserPermissions();
        if (!empty($data["Id"])) {
            $query = new UserPermissionsQuery();
            $model = $query->create()->findPK($data["Id"]);
            if (!is_null($model)) {
                $userpermission = $model;
            }
        }
        unset($data["Id"]);
        $userpermission->fromArray($data);
        $userpermission->save();
        $this->buildRestResponse();
        return $response;
    }

}
