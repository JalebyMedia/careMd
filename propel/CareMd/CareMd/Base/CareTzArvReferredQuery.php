<?php

namespace CareMd\CareMd\Base;

use \Exception;
use \PDO;
use CareMd\CareMd\CareTzArvReferred as ChildCareTzArvReferred;
use CareMd\CareMd\CareTzArvReferredQuery as ChildCareTzArvReferredQuery;
use CareMd\CareMd\Map\CareTzArvReferredTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'care_tz_arv_referred' table.
 *
 *
 *
 * @method     ChildCareTzArvReferredQuery orderByCareTzArvReferredId($order = Criteria::ASC) Order by the care_tz_arv_referred_id column
 * @method     ChildCareTzArvReferredQuery orderByCareTzArvReferredCodeId($order = Criteria::ASC) Order by the care_tz_arv_referred_code_id column
 * @method     ChildCareTzArvReferredQuery orderByCareTzArvVisit2Id($order = Criteria::ASC) Order by the care_tz_arv_visit_2_id column
 * @method     ChildCareTzArvReferredQuery orderByOther($order = Criteria::ASC) Order by the other column
 *
 * @method     ChildCareTzArvReferredQuery groupByCareTzArvReferredId() Group by the care_tz_arv_referred_id column
 * @method     ChildCareTzArvReferredQuery groupByCareTzArvReferredCodeId() Group by the care_tz_arv_referred_code_id column
 * @method     ChildCareTzArvReferredQuery groupByCareTzArvVisit2Id() Group by the care_tz_arv_visit_2_id column
 * @method     ChildCareTzArvReferredQuery groupByOther() Group by the other column
 *
 * @method     ChildCareTzArvReferredQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCareTzArvReferredQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCareTzArvReferredQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCareTzArvReferredQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCareTzArvReferredQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCareTzArvReferredQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCareTzArvReferred findOne(ConnectionInterface $con = null) Return the first ChildCareTzArvReferred matching the query
 * @method     ChildCareTzArvReferred findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCareTzArvReferred matching the query, or a new ChildCareTzArvReferred object populated from the query conditions when no match is found
 *
 * @method     ChildCareTzArvReferred findOneByCareTzArvReferredId(string $care_tz_arv_referred_id) Return the first ChildCareTzArvReferred filtered by the care_tz_arv_referred_id column
 * @method     ChildCareTzArvReferred findOneByCareTzArvReferredCodeId(string $care_tz_arv_referred_code_id) Return the first ChildCareTzArvReferred filtered by the care_tz_arv_referred_code_id column
 * @method     ChildCareTzArvReferred findOneByCareTzArvVisit2Id(string $care_tz_arv_visit_2_id) Return the first ChildCareTzArvReferred filtered by the care_tz_arv_visit_2_id column
 * @method     ChildCareTzArvReferred findOneByOther(string $other) Return the first ChildCareTzArvReferred filtered by the other column *

 * @method     ChildCareTzArvReferred requirePk($key, ConnectionInterface $con = null) Return the ChildCareTzArvReferred by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvReferred requireOne(ConnectionInterface $con = null) Return the first ChildCareTzArvReferred matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzArvReferred requireOneByCareTzArvReferredId(string $care_tz_arv_referred_id) Return the first ChildCareTzArvReferred filtered by the care_tz_arv_referred_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvReferred requireOneByCareTzArvReferredCodeId(string $care_tz_arv_referred_code_id) Return the first ChildCareTzArvReferred filtered by the care_tz_arv_referred_code_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvReferred requireOneByCareTzArvVisit2Id(string $care_tz_arv_visit_2_id) Return the first ChildCareTzArvReferred filtered by the care_tz_arv_visit_2_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvReferred requireOneByOther(string $other) Return the first ChildCareTzArvReferred filtered by the other column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzArvReferred[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCareTzArvReferred objects based on current ModelCriteria
 * @method     ChildCareTzArvReferred[]|ObjectCollection findByCareTzArvReferredId(string $care_tz_arv_referred_id) Return ChildCareTzArvReferred objects filtered by the care_tz_arv_referred_id column
 * @method     ChildCareTzArvReferred[]|ObjectCollection findByCareTzArvReferredCodeId(string $care_tz_arv_referred_code_id) Return ChildCareTzArvReferred objects filtered by the care_tz_arv_referred_code_id column
 * @method     ChildCareTzArvReferred[]|ObjectCollection findByCareTzArvVisit2Id(string $care_tz_arv_visit_2_id) Return ChildCareTzArvReferred objects filtered by the care_tz_arv_visit_2_id column
 * @method     ChildCareTzArvReferred[]|ObjectCollection findByOther(string $other) Return ChildCareTzArvReferred objects filtered by the other column
 * @method     ChildCareTzArvReferred[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CareTzArvReferredQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CareMd\CareMd\Base\CareTzArvReferredQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CareMd\\CareMd\\CareTzArvReferred', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCareTzArvReferredQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCareTzArvReferredQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCareTzArvReferredQuery) {
            return $criteria;
        }
        $query = new ChildCareTzArvReferredQuery();
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
     * @return ChildCareTzArvReferred|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CareTzArvReferredTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CareTzArvReferredTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCareTzArvReferred A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT care_tz_arv_referred_id, care_tz_arv_referred_code_id, care_tz_arv_visit_2_id, other FROM care_tz_arv_referred WHERE care_tz_arv_referred_id = :p0';
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
            /** @var ChildCareTzArvReferred $obj */
            $obj = new ChildCareTzArvReferred();
            $obj->hydrate($row);
            CareTzArvReferredTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCareTzArvReferred|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCareTzArvReferredQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_REFERRED_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCareTzArvReferredQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_REFERRED_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the care_tz_arv_referred_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCareTzArvReferredId(1234); // WHERE care_tz_arv_referred_id = 1234
     * $query->filterByCareTzArvReferredId(array(12, 34)); // WHERE care_tz_arv_referred_id IN (12, 34)
     * $query->filterByCareTzArvReferredId(array('min' => 12)); // WHERE care_tz_arv_referred_id > 12
     * </code>
     *
     * @param     mixed $careTzArvReferredId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvReferredQuery The current query, for fluid interface
     */
    public function filterByCareTzArvReferredId($careTzArvReferredId = null, $comparison = null)
    {
        if (is_array($careTzArvReferredId)) {
            $useMinMax = false;
            if (isset($careTzArvReferredId['min'])) {
                $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_REFERRED_ID, $careTzArvReferredId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($careTzArvReferredId['max'])) {
                $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_REFERRED_ID, $careTzArvReferredId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_REFERRED_ID, $careTzArvReferredId, $comparison);
    }

    /**
     * Filter the query on the care_tz_arv_referred_code_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCareTzArvReferredCodeId(1234); // WHERE care_tz_arv_referred_code_id = 1234
     * $query->filterByCareTzArvReferredCodeId(array(12, 34)); // WHERE care_tz_arv_referred_code_id IN (12, 34)
     * $query->filterByCareTzArvReferredCodeId(array('min' => 12)); // WHERE care_tz_arv_referred_code_id > 12
     * </code>
     *
     * @param     mixed $careTzArvReferredCodeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvReferredQuery The current query, for fluid interface
     */
    public function filterByCareTzArvReferredCodeId($careTzArvReferredCodeId = null, $comparison = null)
    {
        if (is_array($careTzArvReferredCodeId)) {
            $useMinMax = false;
            if (isset($careTzArvReferredCodeId['min'])) {
                $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_REFERRED_CODE_ID, $careTzArvReferredCodeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($careTzArvReferredCodeId['max'])) {
                $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_REFERRED_CODE_ID, $careTzArvReferredCodeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_REFERRED_CODE_ID, $careTzArvReferredCodeId, $comparison);
    }

    /**
     * Filter the query on the care_tz_arv_visit_2_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCareTzArvVisit2Id(1234); // WHERE care_tz_arv_visit_2_id = 1234
     * $query->filterByCareTzArvVisit2Id(array(12, 34)); // WHERE care_tz_arv_visit_2_id IN (12, 34)
     * $query->filterByCareTzArvVisit2Id(array('min' => 12)); // WHERE care_tz_arv_visit_2_id > 12
     * </code>
     *
     * @param     mixed $careTzArvVisit2Id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvReferredQuery The current query, for fluid interface
     */
    public function filterByCareTzArvVisit2Id($careTzArvVisit2Id = null, $comparison = null)
    {
        if (is_array($careTzArvVisit2Id)) {
            $useMinMax = false;
            if (isset($careTzArvVisit2Id['min'])) {
                $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_VISIT_2_ID, $careTzArvVisit2Id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($careTzArvVisit2Id['max'])) {
                $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_VISIT_2_ID, $careTzArvVisit2Id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_VISIT_2_ID, $careTzArvVisit2Id, $comparison);
    }

    /**
     * Filter the query on the other column
     *
     * Example usage:
     * <code>
     * $query->filterByOther('fooValue');   // WHERE other = 'fooValue'
     * $query->filterByOther('%fooValue%', Criteria::LIKE); // WHERE other LIKE '%fooValue%'
     * </code>
     *
     * @param     string $other The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvReferredQuery The current query, for fluid interface
     */
    public function filterByOther($other = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($other)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvReferredTableMap::COL_OTHER, $other, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCareTzArvReferred $careTzArvReferred Object to remove from the list of results
     *
     * @return $this|ChildCareTzArvReferredQuery The current query, for fluid interface
     */
    public function prune($careTzArvReferred = null)
    {
        if ($careTzArvReferred) {
            $this->addUsingAlias(CareTzArvReferredTableMap::COL_CARE_TZ_ARV_REFERRED_ID, $careTzArvReferred->getCareTzArvReferredId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the care_tz_arv_referred table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzArvReferredTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CareTzArvReferredTableMap::clearInstancePool();
            CareTzArvReferredTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzArvReferredTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CareTzArvReferredTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CareTzArvReferredTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CareTzArvReferredTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CareTzArvReferredQuery
