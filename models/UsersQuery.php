<?php

namespace models;

use models\Base\UsersQuery as BaseUsersQuery;

class UsersQuery extends BaseUsersQuery {

    public function list() {
        return $this->create()->filterByDeletedAt()->find();
    }
    
    public function listPaginate($page = 1, $maxPerPage = 10) {
        return $this->create()->filterByDeletedAt()->orderBy("surname")->paginate($page, $maxPerPage)->getResults()->toArray();
    }
    
    public function getCount(){
        return $this->create()->filterByDeletedAt()->count();
    }

}
