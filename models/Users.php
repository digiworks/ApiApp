<?php

namespace models;

use models\Base\Users as BaseUsers;

/**
 * Skeleton subclass for representing a row from the 'public.users' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
class Users extends BaseUsers
{
    public function getPassword(): string {
        return $this->gethash();
    }

}
