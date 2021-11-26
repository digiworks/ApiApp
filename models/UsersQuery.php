<?php

namespace models;

use models\Base\UsersQuery as BaseUsersQuery;

class UsersQuery extends BaseUsersQuery {

    public function list() {
        return $this->create()->filterByDeletedAt()->find();
    }

    public function listPaginate($page = 1, $maxPerPage = 10, string $order = "asc", string $orderBy = "", $filter = []) {
        $query = $this->create()->filterByDeletedAt();
        if (!empty($orderBy)) {
            $query->orderBy($orderBy, $order);
        }
        return $query->paginate($page, $maxPerPage)->getResults()->toArray();
    }

    public function getCount() {
        return $this->create()->filterByDeletedAt()->count();
    }

}
