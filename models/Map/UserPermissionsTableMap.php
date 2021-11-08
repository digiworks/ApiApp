<?php

namespace models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use models\UserPermissions;
use models\UserPermissionsQuery;


/**
 * This class defines the structure of the 'public.user_permissions' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UserPermissionsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.Map.UserPermissionsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'public.user_permissions';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\UserPermissions';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.UserPermissions';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the pid field
     */
    const COL_PID = 'public.user_permissions.pid';

    /**
     * the column name for the permission_name field
     */
    const COL_PERMISSION_NAME = 'public.user_permissions.permission_name';

    /**
     * the column name for the permission_type field
     */
    const COL_PERMISSION_TYPE = 'public.user_permissions.permission_type';

    /**
     * the column name for the userid field
     */
    const COL_USERID = 'public.user_permissions.userid';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'public.user_permissions.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'public.user_permissions.updated_at';

    /**
     * the column name for the deleted_at field
     */
    const COL_DELETED_AT = 'public.user_permissions.deleted_at';

    /**
     * the column name for the created_by field
     */
    const COL_CREATED_BY = 'public.user_permissions.created_by';

    /**
     * the column name for the updated_by field
     */
    const COL_UPDATED_BY = 'public.user_permissions.updated_by';

    /**
     * the column name for the deleted_by field
     */
    const COL_DELETED_BY = 'public.user_permissions.deleted_by';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Pid', 'PermissionName', 'PermissionType', 'Userid', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'CreatedBy', 'UpdatedBy', 'DeletedBy', ),
        self::TYPE_CAMELNAME     => array('pid', 'permissionName', 'permissionType', 'userid', 'createdAt', 'updatedAt', 'deletedAt', 'createdBy', 'updatedBy', 'deletedBy', ),
        self::TYPE_COLNAME       => array(UserPermissionsTableMap::COL_PID, UserPermissionsTableMap::COL_PERMISSION_NAME, UserPermissionsTableMap::COL_PERMISSION_TYPE, UserPermissionsTableMap::COL_USERID, UserPermissionsTableMap::COL_CREATED_AT, UserPermissionsTableMap::COL_UPDATED_AT, UserPermissionsTableMap::COL_DELETED_AT, UserPermissionsTableMap::COL_CREATED_BY, UserPermissionsTableMap::COL_UPDATED_BY, UserPermissionsTableMap::COL_DELETED_BY, ),
        self::TYPE_FIELDNAME     => array('pid', 'permission_name', 'permission_type', 'userid', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Pid' => 0, 'PermissionName' => 1, 'PermissionType' => 2, 'Userid' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, 'DeletedAt' => 6, 'CreatedBy' => 7, 'UpdatedBy' => 8, 'DeletedBy' => 9, ),
        self::TYPE_CAMELNAME     => array('pid' => 0, 'permissionName' => 1, 'permissionType' => 2, 'userid' => 3, 'createdAt' => 4, 'updatedAt' => 5, 'deletedAt' => 6, 'createdBy' => 7, 'updatedBy' => 8, 'deletedBy' => 9, ),
        self::TYPE_COLNAME       => array(UserPermissionsTableMap::COL_PID => 0, UserPermissionsTableMap::COL_PERMISSION_NAME => 1, UserPermissionsTableMap::COL_PERMISSION_TYPE => 2, UserPermissionsTableMap::COL_USERID => 3, UserPermissionsTableMap::COL_CREATED_AT => 4, UserPermissionsTableMap::COL_UPDATED_AT => 5, UserPermissionsTableMap::COL_DELETED_AT => 6, UserPermissionsTableMap::COL_CREATED_BY => 7, UserPermissionsTableMap::COL_UPDATED_BY => 8, UserPermissionsTableMap::COL_DELETED_BY => 9, ),
        self::TYPE_FIELDNAME     => array('pid' => 0, 'permission_name' => 1, 'permission_type' => 2, 'userid' => 3, 'created_at' => 4, 'updated_at' => 5, 'deleted_at' => 6, 'created_by' => 7, 'updated_by' => 8, 'deleted_by' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Pid' => 'PID',
        'UserPermissions.Pid' => 'PID',
        'pid' => 'PID',
        'userPermissions.pid' => 'PID',
        'UserPermissionsTableMap::COL_PID' => 'PID',
        'COL_PID' => 'PID',
        'public.user_permissions.pid' => 'PID',
        'PermissionName' => 'PERMISSION_NAME',
        'UserPermissions.PermissionName' => 'PERMISSION_NAME',
        'permissionName' => 'PERMISSION_NAME',
        'userPermissions.permissionName' => 'PERMISSION_NAME',
        'UserPermissionsTableMap::COL_PERMISSION_NAME' => 'PERMISSION_NAME',
        'COL_PERMISSION_NAME' => 'PERMISSION_NAME',
        'permission_name' => 'PERMISSION_NAME',
        'public.user_permissions.permission_name' => 'PERMISSION_NAME',
        'PermissionType' => 'PERMISSION_TYPE',
        'UserPermissions.PermissionType' => 'PERMISSION_TYPE',
        'permissionType' => 'PERMISSION_TYPE',
        'userPermissions.permissionType' => 'PERMISSION_TYPE',
        'UserPermissionsTableMap::COL_PERMISSION_TYPE' => 'PERMISSION_TYPE',
        'COL_PERMISSION_TYPE' => 'PERMISSION_TYPE',
        'permission_type' => 'PERMISSION_TYPE',
        'public.user_permissions.permission_type' => 'PERMISSION_TYPE',
        'Userid' => 'USERID',
        'UserPermissions.Userid' => 'USERID',
        'userid' => 'USERID',
        'userPermissions.userid' => 'USERID',
        'UserPermissionsTableMap::COL_USERID' => 'USERID',
        'COL_USERID' => 'USERID',
        'public.user_permissions.userid' => 'USERID',
        'CreatedAt' => 'CREATED_AT',
        'UserPermissions.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'userPermissions.createdAt' => 'CREATED_AT',
        'UserPermissionsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'public.user_permissions.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'UserPermissions.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'userPermissions.updatedAt' => 'UPDATED_AT',
        'UserPermissionsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'public.user_permissions.updated_at' => 'UPDATED_AT',
        'DeletedAt' => 'DELETED_AT',
        'UserPermissions.DeletedAt' => 'DELETED_AT',
        'deletedAt' => 'DELETED_AT',
        'userPermissions.deletedAt' => 'DELETED_AT',
        'UserPermissionsTableMap::COL_DELETED_AT' => 'DELETED_AT',
        'COL_DELETED_AT' => 'DELETED_AT',
        'deleted_at' => 'DELETED_AT',
        'public.user_permissions.deleted_at' => 'DELETED_AT',
        'CreatedBy' => 'CREATED_BY',
        'UserPermissions.CreatedBy' => 'CREATED_BY',
        'createdBy' => 'CREATED_BY',
        'userPermissions.createdBy' => 'CREATED_BY',
        'UserPermissionsTableMap::COL_CREATED_BY' => 'CREATED_BY',
        'COL_CREATED_BY' => 'CREATED_BY',
        'created_by' => 'CREATED_BY',
        'public.user_permissions.created_by' => 'CREATED_BY',
        'UpdatedBy' => 'UPDATED_BY',
        'UserPermissions.UpdatedBy' => 'UPDATED_BY',
        'updatedBy' => 'UPDATED_BY',
        'userPermissions.updatedBy' => 'UPDATED_BY',
        'UserPermissionsTableMap::COL_UPDATED_BY' => 'UPDATED_BY',
        'COL_UPDATED_BY' => 'UPDATED_BY',
        'updated_by' => 'UPDATED_BY',
        'public.user_permissions.updated_by' => 'UPDATED_BY',
        'DeletedBy' => 'DELETED_BY',
        'UserPermissions.DeletedBy' => 'DELETED_BY',
        'deletedBy' => 'DELETED_BY',
        'userPermissions.deletedBy' => 'DELETED_BY',
        'UserPermissionsTableMap::COL_DELETED_BY' => 'DELETED_BY',
        'COL_DELETED_BY' => 'DELETED_BY',
        'deleted_by' => 'DELETED_BY',
        'public.user_permissions.deleted_by' => 'DELETED_BY',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('public.user_permissions');
        $this->setPhpName('UserPermissions');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\UserPermissions');
        $this->setPackage('models');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('public.user_permissions_pid_seq');
        // columns
        $this->addPrimaryKey('pid', 'Pid', 'INTEGER', true, null, null);
        $this->addColumn('permission_name', 'PermissionName', 'VARCHAR', true, 255, null);
        $this->addColumn('permission_type', 'PermissionType', 'INTEGER', false, null, null);
        $this->addColumn('userid', 'Userid', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('deleted_at', 'DeletedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('created_by', 'CreatedBy', 'INTEGER', false, null, null);
        $this->addColumn('updated_by', 'UpdatedBy', 'INTEGER', false, null, null);
        $this->addColumn('deleted_by', 'DeletedBy', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UserPermissionsTableMap::CLASS_DEFAULT : UserPermissionsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (UserPermissions object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserPermissionsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserPermissionsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserPermissionsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserPermissionsTableMap::OM_CLASS;
            /** @var UserPermissions $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserPermissionsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UserPermissionsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserPermissionsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserPermissions $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserPermissionsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserPermissionsTableMap::COL_PID);
            $criteria->addSelectColumn(UserPermissionsTableMap::COL_PERMISSION_NAME);
            $criteria->addSelectColumn(UserPermissionsTableMap::COL_PERMISSION_TYPE);
            $criteria->addSelectColumn(UserPermissionsTableMap::COL_USERID);
            $criteria->addSelectColumn(UserPermissionsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(UserPermissionsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(UserPermissionsTableMap::COL_DELETED_AT);
            $criteria->addSelectColumn(UserPermissionsTableMap::COL_CREATED_BY);
            $criteria->addSelectColumn(UserPermissionsTableMap::COL_UPDATED_BY);
            $criteria->addSelectColumn(UserPermissionsTableMap::COL_DELETED_BY);
        } else {
            $criteria->addSelectColumn($alias . '.pid');
            $criteria->addSelectColumn($alias . '.permission_name');
            $criteria->addSelectColumn($alias . '.permission_type');
            $criteria->addSelectColumn($alias . '.userid');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.deleted_at');
            $criteria->addSelectColumn($alias . '.created_by');
            $criteria->addSelectColumn($alias . '.updated_by');
            $criteria->addSelectColumn($alias . '.deleted_by');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(UserPermissionsTableMap::COL_PID);
            $criteria->removeSelectColumn(UserPermissionsTableMap::COL_PERMISSION_NAME);
            $criteria->removeSelectColumn(UserPermissionsTableMap::COL_PERMISSION_TYPE);
            $criteria->removeSelectColumn(UserPermissionsTableMap::COL_USERID);
            $criteria->removeSelectColumn(UserPermissionsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(UserPermissionsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(UserPermissionsTableMap::COL_DELETED_AT);
            $criteria->removeSelectColumn(UserPermissionsTableMap::COL_CREATED_BY);
            $criteria->removeSelectColumn(UserPermissionsTableMap::COL_UPDATED_BY);
            $criteria->removeSelectColumn(UserPermissionsTableMap::COL_DELETED_BY);
        } else {
            $criteria->removeSelectColumn($alias . '.pid');
            $criteria->removeSelectColumn($alias . '.permission_name');
            $criteria->removeSelectColumn($alias . '.permission_type');
            $criteria->removeSelectColumn($alias . '.userid');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.deleted_at');
            $criteria->removeSelectColumn($alias . '.created_by');
            $criteria->removeSelectColumn($alias . '.updated_by');
            $criteria->removeSelectColumn($alias . '.deleted_by');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UserPermissionsTableMap::DATABASE_NAME)->getTable(UserPermissionsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UserPermissions or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or UserPermissions object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserPermissionsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\UserPermissions) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserPermissionsTableMap::DATABASE_NAME);
            $criteria->add(UserPermissionsTableMap::COL_PID, (array) $values, Criteria::IN);
        }

        $query = UserPermissionsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserPermissionsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserPermissionsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the public.user_permissions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserPermissionsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserPermissions or Criteria object.
     *
     * @param mixed               $criteria Criteria or UserPermissions object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserPermissionsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserPermissions object
        }

        if ($criteria->containsKey(UserPermissionsTableMap::COL_PID) && $criteria->keyContainsValue(UserPermissionsTableMap::COL_PID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserPermissionsTableMap::COL_PID.')');
        }


        // Set the correct dbName
        $query = UserPermissionsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserPermissionsTableMap
