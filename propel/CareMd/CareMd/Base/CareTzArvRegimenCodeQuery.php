<?php

namespace CareMd\CareMd\Base;

use \Exception;
use \PDO;
use CareMd\CareMd\CareTzArvRegimenCode as ChildCareTzArvRegimenCode;
use CareMd\CareMd\CareTzArvRegimenCodeQuery as ChildCareTzArvRegimenCodeQuery;
use CareMd\CareMd\Map\CareTzArvRegimenCodeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'care_tz_arv_regimen_code' table.
 *
 *
 *
 * @method     ChildCareTzArvRegimenCodeQuery orderByCareTzArvRegimenCodeId($order = Criteria::ASC) Order by the care_tz_arv_regimen_code_id column
 * @method     ChildCareTzArvRegimenCodeQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildCareTzArvRegimenCodeQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildCareTzArvRegimenCodeQuery orderByParent($order = Criteria::ASC) Order by the parent column
 * @method     ChildCareTzArvRegimenCodeQuery orderByOther($order = Criteria::ASC) Order by the other column
 *
 * @method     ChildCareTzArvRegimenCodeQuery groupByCareTzArvRegimenCodeId() Group by the care_tz_arv_regimen_code_id column
 * @method     ChildCareTzArvRegimenCodeQuery groupByCode() Group by the code column
 * @method     ChildCareTzArvRegimenCodeQuery groupByDescription() Group by the description column
 * @method     ChildCareTzArvRegimenCodeQuery groupByParent() Group by the parent column
 * @method     ChildCareTzArvRegimenCodeQuery groupByOther() Group by the other column
 *
 * @method     ChildCareTzArvRegimenCodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCareTzArvRegimenCodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCareTzArvRegimenCodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCareTzArvRegimenCodeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCareTzArvRegimenCodeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCareTzArvRegimenCodeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCareTzArvRegimenCode findOne(ConnectionInterface $con = null) Return the first ChildCareTzArvRegimenCode matching the query
 * @method     ChildCareTzArvRegimenCode findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCareTzArvRegimenCode matching the query, or a new ChildCareTzArvRegimenCode object populated from the query conditions when no match is found
 *
 * @method     ChildCareTzArvRegimenCode findOneByCareTzArvRegimenCodeId(string $care_tz_arv_regimen_code_id) Return the first ChildCareTzArvRegimenCode filtered by the care_tz_arv_regimen_code_id column
 * @method     ChildCareTzArvRegimenCode findOneByCode(string $code) Return the first ChildCareTzArvRegimenCode filtered by the code column
 * @method     ChildCareTzArvRegimenCode findOneByDescription(string $description) Return the first ChildCareTzArvRegimenCode filtered by the description column
 * @method     ChildCareTzArvRegimenCode findOneByParent(int $parent) Return the first ChildCareTzArvRegimenCode filtered by the parent column
 * @method     ChildCareTzArvRegimenCode findOneByOther(boolean $other) Return the first ChildCareTzArvRegimenCode filtered by the other column *

 * @method     ChildCareTzArvRegimenCode requirePk($key, ConnectionInterface $con = null) Return the ChildCareTzArvRegimenCode by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvRegimenCode requireOne(ConnectionInterface $con = null) Return the first ChildCareTzArvRegimenCode matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzArvRegimenCode requireOneByCareTzArvRegimenCodeId(string $care_tz_arv_regimen_code_id) Return the first ChildCareTzArvRegimenCode filtered by the care_tz_arv_regimen_code_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvRegimenCode requireOneByCode(string $code) Return the first ChildCareTzArvRegimenCode filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvRegimenCode requireOneByDescription(string $description) Return the first ChildCareTzArvRegimenCode filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvRegimenCode requireOneByParent(int $parent) Return the first ChildCareTzArvRegimenCode filtered by the parent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCareTzArvRegimenCode requireOneByOther(boolean $other) Return the first ChildCareTzArvRegimenCode filtered by the other column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCareTzArvRegimenCode[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCareTzArvRegimenCode objects based on current ModelCriteria
 * @method     ChildCareTzArvRegimenCode[]|ObjectCollection findByCareTzArvRegimenCodeId(string $care_tz_arv_regimen_code_id) Return ChildCareTzArvRegimenCode objects filtered by the care_tz_arv_regimen_code_id column
 * @method     ChildCareTzArvRegimenCode[]|ObjectCollection findByCode(string $code) Return ChildCareTzArvRegimenCode objects filtered by the code column
 * @method     ChildCareTzArvRegimenCode[]|ObjectCollection findByDescription(string $description) Return ChildCareTzArvRegimenCode objects filtered by the description column
 * @method     ChildCareTzArvRegimenCode[]|ObjectCollection findByParent(int $parent) Return ChildCareTzArvRegimenCode objects filtered by the parent column
 * @method     ChildCareTzArvRegimenCode[]|ObjectCollection findByOther(boolean $other) Return ChildCareTzArvRegimenCode objects filtered by the other column
 * @method     ChildCareTzArvRegimenCode[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CareTzArvRegimenCodeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \CareMd\CareMd\Base\CareTzArvRegimenCodeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\CareMd\\CareMd\\CareTzArvRegimenCode', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCareTzArvRegimenCodeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCareTzArvRegimenCodeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCareTzArvRegimenCodeQuery) {
            return $criteria;
        }
        $query = new ChildCareTzArvRegimenCodeQuery();
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
     * @return ChildCareTzArvRegimenCode|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CareTzArvRegimenCodeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CareTzArvRegimenCodeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCareTzArvRegimenCode A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT care_tz_arv_regimen_code_id, code, description, parent, other FROM care_tz_arv_regimen_code WHERE care_tz_arv_regimen_code_id = :p0';
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
            /** @var ChildCareTzArvRegimenCode $obj */
            $obj = new ChildCareTzArvRegimenCode();
            $obj->hydrate($row);
            CareTzArvRegimenCodeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCareTzArvRegimenCode|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCareTzArvRegimenCodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_CARE_TZ_ARV_REGIMEN_CODE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCareTzArvRegimenCodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_CARE_TZ_ARV_REGIMEN_CODE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the care_tz_arv_regimen_code_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCareTzArvRegimenCodeId(1234); // WHERE care_tz_arv_regimen_code_id = 1234
     * $query->filterByCareTzArvRegimenCodeId(array(12, 34)); // WHERE care_tz_arv_regimen_code_id IN (12, 34)
     * $query->filterByCareTzArvRegimenCodeId(array('min' => 12)); // WHERE care_tz_arv_regimen_code_id > 12
     * </code>
     *
     * @param     mixed $careTzArvRegimenCodeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvRegimenCodeQuery The current query, for fluid interface
     */
    public function filterByCareTzArvRegimenCodeId($careTzArvRegimenCodeId = null, $comparison = null)
    {
        if (is_array($careTzArvRegimenCodeId)) {
            $useMinMax = false;
            if (isset($careTzArvRegimenCodeId['min'])) {
                $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_CARE_TZ_ARV_REGIMEN_CODE_ID, $careTzArvRegimenCodeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($careTzArvRegimenCodeId['max'])) {
                $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_CARE_TZ_ARV_REGIMEN_CODE_ID, $careTzArvRegimenCodeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_CARE_TZ_ARV_REGIMEN_CODE_ID, $careTzArvRegimenCodeId, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvRegimenCodeQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_CODE, $code, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvRegimenCodeQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the parent column
     *
     * Example usage:
     * <code>
     * $query->filterByParent(1234); // WHERE parent = 1234
     * $query->filterByParent(array(12, 34)); // WHERE parent IN (12, 34)
     * $query->filterByParent(array('min' => 12)); // WHERE parent > 12
     * </code>
     *
     * @param     mixed $parent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvRegimenCodeQuery The current query, for fluid interface
     */
    public function filterByParent($parent = null, $comparison = null)
    {
        if (is_array($parent)) {
            $useMinMax = false;
            if (isset($parent['min'])) {
                $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_PARENT, $parent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parent['max'])) {
                $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_PARENT, $parent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_PARENT, $parent, $comparison);
    }

    /**
     * Filter the query on the other column
     *
     * Example usage:
     * <code>
     * $query->filterByOther(true); // WHERE other = true
     * $query->filterByOther('yes'); // WHERE other = true
     * </code>
     *
     * @param     boolean|string $other The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCareTzArvRegimenCodeQuery The current query, for fluid interface
     */
    public function filterByOther($other = null, $comparison = null)
    {
        if (is_string($other)) {
            $other = in_array(strtolower($other), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_OTHER, $other, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCareTzArvRegimenCode $careTzArvRegimenCode Object to remove from the list of results
     *
     * @return $this|ChildCareTzArvRegimenCodeQuery The current query, for fluid interface
     */
    public function prune($careTzArvRegimenCode = null)
    {
        if ($careTzArvRegimenCode) {
            $this->addUsingAlias(CareTzArvRegimenCodeTableMap::COL_CARE_TZ_ARV_REGIMEN_CODE_ID, $careTzArvRegimenCode->getCareTzArvRegimenCodeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the care_tz_arv_regimen_code table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzArvRegimenCodeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CareTzArvRegimenCodeTableMap::clearInstancePool();
            CareTzArvRegimenCodeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzArvRegimenCodeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CareTzArvRegimenCodeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CareTzArvRegimenCodeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CareTzArvRegimenCodeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CareTzArvRegimenCodeQuery
