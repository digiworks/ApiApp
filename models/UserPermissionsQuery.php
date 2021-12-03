<?php

namespace models;

use models\Base\UserPermissionsQuery as BaseUserPermissionsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

/**
 * Skeleton subclass for performing query and update operations on the 'public.user_permissions' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class UserPermissionsQuery extends BaseUserPermissionsQuery {

    public function countPermission($user_id, $permission) {
        $query = $this->create()->filterByDeletedAt()->setIgnoreCase(true);
        $query->filterBy('permission_name', $permission, Criteria::EQUAL);
        $query->filterBy('userid', $user_id, Criteria::EQUAL);
        $query->filterBy('permission_type', 0, Criteria::NOT_EQUAL);
        return $query->count();
    }

}
