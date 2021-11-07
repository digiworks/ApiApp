<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\models\\Map\\GroupPermissionsTableMap',
    1 => '\\models\\Map\\UserGroupsTableMap',
    2 => '\\models\\Map\\UserPermissionsTableMap',
    3 => '\\models\\Map\\UsersTableMap',
  ),
));
