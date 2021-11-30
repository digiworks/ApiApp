<?php

namespace models;

use models\Base\UsersQuery as BaseUsersQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class UsersQuery extends BaseUsersQuery {

    public function list() {
        return $this->create()->filterByDeletedAt()->find();
    }

    public function listPaginate($page = 1, $maxPerPage = 10, string $order = "asc", string $orderBy = "", $filters = []) {
        $query = $this->buildQuery($filters);
        if (!empty($orderBy)) {
            $query->orderBy($orderBy, $order);
        }
        return $query->paginate($page, $maxPerPage)->getResults()->toArray();
    }

    public function getCount($filters = []) {
        $query = $this->buildQuery($filters);
        return $query->count();
    }

    /**
     * 
     * @param string $order
     * @param string $orderBy
     * @param array $filters
     */
    protected function buildQuery($filters = []) {
        $query = $this->create()->filterByDeletedAt()->setIgnoreCase(true);
        if (count($filters)) {
            $criteria = new Criteria();
            foreach ($filters as $filter) {

                if (!empty($filter->value)) {
                    $criteria->addOr($filter->field, $filter->value . "%", Criteria::ILIKE);
                }
            }
            $query->mergeWith($criteria);
        }
        if (!empty($orderBy)) {
            $query->orderBy($orderBy, $order);
        }
        return $query;
    }

}
