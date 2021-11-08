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
use models\UserGroups;
use models\UserGroupsQuery;


/**
 * This class defines the structure of the 'public.usergroups' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UserGroupsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.Map.UserGroupsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'public.usergroups';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\UserGroups';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.UserGroups';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the group_id field
     */
    const COL_GROUP_ID = 'public.usergroups.group_id';

    /**
     * the column name for the group_name field
     */
    const COL_GROUP_NAME = 'public.usergroups.group_name';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'public.usergroups.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'public.usergroups.updated_at';

    /**
     * the column name for the deleted_at field
     */
    const COL_DELETED_AT = 'public.usergroups.deleted_at';

    /**
     * the column name for the created_by field
     */
    const COL_CREATED_BY = 'public.usergroups.created_by';

    /**
     * the column name for the updated_by field
     */
    const COL_UPDATED_BY = 'public.usergroups.updated_by';

    /**
     * the column name for the deleted_by field
     */
    const COL_DELETED_BY = 'public.usergroups.deleted_by';

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
        self::TYPE_PHPNAME       => array('GroupId', 'GroupName', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'CreatedBy', 'UpdatedBy', 'DeletedBy', ),
        self::TYPE_CAMELNAME     => array('groupId', 'groupName', 'createdAt', 'updatedAt', 'deletedAt', 'createdBy', 'updatedBy', 'deletedBy', ),
        self::TYPE_COLNAME       => array(UserGroupsTableMap::COL_GROUP_ID, UserGroupsTableMap::COL_GROUP_NAME, UserGroupsTableMap::COL_CREATED_AT, UserGroupsTableMap::COL_UPDATED_AT, UserGroupsTableMap::COL_DELETED_AT, UserGroupsTableMap::COL_CREATED_BY, UserGroupsTableMap::COL_UPDATED_BY, UserGroupsTableMap::COL_DELETED_BY, ),
        self::TYPE_FIELDNAME     => array('group_id', 'group_name', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('GroupId' => 0, 'GroupName' => 1, 'CreatedAt' => 2, 'UpdatedAt' => 3, 'DeletedAt' => 4, 'CreatedBy' => 5, 'UpdatedBy' => 6, 'DeletedBy' => 7, ),
        self::TYPE_CAMELNAME     => array('groupId' => 0, 'groupName' => 1, 'createdAt' => 2, 'updatedAt' => 3, 'deletedAt' => 4, 'createdBy' => 5, 'updatedBy' => 6, 'deletedBy' => 7, ),
        self::TYPE_COLNAME       => array(UserGroupsTableMap::COL_GROUP_ID => 0, UserGroupsTableMap::COL_GROUP_NAME => 1, UserGroupsTableMap::COL_CREATED_AT => 2, UserGroupsTableMap::COL_UPDATED_AT => 3, UserGroupsTableMap::COL_DELETED_AT => 4, UserGroupsTableMap::COL_CREATED_BY => 5, UserGroupsTableMap::COL_UPDATED_BY => 6, UserGroupsTableMap::COL_DELETED_BY => 7, ),
        self::TYPE_FIELDNAME     => array('group_id' => 0, 'group_name' => 1, 'created_at' => 2, 'updated_at' => 3, 'deleted_at' => 4, 'created_by' => 5, 'updated_by' => 6, 'deleted_by' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'GroupId' => 'GROUP_ID',
        'UserGroups.GroupId' => 'GROUP_ID',
        'groupId' => 'GROUP_ID',
        'userGroups.groupId' => 'GROUP_ID',
        'UserGroupsTableMap::COL_GROUP_ID' => 'GROUP_ID',
        'COL_GROUP_ID' => 'GROUP_ID',
        'group_id' => 'GROUP_ID',
        'public.usergroups.group_id' => 'GROUP_ID',
        'GroupName' => 'GROUP_NAME',
        'UserGroups.GroupName' => 'GROUP_NAME',
        'groupName' => 'GROUP_NAME',
        'userGroups.groupName' => 'GROUP_NAME',
        'UserGroupsTableMap::COL_GROUP_NAME' => 'GROUP_NAME',
        'COL_GROUP_NAME' => 'GROUP_NAME',
        'group_name' => 'GROUP_NAME',
        'public.usergroups.group_name' => 'GROUP_NAME',
        'CreatedAt' => 'CREATED_AT',
        'UserGroups.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'userGroups.createdAt' => 'CREATED_AT',
        'UserGroupsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'public.usergroups.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'UserGroups.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'userGroups.updatedAt' => 'UPDATED_AT',
        'UserGroupsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'public.usergroups.updated_at' => 'UPDATED_AT',
        'DeletedAt' => 'DELETED_AT',
        'UserGroups.DeletedAt' => 'DELETED_AT',
        'deletedAt' => 'DELETED_AT',
        'userGroups.deletedAt' => 'DELETED_AT',
        'UserGroupsTableMap::COL_DELETED_AT' => 'DELETED_AT',
        'COL_DELETED_AT' => 'DELETED_AT',
        'deleted_at' => 'DELETED_AT',
        'public.usergroups.deleted_at' => 'DELETED_AT',
        'CreatedBy' => 'CREATED_BY',
        'UserGroups.CreatedBy' => 'CREATED_BY',
        'createdBy' => 'CREATED_BY',
        'userGroups.createdBy' => 'CREATED_BY',
        'UserGroupsTableMap::COL_CREATED_BY' => 'CREATED_BY',
        'COL_CREATED_BY' => 'CREATED_BY',
        'created_by' => 'CREATED_BY',
        'public.usergroups.created_by' => 'CREATED_BY',
        'UpdatedBy' => 'UPDATED_BY',
        'UserGroups.UpdatedBy' => 'UPDATED_BY',
        'updatedBy' => 'UPDATED_BY',
        'userGroups.updatedBy' => 'UPDATED_BY',
        'UserGroupsTableMap::COL_UPDATED_BY' => 'UPDATED_BY',
        'COL_UPDATED_BY' => 'UPDATED_BY',
        'updated_by' => 'UPDATED_BY',
        'public.usergroups.updated_by' => 'UPDATED_BY',
        'DeletedBy' => 'DELETED_BY',
        'UserGroups.DeletedBy' => 'DELETED_BY',
        'deletedBy' => 'DELETED_BY',
        'userGroups.deletedBy' => 'DELETED_BY',
        'UserGroupsTableMap::COL_DELETED_BY' => 'DELETED_BY',
        'COL_DELETED_BY' => 'DELETED_BY',
        'deleted_by' => 'DELETED_BY',
        'public.usergroups.deleted_by' => 'DELETED_BY',
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
        $this->setName('public.usergroups');
        $this->setPhpName('UserGroups');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\UserGroups');
        $this->setPackage('models');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('public.usergroups_group_id_seq');
        // columns
        $this->addPrimaryKey('group_id', 'GroupId', 'INTEGER', true, null, null);
        $this->addColumn('group_name', 'GroupName', 'VARCHAR', true, 100, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('GroupId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UserGroupsTableMap::CLASS_DEFAULT : UserGroupsTableMap::OM_CLASS;
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
     * @return array           (UserGroups object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserGroupsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserGroupsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserGroupsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserGroupsTableMap::OM_CLASS;
            /** @var UserGroups $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserGroupsTableMap::addInstanceToPool($obj, $key);
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
            $key = UserGroupsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserGroupsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserGroups $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserGroupsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UserGroupsTableMap::COL_GROUP_ID);
            $criteria->addSelectColumn(UserGroupsTableMap::COL_GROUP_NAME);
            $criteria->addSelectColumn(UserGroupsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(UserGroupsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(UserGroupsTableMap::COL_DELETED_AT);
            $criteria->addSelectColumn(UserGroupsTableMap::COL_CREATED_BY);
            $criteria->addSelectColumn(UserGroupsTableMap::COL_UPDATED_BY);
            $criteria->addSelectColumn(UserGroupsTableMap::COL_DELETED_BY);
        } else {
            $criteria->addSelectColumn($alias . '.group_id');
            $criteria->addSelectColumn($alias . '.group_name');
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
            $criteria->removeSelectColumn(UserGroupsTableMap::COL_GROUP_ID);
            $criteria->removeSelectColumn(UserGroupsTableMap::COL_GROUP_NAME);
            $criteria->removeSelectColumn(UserGroupsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(UserGroupsTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(UserGroupsTableMap::COL_DELETED_AT);
            $criteria->removeSelectColumn(UserGroupsTableMap::COL_CREATED_BY);
            $criteria->removeSelectColumn(UserGroupsTableMap::COL_UPDATED_BY);
            $criteria->removeSelectColumn(UserGroupsTableMap::COL_DELETED_BY);
        } else {
            $criteria->removeSelectColumn($alias . '.group_id');
            $criteria->removeSelectColumn($alias . '.group_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(UserGroupsTableMap::DATABASE_NAME)->getTable(UserGroupsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a UserGroups or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or UserGroups object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UserGroupsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\UserGroups) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserGroupsTableMap::DATABASE_NAME);
            $criteria->add(UserGroupsTableMap::COL_GROUP_ID, (array) $values, Criteria::IN);
        }

        $query = UserGroupsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserGroupsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserGroupsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the public.usergroups table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserGroupsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserGroups or Criteria object.
     *
     * @param mixed               $criteria Criteria or UserGroups object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserGroupsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserGroups object
        }

        if ($criteria->containsKey(UserGroupsTableMap::COL_GROUP_ID) && $criteria->keyContainsValue(UserGroupsTableMap::COL_GROUP_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UserGroupsTableMap::COL_GROUP_ID.')');
        }


        // Set the correct dbName
        $query = UserGroupsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserGroupsTableMap
