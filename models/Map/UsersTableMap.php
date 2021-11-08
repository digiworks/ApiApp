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
use models\Users;
use models\UsersQuery;


/**
 * This class defines the structure of the 'public.users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.Map.UsersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'public.users';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\Users';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.Users';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    const COL_ID = 'public.users.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'public.users.name';

    /**
     * the column name for the surname field
     */
    const COL_SURNAME = 'public.users.surname';

    /**
     * the column name for the hash field
     */
    const COL_HASH = 'public.users.hash';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'public.users.status';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'public.users.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'public.users.updated_at';

    /**
     * the column name for the deleted_at field
     */
    const COL_DELETED_AT = 'public.users.deleted_at';

    /**
     * the column name for the created_by field
     */
    const COL_CREATED_BY = 'public.users.created_by';

    /**
     * the column name for the updated_by field
     */
    const COL_UPDATED_BY = 'public.users.updated_by';

    /**
     * the column name for the deleted_by field
     */
    const COL_DELETED_BY = 'public.users.deleted_by';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'surname', 'hash', 'Status', 'CreatedAt', 'UpdatedAt', 'DeletedAt', 'CreatedBy', 'UpdatedBy', 'DeletedBy', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'surname', 'hash', 'status', 'createdAt', 'updatedAt', 'deletedAt', 'createdBy', 'updatedBy', 'deletedBy', ),
        self::TYPE_COLNAME       => array(UsersTableMap::COL_ID, UsersTableMap::COL_NAME, UsersTableMap::COL_SURNAME, UsersTableMap::COL_HASH, UsersTableMap::COL_STATUS, UsersTableMap::COL_CREATED_AT, UsersTableMap::COL_UPDATED_AT, UsersTableMap::COL_DELETED_AT, UsersTableMap::COL_CREATED_BY, UsersTableMap::COL_UPDATED_BY, UsersTableMap::COL_DELETED_BY, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'surname', 'hash', 'status', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'surname' => 2, 'hash' => 3, 'Status' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'DeletedAt' => 7, 'CreatedBy' => 8, 'UpdatedBy' => 9, 'DeletedBy' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'surname' => 2, 'hash' => 3, 'status' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'deletedAt' => 7, 'createdBy' => 8, 'updatedBy' => 9, 'deletedBy' => 10, ),
        self::TYPE_COLNAME       => array(UsersTableMap::COL_ID => 0, UsersTableMap::COL_NAME => 1, UsersTableMap::COL_SURNAME => 2, UsersTableMap::COL_HASH => 3, UsersTableMap::COL_STATUS => 4, UsersTableMap::COL_CREATED_AT => 5, UsersTableMap::COL_UPDATED_AT => 6, UsersTableMap::COL_DELETED_AT => 7, UsersTableMap::COL_CREATED_BY => 8, UsersTableMap::COL_UPDATED_BY => 9, UsersTableMap::COL_DELETED_BY => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'surname' => 2, 'hash' => 3, 'status' => 4, 'created_at' => 5, 'updated_at' => 6, 'deleted_at' => 7, 'created_by' => 8, 'updated_by' => 9, 'deleted_by' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Users.Id' => 'ID',
        'id' => 'ID',
        'users.id' => 'ID',
        'UsersTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'public.users.id' => 'ID',
        'Name' => 'NAME',
        'Users.Name' => 'NAME',
        'name' => 'NAME',
        'users.name' => 'NAME',
        'UsersTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'public.users.name' => 'NAME',
        'surname' => 'SURNAME',
        'Users.surname' => 'SURNAME',
        'users.surname' => 'SURNAME',
        'UsersTableMap::COL_SURNAME' => 'SURNAME',
        'COL_SURNAME' => 'SURNAME',
        'public.users.surname' => 'SURNAME',
        'hash' => 'HASH',
        'Users.hash' => 'HASH',
        'users.hash' => 'HASH',
        'UsersTableMap::COL_HASH' => 'HASH',
        'COL_HASH' => 'HASH',
        'public.users.hash' => 'HASH',
        'Status' => 'STATUS',
        'Users.Status' => 'STATUS',
        'status' => 'STATUS',
        'users.status' => 'STATUS',
        'UsersTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'public.users.status' => 'STATUS',
        'CreatedAt' => 'CREATED_AT',
        'Users.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'users.createdAt' => 'CREATED_AT',
        'UsersTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'public.users.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Users.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'users.updatedAt' => 'UPDATED_AT',
        'UsersTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'public.users.updated_at' => 'UPDATED_AT',
        'DeletedAt' => 'DELETED_AT',
        'Users.DeletedAt' => 'DELETED_AT',
        'deletedAt' => 'DELETED_AT',
        'users.deletedAt' => 'DELETED_AT',
        'UsersTableMap::COL_DELETED_AT' => 'DELETED_AT',
        'COL_DELETED_AT' => 'DELETED_AT',
        'deleted_at' => 'DELETED_AT',
        'public.users.deleted_at' => 'DELETED_AT',
        'CreatedBy' => 'CREATED_BY',
        'Users.CreatedBy' => 'CREATED_BY',
        'createdBy' => 'CREATED_BY',
        'users.createdBy' => 'CREATED_BY',
        'UsersTableMap::COL_CREATED_BY' => 'CREATED_BY',
        'COL_CREATED_BY' => 'CREATED_BY',
        'created_by' => 'CREATED_BY',
        'public.users.created_by' => 'CREATED_BY',
        'UpdatedBy' => 'UPDATED_BY',
        'Users.UpdatedBy' => 'UPDATED_BY',
        'updatedBy' => 'UPDATED_BY',
        'users.updatedBy' => 'UPDATED_BY',
        'UsersTableMap::COL_UPDATED_BY' => 'UPDATED_BY',
        'COL_UPDATED_BY' => 'UPDATED_BY',
        'updated_by' => 'UPDATED_BY',
        'public.users.updated_by' => 'UPDATED_BY',
        'DeletedBy' => 'DELETED_BY',
        'Users.DeletedBy' => 'DELETED_BY',
        'deletedBy' => 'DELETED_BY',
        'users.deletedBy' => 'DELETED_BY',
        'UsersTableMap::COL_DELETED_BY' => 'DELETED_BY',
        'COL_DELETED_BY' => 'DELETED_BY',
        'deleted_by' => 'DELETED_BY',
        'public.users.deleted_by' => 'DELETED_BY',
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
        $this->setName('public.users');
        $this->setPhpName('Users');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\Users');
        $this->setPackage('models');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('public.users_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('surname', 'surname', 'VARCHAR', true, 255, null);
        $this->addColumn('hash', 'hash', 'VARCHAR', true, 255, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? UsersTableMap::CLASS_DEFAULT : UsersTableMap::OM_CLASS;
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
     * @return array           (Users object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersTableMap::OM_CLASS;
            /** @var Users $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Users $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersTableMap::COL_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_NAME);
            $criteria->addSelectColumn(UsersTableMap::COL_SURNAME);
            $criteria->addSelectColumn(UsersTableMap::COL_HASH);
            $criteria->addSelectColumn(UsersTableMap::COL_STATUS);
            $criteria->addSelectColumn(UsersTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(UsersTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(UsersTableMap::COL_DELETED_AT);
            $criteria->addSelectColumn(UsersTableMap::COL_CREATED_BY);
            $criteria->addSelectColumn(UsersTableMap::COL_UPDATED_BY);
            $criteria->addSelectColumn(UsersTableMap::COL_DELETED_BY);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.surname');
            $criteria->addSelectColumn($alias . '.hash');
            $criteria->addSelectColumn($alias . '.status');
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
            $criteria->removeSelectColumn(UsersTableMap::COL_ID);
            $criteria->removeSelectColumn(UsersTableMap::COL_NAME);
            $criteria->removeSelectColumn(UsersTableMap::COL_SURNAME);
            $criteria->removeSelectColumn(UsersTableMap::COL_HASH);
            $criteria->removeSelectColumn(UsersTableMap::COL_STATUS);
            $criteria->removeSelectColumn(UsersTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(UsersTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(UsersTableMap::COL_DELETED_AT);
            $criteria->removeSelectColumn(UsersTableMap::COL_CREATED_BY);
            $criteria->removeSelectColumn(UsersTableMap::COL_UPDATED_BY);
            $criteria->removeSelectColumn(UsersTableMap::COL_DELETED_BY);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.surname');
            $criteria->removeSelectColumn($alias . '.hash');
            $criteria->removeSelectColumn($alias . '.status');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME)->getTable(UsersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Users or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Users object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\Users) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersTableMap::DATABASE_NAME);
            $criteria->add(UsersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the public.users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Users or Criteria object.
     *
     * @param mixed               $criteria Criteria or Users object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Users object
        }

        if ($criteria->containsKey(UsersTableMap::COL_ID) && $criteria->keyContainsValue(UsersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsersTableMap
