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
use models\UserGroups as ChildUserGroups;
use models\UserGroupsQuery as ChildUserGroupsQuery;
use models\Map\UserGroupsTableMap;

/**
 * Base class that represents a query for the 'public.usergroups' table.
 *
 *
 *
 * @method     ChildUserGroupsQuery orderByGroupId($order = Criteria::ASC) Order by the group_id column
 * @method     ChildUserGroupsQuery orderByGroupName($order = Criteria::ASC) Order by the group_name column
 * @method     ChildUserGroupsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUserGroupsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildUserGroupsQuery orderByDeletedAt($order = Criteria::ASC) Order by the deleted_at column
 * @method     ChildUserGroupsQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method     ChildUserGroupsQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method     ChildUserGroupsQuery orderByDelatedBy($order = Criteria::ASC) Order by the delated_by column
 *
 * @method     ChildUserGroupsQuery groupByGroupId() Group by the group_id column
 * @method     ChildUserGroupsQuery groupByGroupName() Group by the group_name column
 * @method     ChildUserGroupsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUserGroupsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildUserGroupsQuery groupByDeletedAt() Group by the deleted_at column
 * @method     ChildUserGroupsQuery groupByCreatedBy() Group by the created_by column
 * @method     ChildUserGroupsQuery groupByUpdatedBy() Group by the updated_by column
 * @method     ChildUserGroupsQuery groupByDelatedBy() Group by the delated_by column
 *
 * @method     ChildUserGroupsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserGroupsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserGroupsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserGroupsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserGroupsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserGroupsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserGroups|null findOne(ConnectionInterface $con = null) Return the first ChildUserGroups matching the query
 * @method     ChildUserGroups findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserGroups matching the query, or a new ChildUserGroups object populated from the query conditions when no match is found
 *
 * @method     ChildUserGroups|null findOneByGroupId(int $group_id) Return the first ChildUserGroups filtered by the group_id column
 * @method     ChildUserGroups|null findOneByGroupName(string $group_name) Return the first ChildUserGroups filtered by the group_name column
 * @method     ChildUserGroups|null findOneByCreatedAt(string $created_at) Return the first ChildUserGroups filtered by the created_at column
 * @method     ChildUserGroups|null findOneByUpdatedAt(string $updated_at) Return the first ChildUserGroups filtered by the updated_at column
 * @method     ChildUserGroups|null findOneByDeletedAt(string $deleted_at) Return the first ChildUserGroups filtered by the deleted_at column
 * @method     ChildUserGroups|null findOneByCreatedBy(int $created_by) Return the first ChildUserGroups filtered by the created_by column
 * @method     ChildUserGroups|null findOneByUpdatedBy(int $updated_by) Return the first ChildUserGroups filtered by the updated_by column
 * @method     ChildUserGroups|null findOneByDelatedBy(int $delated_by) Return the first ChildUserGroups filtered by the delated_by column *

 * @method     ChildUserGroups requirePk($key, ConnectionInterface $con = null) Return the ChildUserGroups by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroups requireOne(ConnectionInterface $con = null) Return the first ChildUserGroups matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserGroups requireOneByGroupId(int $group_id) Return the first ChildUserGroups filtered by the group_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroups requireOneByGroupName(string $group_name) Return the first ChildUserGroups filtered by the group_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroups requireOneByCreatedAt(string $created_at) Return the first ChildUserGroups filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroups requireOneByUpdatedAt(string $updated_at) Return the first ChildUserGroups filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroups requireOneByDeletedAt(string $deleted_at) Return the first ChildUserGroups filtered by the deleted_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroups requireOneByCreatedBy(int $created_by) Return the first ChildUserGroups filtered by the created_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroups requireOneByUpdatedBy(int $updated_by) Return the first ChildUserGroups filtered by the updated_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserGroups requireOneByDelatedBy(int $delated_by) Return the first ChildUserGroups filtered by the delated_by column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserGroups[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserGroups objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildUserGroups> find(ConnectionInterface $con = null) Return ChildUserGroups objects based on current ModelCriteria
 * @method     ChildUserGroups[]|ObjectCollection findByGroupId(int $group_id) Return ChildUserGroups objects filtered by the group_id column
 * @psalm-method ObjectCollection&\Traversable<ChildUserGroups> findByGroupId(int $group_id) Return ChildUserGroups objects filtered by the group_id column
 * @method     ChildUserGroups[]|ObjectCollection findByGroupName(string $group_name) Return ChildUserGroups objects filtered by the group_name column
 * @psalm-method ObjectCollection&\Traversable<ChildUserGroups> findByGroupName(string $group_name) Return ChildUserGroups objects filtered by the group_name column
 * @method     ChildUserGroups[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUserGroups objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildUserGroups> findByCreatedAt(string $created_at) Return ChildUserGroups objects filtered by the created_at column
 * @method     ChildUserGroups[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUserGroups objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildUserGroups> findByUpdatedAt(string $updated_at) Return ChildUserGroups objects filtered by the updated_at column
 * @method     ChildUserGroups[]|ObjectCollection findByDeletedAt(string $deleted_at) Return ChildUserGroups objects filtered by the deleted_at column
 * @psalm-method ObjectCollection&\Traversable<ChildUserGroups> findByDeletedAt(string $deleted_at) Return ChildUserGroups objects filtered by the deleted_at column
 * @method     ChildUserGroups[]|ObjectCollection findByCreatedBy(int $created_by) Return ChildUserGroups objects filtered by the created_by column
 * @psalm-method ObjectCollection&\Traversable<ChildUserGroups> findByCreatedBy(int $created_by) Return ChildUserGroups objects filtered by the created_by column
 * @method     ChildUserGroups[]|ObjectCollection findByUpdatedBy(int $updated_by) Return ChildUserGroups objects filtered by the updated_by column
 * @psalm-method ObjectCollection&\Traversable<ChildUserGroups> findByUpdatedBy(int $updated_by) Return ChildUserGroups objects filtered by the updated_by column
 * @method     ChildUserGroups[]|ObjectCollection findByDelatedBy(int $delated_by) Return ChildUserGroups objects filtered by the delated_by column
 * @psalm-method ObjectCollection&\Traversable<ChildUserGroups> findByDelatedBy(int $delated_by) Return ChildUserGroups objects filtered by the delated_by column
 * @method     ChildUserGroups[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUserGroups> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserGroupsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\Base\UserGroupsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\UserGroups', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserGroupsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserGroupsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserGroupsQuery) {
            return $criteria;
        }
        $query = new ChildUserGroupsQuery();
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
     * @return ChildUserGroups|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserGroupsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserGroupsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUserGroups A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT group_id, group_name, created_at, updated_at, deleted_at, created_by, updated_by, delated_by FROM public.usergroups WHERE group_id = :p0';
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
            /** @var ChildUserGroups $obj */
            $obj = new ChildUserGroups();
            $obj->hydrate($row);
            UserGroupsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUserGroups|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserGroupsTableMap::COL_GROUP_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserGroupsTableMap::COL_GROUP_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the group_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupId(1234); // WHERE group_id = 1234
     * $query->filterByGroupId(array(12, 34)); // WHERE group_id IN (12, 34)
     * $query->filterByGroupId(array('min' => 12)); // WHERE group_id > 12
     * </code>
     *
     * @param     mixed $groupId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function filterByGroupId($groupId = null, $comparison = null)
    {
        if (is_array($groupId)) {
            $useMinMax = false;
            if (isset($groupId['min'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_GROUP_ID, $groupId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($groupId['max'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_GROUP_ID, $groupId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupsTableMap::COL_GROUP_ID, $groupId, $comparison);
    }

    /**
     * Filter the query on the group_name column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupName('fooValue');   // WHERE group_name = 'fooValue'
     * $query->filterByGroupName('%fooValue%', Criteria::LIKE); // WHERE group_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $groupName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function filterByGroupName($groupName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($groupName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupsTableMap::COL_GROUP_NAME, $groupName, $comparison);
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
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupsTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
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
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function filterByDeletedAt($deletedAt = null, $comparison = null)
    {
        if (is_array($deletedAt)) {
            $useMinMax = false;
            if (isset($deletedAt['min'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_DELETED_AT, $deletedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedAt['max'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_DELETED_AT, $deletedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupsTableMap::COL_DELETED_AT, $deletedAt, $comparison);
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
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (is_array($createdBy)) {
            $useMinMax = false;
            if (isset($createdBy['min'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdBy['max'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupsTableMap::COL_CREATED_BY, $createdBy, $comparison);
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
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function filterByUpdatedBy($updatedBy = null, $comparison = null)
    {
        if (is_array($updatedBy)) {
            $useMinMax = false;
            if (isset($updatedBy['min'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_UPDATED_BY, $updatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedBy['max'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_UPDATED_BY, $updatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupsTableMap::COL_UPDATED_BY, $updatedBy, $comparison);
    }

    /**
     * Filter the query on the delated_by column
     *
     * Example usage:
     * <code>
     * $query->filterByDelatedBy(1234); // WHERE delated_by = 1234
     * $query->filterByDelatedBy(array(12, 34)); // WHERE delated_by IN (12, 34)
     * $query->filterByDelatedBy(array('min' => 12)); // WHERE delated_by > 12
     * </code>
     *
     * @param     mixed $delatedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function filterByDelatedBy($delatedBy = null, $comparison = null)
    {
        if (is_array($delatedBy)) {
            $useMinMax = false;
            if (isset($delatedBy['min'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_DELATED_BY, $delatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($delatedBy['max'])) {
                $this->addUsingAlias(UserGroupsTableMap::COL_DELATED_BY, $delatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserGroupsTableMap::COL_DELATED_BY, $delatedBy, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserGroups $userGroups Object to remove from the list of results
     *
     * @return $this|ChildUserGroupsQuery The current query, for fluid interface
     */
    public function prune($userGroups = null)
    {
        if ($userGroups) {
            $this->addUsingAlias(UserGroupsTableMap::COL_GROUP_ID, $userGroups->getGroupId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the public.usergroups table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserGroupsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserGroupsTableMap::clearInstancePool();
            UserGroupsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserGroupsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserGroupsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserGroupsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserGroupsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserGroupsQuery
