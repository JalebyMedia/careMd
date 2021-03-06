<?php

namespace CareMd\CareMd\Base;

use \Exception;
use \PDO;
use CareMd\CareMd\CareTzArvEligibleReason as ChildCareTzArvEligibleReason;
use CareMd\CareMd\CareTzArvEligibleReasonQuery as ChildCareTzArvEligibleReasonQuery;
use CareMd\CareMd\Map\CareTzArvEligibleReasonTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'care_tz_arv_eligible_reason' table.
 *
 *
 *
 * @method     ChildCareTzArvEligibleReasonQuery orderByCareTzArvEligibleReasonId($order = Criteria::ASC) Order by the care_tz_arv_eligible_reason_id column
 * @method     ChildCareTzArvEligibleReasonQuery orderByCareTzArvEligibleReasonCodeId($order = Criteria::ASC) Order by the care_tz_arv_eligible_reason_code_id column
 * @method     ChildCareTzArvEligibleReasonQuery orderByCareTzArvRegistrationId($order = Criteria::ASC) Order by the care_tz_arv_registration_id column
 * @method     ChildCareTzArvEligibleReasonQuery orderByCareTzArvLabId($order = Criteria::ASC) Order by the care_tz_arv_lab_id column
 *
 * @method     ChildCareTzArvEligibleReasonQuery groupByCareTzArvEligibleReasonId() Group by the care_tz_arv_eligible_reason_id column
 * @method     ChildCareTzArvEligibleReasonQuery groupByCareTzArvEligibleReasonCodeId() Group by the care_tz_arv_eligible_reason_code_id column
 * @method     ChildCareTzArvEligibleReasonQuery groupByCareTzArvRegistrationId() Group by the care_tz_arv_registration_id column
 * @method     ChildCareTzArvEligibleReasonQuery groupByCareTzArvLabId() Group by the care_tz_arv_lab_id column
 *
 * @method     ChildCareTzArvEligibleReasonQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCareTzArvEligibleReasonQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCareTzArvEligibleReasonQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCareTzArvEligibleReasonQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCareTzArvEligibleReasonQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCareTzArvEligibleReasonQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCareTzArvEligibleReason findOne(ConnectionInterface $con = null) Return the first ChildCareTzArvEligibleReason matching the query
 * @method     ChildCareTzArvEligibleReason findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCareTzArvEligibleReason matching the query, or a new ChildCareTzArvEligibleReason object populated from the query conditions when no match is found
 *
 * @method     ChildCareTzArvEligibleReason findOneByCareTzArvEligibleReasonId(int $care_tz_arv_eligible_reason_id) Return the first ChildCareTzArvEligibleReason filtered by the care_tz_arv_eligible_reason_id column
 * @method     ChildCareTzArvEligibleReason findOneByCareTzArvEligibleReasonCodeId(int $care_tz_arv_eligible_reason_code_id) Return the first ChildCareTzArvEligibleReason filtered by the care_tz_arv_eligible_reason_code_id column
 * @method     ChildCareTzArvEligibleReason findOneByCareTzArvRegistrationId(string $care_tz_arv_registration_id) Return the first ChildCareTzArvEligibleReason filtered by the care_tz_arv_registration_id column
 * @method     ChildCareTzArvEligibleReason findOneByCareTzArvLabId(string $care_tz_arv_lab_id) Return the first ChildCareTzArvEligibleReason filtered by the care_tz_arv_lab_id column *

 * @method     ChildCareTzArvEligibleReason requirePk($key, ConnectionInterface $con = null) Return the ChildCareTzArvEligibleReason by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvEligibleReason requireOne(ConnectionInterface $con = null) Return the first ChildCareTzArvEligibleReason matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzArvEligibleReason requireOneByCareTzArvEligibleReasonId(int $care_tz_arv_eligible_reason_id) Return the first ChildCareTzArvEligibleReason filtered by the care_tz_arv_eligible_reason_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvEligibleReason requireOneByCareTzArvEligibleReasonCodeId(int $care_tz_arv_eligible_reason_code_id) Return the first ChildCareTzArvEligibleReason filtered by the care_tz_arv_eligible_reason_code_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvEligibleReason requireOneByCareTzArvRegistrationId(string $care_tz_arv_registration_id) Return the first ChildCareTzArvEligibleReason filtered by the care_tz_arv_registration_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvEligibleReason requireOneByCareTzArvLabId(string $care_tz_arv_lab_id) Return the first ChildCareTzArvEligibleReason filtered by the care_tz_arv_lab_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzArvEligibleReason[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCareTzArvEligibleReason objects based on current ModelCriteria
 * @method     ChildCareTzArvEligibleReason[]|ObjectCollection findByCareTzArvEligibleReasonId(int $care_tz_arv_eligible_reason_id) Return ChildCareTzArvEligibleReason objects filtered by the care_tz_arv_eligible_reason_id column
 * @method     ChildCareTzArvEligibleReason[]|ObjectCollection findByCareTzArvEligibleReasonCodeId(int $care_tz_arv_eligible_reason_code_id) Return ChildCareTzArvEligibleReason objects filtered by the care_tz_arv_eligible_reason_code_id column
 * @method     ChildCareTzArvEligibleReason[]|ObjectCollection findByCareTzArvRegistrationId(string $care_tz_arv_registration_id) Return ChildCareTzArvEligibleReason objects filtered by the care_tz_arv_registration_id column
 * @method     ChildCareTzArvEligibleReason[]|ObjectCollection findByCareTzArvLabId(string $care_tz_arv_lab_id) Return ChildCareTzArvEligibleReason objects filtered by the care_tz_arv_lab_id column
 * @method     ChildCareTzArvEligibleReason[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CareTzArvEligibleReasonQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CareMd\CareMd\Base\CareTzArvEligibleReasonQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CareMd\\CareMd\\CareTzArvEligibleReason', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCareTzArvEligibleReasonQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCareTzArvEligibleReasonQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCareTzArvEligibleReasonQuery) {
            return $criteria;
        }
        $query = new ChildCareTzArvEligibleReasonQuery();
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
     * @return ChildCareTzArvEligibleReason|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CareTzArvEligibleReasonTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CareTzArvEligibleReasonTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCareTzArvEligibleReason A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT care_tz_arv_eligible_reason_id, care_tz_arv_eligible_reason_code_id, care_tz_arv_registration_id, care_tz_arv_lab_id FROM care_tz_arv_eligible_reason WHERE care_tz_arv_eligible_reason_id = :p0';
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
            /** @var ChildCareTzArvEligibleReason $obj */
            $obj = new ChildCareTzArvEligibleReason();
            $obj->hydrate($row);
            CareTzArvEligibleReasonTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCareTzArvEligibleReason|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCareTzArvEligibleReasonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_ELIGIBLE_REASON_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCareTzArvEligibleReasonQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_ELIGIBLE_REASON_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the care_tz_arv_eligible_reason_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCareTzArvEligibleReasonId(1234); // WHERE care_tz_arv_eligible_reason_id = 1234
     * $query->filterByCareTzArvEligibleReasonId(array(12, 34)); // WHERE care_tz_arv_eligible_reason_id IN (12, 34)
     * $query->filterByCareTzArvEligibleReasonId(array('min' => 12)); // WHERE care_tz_arv_eligible_reason_id > 12
     * </code>
     *
     * @param     mixed $careTzArvEligibleReasonId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvEligibleReasonQuery The current query, for fluid interface
     */
    public function filterByCareTzArvEligibleReasonId($careTzArvEligibleReasonId = null, $comparison = null)
    {
        if (is_array($careTzArvEligibleReasonId)) {
            $useMinMax = false;
            if (isset($careTzArvEligibleReasonId['min'])) {
                $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_ELIGIBLE_REASON_ID, $careTzArvEligibleReasonId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($careTzArvEligibleReasonId['max'])) {
                $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_ELIGIBLE_REASON_ID, $careTzArvEligibleReasonId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_ELIGIBLE_REASON_ID, $careTzArvEligibleReasonId, $comparison);
    }

    /**
     * Filter the query on the care_tz_arv_eligible_reason_code_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCareTzArvEligibleReasonCodeId(1234); // WHERE care_tz_arv_eligible_reason_code_id = 1234
     * $query->filterByCareTzArvEligibleReasonCodeId(array(12, 34)); // WHERE care_tz_arv_eligible_reason_code_id IN (12, 34)
     * $query->filterByCareTzArvEligibleReasonCodeId(array('min' => 12)); // WHERE care_tz_arv_eligible_reason_code_id > 12
     * </code>
     *
     * @param     mixed $careTzArvEligibleReasonCodeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvEligibleReasonQuery The current query, for fluid interface
     */
    public function filterByCareTzArvEligibleReasonCodeId($careTzArvEligibleReasonCodeId = null, $comparison = null)
    {
        if (is_array($careTzArvEligibleReasonCodeId)) {
            $useMinMax = false;
            if (isset($careTzArvEligibleReasonCodeId['min'])) {
                $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_ELIGIBLE_REASON_CODE_ID, $careTzArvEligibleReasonCodeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($careTzArvEligibleReasonCodeId['max'])) {
                $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_ELIGIBLE_REASON_CODE_ID, $careTzArvEligibleReasonCodeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_ELIGIBLE_REASON_CODE_ID, $careTzArvEligibleReasonCodeId, $comparison);
    }

    /**
     * Filter the query on the care_tz_arv_registration_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCareTzArvRegistrationId(1234); // WHERE care_tz_arv_registration_id = 1234
     * $query->filterByCareTzArvRegistrationId(array(12, 34)); // WHERE care_tz_arv_registration_id IN (12, 34)
     * $query->filterByCareTzArvRegistrationId(array('min' => 12)); // WHERE care_tz_arv_registration_id > 12
     * </code>
     *
     * @param     mixed $careTzArvRegistrationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvEligibleReasonQuery The current query, for fluid interface
     */
    public function filterByCareTzArvRegistrationId($careTzArvRegistrationId = null, $comparison = null)
    {
        if (is_array($careTzArvRegistrationId)) {
            $useMinMax = false;
            if (isset($careTzArvRegistrationId['min'])) {
                $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_REGISTRATION_ID, $careTzArvRegistrationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($careTzArvRegistrationId['max'])) {
                $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_REGISTRATION_ID, $careTzArvRegistrationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_REGISTRATION_ID, $careTzArvRegistrationId, $comparison);
    }

    /**
     * Filter the query on the care_tz_arv_lab_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCareTzArvLabId(1234); // WHERE care_tz_arv_lab_id = 1234
     * $query->filterByCareTzArvLabId(array(12, 34)); // WHERE care_tz_arv_lab_id IN (12, 34)
     * $query->filterByCareTzArvLabId(array('min' => 12)); // WHERE care_tz_arv_lab_id > 12
     * </code>
     *
     * @param     mixed $careTzArvLabId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvEligibleReasonQuery The current query, for fluid interface
     */
    public function filterByCareTzArvLabId($careTzArvLabId = null, $comparison = null)
    {
        if (is_array($careTzArvLabId)) {
            $useMinMax = false;
            if (isset($careTzArvLabId['min'])) {
                $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_LAB_ID, $careTzArvLabId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($careTzArvLabId['max'])) {
                $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_LAB_ID, $careTzArvLabId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_LAB_ID, $careTzArvLabId, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCareTzArvEligibleReason $careTzArvEligibleReason Object to remove from the list of results
     *
     * @return $this|ChildCareTzArvEligibleReasonQuery The current query, for fluid interface
     */
    public function prune($careTzArvEligibleReason = null)
    {
        if ($careTzArvEligibleReason) {
            $this->addUsingAlias(CareTzArvEligibleReasonTableMap::COL_CARE_TZ_ARV_ELIGIBLE_REASON_ID, $careTzArvEligibleReason->getCareTzArvEligibleReasonId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the care_tz_arv_eligible_reason table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzArvEligibleReasonTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CareTzArvEligibleReasonTableMap::clearInstancePool();
            CareTzArvEligibleReasonTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzArvEligibleReasonTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CareTzArvEligibleReasonTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CareTzArvEligibleReasonTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CareTzArvEligibleReasonTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CareTzArvEligibleReasonQuery
