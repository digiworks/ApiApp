<?php

namespace models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use models\UserPermissions as ChildUserPermissions;
use models\UserPermissionsQuery as ChildUserPermissionsQuery;
use models\Map\UserPermissionsTableMap;

/**
 * Base class that represents a query for the 'public.user_permissions' table.
 *
 *
 *
 * @method     ChildUserPermissionsQuery orderByPid($order = Criteria::ASC) Order by the pid column
 * @method     ChildUserPermissionsQuery orderByPermissionName($order = Criteria::ASC) Order by the permission_name column
 * @method     ChildUserPermissionsQuery orderByPermissionType($order = Criteria::ASC) Order by the permission_type column
 * @method     ChildUserPermissionsQuery orderByUserid($order = Criteria::ASC) Order by the userid column
 * @method     ChildUserPermissionsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUserPermissionsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildUserPermissionsQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 * @method     ChildUserPermissionsQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method     ChildUserPermissionsQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method     ChildUserPermissionsQuery orderByDeletedBy($order = Criteria::ASC) Order by the deleted_by column
 *
 * @method     ChildUserPermissionsQuery groupByPid() Group by the pid column
 * @method     ChildUserPermissionsQuery groupByPermissionName() Group by the permission_name column
 * @method     ChildUserPermissionsQuery groupByPermissionType() Group by the permission_type column
 * @method     ChildUserPermissionsQuery groupByUserid() Group by the userid column
 * @method     ChildUserPermissionsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUserPermissionsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildUserPermissionsQuery groupByDeletedAt() Group by the deleted_at column
 * @method     ChildUserPermissionsQuery groupByCreatedBy() Group by the created_by column
 * @method     ChildUserPermissionsQuery groupByUpdatedBy() Group by the updated_by column
 * @method     ChildUserPermissionsQuery groupByDeletedBy() Group by the deleted_by column
 *
 * @method     ChildUserPermissionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserPermissionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserPermissionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserPermissionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserPermissionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserPermissionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserPermissions|null findOne(ConnectionInterface $con = null) Return the first ChildUserPermissions matching the query
 * @method     ChildUserPermissions findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserPermissions matching the query, or a new ChildUserPermissions object populated from the query conditions when no match is found
 *
 * @method     ChildUserPermissions|null findOneByPid(int $pid) Return the first ChildUserPermissions filtered by the pid column
 * @method     ChildUserPermissions|null findOneByPermissionName(string $permission_name) Return the first ChildUserPermissions filtered by the permission_name column
 * @method     ChildUserPermissions|null findOneByPermissionType(int $permission_type) Return the first ChildUserPermissions filtered by the permission_type column
 * @method     ChildUserPermissions|null findOneByUserid(int $userid) Return the first ChildUserPermissions filtered by the userid column
 * @method     ChildUserPermissions|null findOneByCreatedAt(string $created_at) Return the first ChildUserPermissions filtered by the created_at column
 * @method     ChildUserPermissions|null findOneByUpdatedAt(string $updated_at) Return the first ChildUserPermissions filtered by the updated_at column
 * @method     ChildUserPermissions|null findOneByDeletedAt(string $deleted_at) Return the first ChildUserPermissions filtered by the deleted_at column
 * @method     ChildUserPermissions|null findOneByCreatedBy(int $created_by) Return the first ChildUserPermissions filtered by the created_by column
 * @method     ChildUserPermissions|null findOneByUpdatedBy(int $updated_by) Return the first ChildUserPermissions filtered by the updated_by column
 * @method     ChildUserPermissions|null findOneByDeletedBy(int $deleted_by) Return the first ChildUserPermissions filtered by the deleted_by column *

 * @method     ChildUserPermissions requirePk($key, ConnectionInterface $con = null) Return the ChildUserPermissions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPermissions requireOne(ConnectionInterface $con = null) Return the first ChildUserPermissions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserPermissions requireOneByPid(int $pid) Return the first ChildUserPermissions filtered by the pid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPermissions requireOneByPermissionName(string $permission_name) Return the first ChildUserPermissions filtered by the permission_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPermissions requireOneByPermissionType(int $permission_type) Return the first ChildUserPermissions filtered by the permission_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPermissions requireOneByUserid(int $userid) Return the first ChildUserPermissions filtered by the userid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPermissions requireOneByCreatedAt(string $created_at) Return the first ChildUserPermissions filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPermissions requireOneByUpdatedAt(string $updated_at) Return the first ChildUserPermissions filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPermissions requireOneByDeletedAt(string $deleted_at) Return the first ChildUserPermissions filtered by the deleted_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPermissions requireOneByCreatedBy(int $created_by) Return the first ChildUserPermissions filtered by the created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPermissions requireOneByUpdatedBy(int $updated_by) Return the first ChildUserPermissions filtered by the updated_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserPermissions requireOneByDeletedBy(int $deleted_by) Return the first ChildUserPermissions filtered by the deleted_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserPermissions[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserPermissions objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> find(ConnectionInterface $con = null) Return ChildUserPermissions objects based on current ModelCriteria
 * @method     ChildUserPermissions[]|ObjectCollection findByPid(int $pid) Return ChildUserPermissions objects filtered by the pid column
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> findByPid(int $pid) Return ChildUserPermissions objects filtered by the pid column
 * @method     ChildUserPermissions[]|ObjectCollection findByPermissionName(string $permission_name) Return ChildUserPermissions objects filtered by the permission_name column
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> findByPermissionName(string $permission_name) Return ChildUserPermissions objects filtered by the permission_name column
 * @method     ChildUserPermissions[]|ObjectCollection findByPermissionType(int $permission_type) Return ChildUserPermissions objects filtered by the permission_type column
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> findByPermissionType(int $permission_type) Return ChildUserPermissions objects filtered by the permission_type column
 * @method     ChildUserPermissions[]|ObjectCollection findByUserid(int $userid) Return ChildUserPermissions objects filtered by the userid column
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> findByUserid(int $userid) Return ChildUserPermissions objects filtered by the userid column
 * @method     ChildUserPermissions[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUserPermissions objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> findByCreatedAt(string $created_at) Return ChildUserPermissions objects filtered by the created_at column
 * @method     ChildUserPermissions[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUserPermissions objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> findByUpdatedAt(string $updated_at) Return ChildUserPermissions objects filtered by the updated_at column
 * @method     ChildUserPermissions[]|ObjectCollection findByDeletedAt(string $deleted_at) Return ChildUserPermissions objects filtered by the deleted_at column
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> findByDeletedAt(string $deleted_at) Return ChildUserPermissions objects filtered by the deleted_at column
 * @method     ChildUserPermissions[]|ObjectCollection findByCreatedBy(int $created_by) Return ChildUserPermissions objects filtered by the created_by column
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> findByCreatedBy(int $created_by) Return ChildUserPermissions objects filtered by the created_by column
 * @method     ChildUserPermissions[]|ObjectCollection findByUpdatedBy(int $updated_by) Return ChildUserPermissions objects filtered by the updated_by column
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> findByUpdatedBy(int $updated_by) Return ChildUserPermissions objects filtered by the updated_by column
 * @method     ChildUserPermissions[]|ObjectCollection findByDeletedBy(int $deleted_by) Return ChildUserPermissions objects filtered by the deleted_by column
 * @psalm-method ObjectCollection&\Traversable<ChildUserPermissions> findByDeletedBy(int $deleted_by) Return ChildUserPermissions objects filtered by the deleted_by column
 * @method     ChildUserPermissions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUserPermissions> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserPermissionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\Base\UserPermissionsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\UserPermissions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserPermissionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserPermissionsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserPermissionsQuery) {
            return $criteria;
        }
        $query = new ChildUserPermissionsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUserPermissions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserPermissionsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserPermissionsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserPermissions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT pid, permission_name, permission_type, userid, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by FROM public.user_permissions WHERE pid = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUserPermissions $obj */
            $obj = new ChildUserPermissions();
            $obj->hydrate($row);
            UserPermissionsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildUserPermissions|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserPermissionsTableMap::COL_PID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserPermissionsTableMap::COL_PID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pid column
     *
     * Example usage:
     * <code>
     * $query->filterByPid(1234); // WHERE pid = 1234
     * $query->filterByPid(array(12, 34)); // WHERE pid IN (12, 34)
     * $query->filterByPid(array('min' => 12)); // WHERE pid > 12
     * </code>
     *
     * @param     mixed $pid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByPid($pid = null, $comparison = null)
    {
        if (is_array($pid)) {
            $useMinMax = false;
            if (isset($pid['min'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_PID, $pid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pid['max'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_PID, $pid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPermissionsTableMap::COL_PID, $pid, $comparison);
    }

    /**
     * Filter the query on the permission_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPermissionName('fooValue');   // WHERE permission_name = 'fooValue'
     * $query->filterByPermissionName('%fooValue%', Criteria::LIKE); // WHERE permission_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $permissionName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByPermissionName($permissionName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($permissionName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPermissionsTableMap::COL_PERMISSION_NAME, $permissionName, $comparison);
    }

    /**
     * Filter the query on the permission_type column
     *
     * Example usage:
     * <code>
     * $query->filterByPermissionType(1234); // WHERE permission_type = 1234
     * $query->filterByPermissionType(array(12, 34)); // WHERE permission_type IN (12, 34)
     * $query->filterByPermissionType(array('min' => 12)); // WHERE permission_type > 12
     * </code>
     *
     * @param     mixed $permissionType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByPermissionType($permissionType = null, $comparison = null)
    {
        if (is_array($permissionType)) {
            $useMinMax = false;
            if (isset($permissionType['min'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_PERMISSION_TYPE, $permissionType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($permissionType['max'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_PERMISSION_TYPE, $permissionType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPermissionsTableMap::COL_PERMISSION_TYPE, $permissionType, $comparison);
    }

    /**
     * Filter the query on the userid column
     *
     * Example usage:
     * <code>
     * $query->filterByUserid(1234); // WHERE userid = 1234
     * $query->filterByUserid(array(12, 34)); // WHERE userid IN (12, 34)
     * $query->filterByUserid(array('min' => 12)); // WHERE userid > 12
     * </code>
     *
     * @param     mixed $userid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByUserid($userid = null, $comparison = null)
    {
        if (is_array($userid)) {
            $useMinMax = false;
            if (isset($userid['min'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_USERID, $userid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userid['max'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_USERID, $userid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPermissionsTableMap::COL_USERID, $userid, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPermissionsTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPermissionsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the deleted_at column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedAt('2011-03-14'); // WHERE deleted_at = '2011-03-14'
     * $query->filterByDeletedAt('now'); // WHERE deleted_at = '2011-03-14'
     * $query->filterByDeletedAt(array('max' => 'yesterday')); // WHERE deleted_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $deletedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByDeletedAt($deletedAt = null, $comparison = null)
    {
        if (is_array($deletedAt)) {
            $useMinMax = false;
            if (isset($deletedAt['min'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedAt['max'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPermissionsTableMap::COL_DELETED_AT, $deletedAt, $comparison);
    }

    /**
     * Filter the query on the created_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedBy(1234); // WHERE created_by = 1234
     * $query->filterByCreatedBy(array(12, 34)); // WHERE created_by IN (12, 34)
     * $query->filterByCreatedBy(array('min' => 12)); // WHERE created_by > 12
     * </code>
     *
     * @param     mixed $createdBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (is_array($createdBy)) {
            $useMinMax = false;
            if (isset($createdBy['min'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdBy['max'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPermissionsTableMap::COL_CREATED_BY, $createdBy, $comparison);
    }

    /**
     * Filter the query on the updated_by column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedBy(1234); // WHERE updated_by = 1234
     * $query->filterByUpdatedBy(array(12, 34)); // WHERE updated_by IN (12, 34)
     * $query->filterByUpdatedBy(array('min' => 12)); // WHERE updated_by > 12
     * </code>
     *
     * @param     mixed $updatedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByUpdatedBy($updatedBy = null, $comparison = null)
    {
        if (is_array($updatedBy)) {
            $useMinMax = false;
            if (isset($updatedBy['min'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_UPDATED_BY, $updatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedBy['max'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_UPDATED_BY, $updatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPermissionsTableMap::COL_UPDATED_BY, $updatedBy, $comparison);
    }

    /**
     * Filter the query on the deleted_by column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedBy(1234); // WHERE deleted_by = 1234
     * $query->filterByDeletedBy(array(12, 34)); // WHERE deleted_by IN (12, 34)
     * $query->filterByDeletedBy(array('min' => 12)); // WHERE deleted_by > 12
     * </code>
     *
     * @param     mixed $deletedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function filterByDeletedBy($deletedBy = null, $comparison = null)
    {
        if (is_array($deletedBy)) {
            $useMinMax = false;
            if (isset($deletedBy['min'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_DELETED_BY, $deletedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedBy['max'])) {
                $this->addUsingAlias(UserPermissionsTableMap::COL_DELETED_BY, $deletedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPermissionsTableMap::COL_DELETED_BY, $deletedBy, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserPermissions $userPermissions Object to remove from the list of results
     *
     * @return $this|ChildUserPermissionsQuery The current query, for fluid interface
     */
    public function prune($userPermissions = null)
    {
        if ($userPermissions) {
            $this->addUsingAlias(UserPermissionsTableMap::COL_PID, $userPermissions->getPid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the public.user_permissions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserPermissionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserPermissionsTableMap::clearInstancePool();
            UserPermissionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserPermissionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserPermissionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserPermissionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserPermissionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserPermissionsQuery
