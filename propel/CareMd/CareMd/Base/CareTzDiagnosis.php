<?php

namespace CareMd\CareMd\Base;

use \Exception;
use \PDO;
use CareMd\CareMd\CareTzDiagnosisQuery as ChildCareTzDiagnosisQuery;
use CareMd\CareMd\Map\CareTzDiagnosisTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'care_tz_diagnosis' table.
 *
 *
 *
 * @package    propel.generator.CareMd.CareMd.Base
 */
abstract class CareTzDiagnosis implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\CareMd\\CareMd\\Map\\CareTzDiagnosisTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the case_nr field.
     *
     * @var        string
     */
    protected $case_nr;

    /**
     * The value for the parent_case_nr field.
     *
     * Note: this column has a database default value of: '-1'
     * @var        string
     */
    protected $parent_case_nr;

    /**
     * The value for the pid field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $pid;

    /**
     * The value for the encounter_nr field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $encounter_nr;

    /**
     * The value for the timestamp field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $timestamp;

    /**
     * The value for the icd_10_code field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $icd_10_code;

    /**
     * The value for the icd_10_description field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $icd_10_description;

    /**
     * The value for the type field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $type;

    /**
     * The value for the comment field.
     *
     * @var        string
     */
    protected $comment;

    /**
     * The value for the doctor_name field.
     *
     * @var        string
     */
    protected $doctor_name;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->parent_case_nr = '-1';
        $this->pid = '0';
        $this->encounter_nr = '0';
        $this->timestamp = '0';
        $this->icd_10_code = '';
        $this->icd_10_description = '';
        $this->type = '';
    }

    /**
     * Initializes internal state of CareMd\CareMd\Base\CareTzDiagnosis object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>CareTzDiagnosis</code> instance.  If
     * <code>obj</code> is an instance of <code>CareTzDiagnosis</code>, delegates to
     * <code>equals(CareTzDiagnosis)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|CareTzDiagnosis The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [case_nr] column value.
     *
     * @return string
     */
    public function getCaseNr()
    {
        return $this->case_nr;
    }

    /**
     * Get the [parent_case_nr] column value.
     *
     * @return string
     */
    public function getParentCaseNr()
    {
        return $this->parent_case_nr;
    }

    /**
     * Get the [pid] column value.
     *
     * @return string
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Get the [encounter_nr] column value.
     *
     * @return string
     */
    public function getEncounterNr()
    {
        return $this->encounter_nr;
    }

    /**
     * Get the [timestamp] column value.
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Get the [icd_10_code] column value.
     *
     * @return string
     */
    public function getIcd10Code()
    {
        return $this->icd_10_code;
    }

    /**
     * Get the [icd_10_description] column value.
     *
     * @return string
     */
    public function getIcd10Description()
    {
        return $this->icd_10_description;
    }

    /**
     * Get the [type] column value.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the [comment] column value.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Get the [doctor_name] column value.
     *
     * @return string
     */
    public function getDoctorName()
    {
        return $this->doctor_name;
    }

    /**
     * Set the value of [case_nr] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object (for fluent API support)
     */
    public function setCaseNr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->case_nr !== $v) {
            $this->case_nr = $v;
            $this->modifiedColumns[CareTzDiagnosisTableMap::COL_CASE_NR] = true;
        }

        return $this;
    } // setCaseNr()

    /**
     * Set the value of [parent_case_nr] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object (for fluent API support)
     */
    public function setParentCaseNr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->parent_case_nr !== $v) {
            $this->parent_case_nr = $v;
            $this->modifiedColumns[CareTzDiagnosisTableMap::COL_PARENT_CASE_NR] = true;
        }

        return $this;
    } // setParentCaseNr()

    /**
     * Set the value of [pid] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object (for fluent API support)
     */
    public function setPid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pid !== $v) {
            $this->pid = $v;
            $this->modifiedColumns[CareTzDiagnosisTableMap::COL_PID] = true;
        }

        return $this;
    } // setPid()

    /**
     * Set the value of [encounter_nr] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object (for fluent API support)
     */
    public function setEncounterNr($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->encounter_nr !== $v) {
            $this->encounter_nr = $v;
            $this->modifiedColumns[CareTzDiagnosisTableMap::COL_ENCOUNTER_NR] = true;
        }

        return $this;
    } // setEncounterNr()

    /**
     * Set the value of [timestamp] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object (for fluent API support)
     */
    public function setTimestamp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->timestamp !== $v) {
            $this->timestamp = $v;
            $this->modifiedColumns[CareTzDiagnosisTableMap::COL_TIMESTAMP] = true;
        }

        return $this;
    } // setTimestamp()

    /**
     * Set the value of [icd_10_code] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object (for fluent API support)
     */
    public function setIcd10Code($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->icd_10_code !== $v) {
            $this->icd_10_code = $v;
            $this->modifiedColumns[CareTzDiagnosisTableMap::COL_ICD_10_CODE] = true;
        }

        return $this;
    } // setIcd10Code()

    /**
     * Set the value of [icd_10_description] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object (for fluent API support)
     */
    public function setIcd10Description($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->icd_10_description !== $v) {
            $this->icd_10_description = $v;
            $this->modifiedColumns[CareTzDiagnosisTableMap::COL_ICD_10_DESCRIPTION] = true;
        }

        return $this;
    } // setIcd10Description()

    /**
     * Set the value of [type] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object (for fluent API support)
     */
    public function setType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->type !== $v) {
            $this->type = $v;
            $this->modifiedColumns[CareTzDiagnosisTableMap::COL_TYPE] = true;
        }

        return $this;
    } // setType()

    /**
     * Set the value of [comment] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object (for fluent API support)
     */
    public function setComment($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comment !== $v) {
            $this->comment = $v;
            $this->modifiedColumns[CareTzDiagnosisTableMap::COL_COMMENT] = true;
        }

        return $this;
    } // setComment()

    /**
     * Set the value of [doctor_name] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object (for fluent API support)
     */
    public function setDoctorName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->doctor_name !== $v) {
            $this->doctor_name = $v;
            $this->modifiedColumns[CareTzDiagnosisTableMap::COL_DOCTOR_NAME] = true;
        }

        return $this;
    } // setDoctorName()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->parent_case_nr !== '-1') {
                return false;
            }

            if ($this->pid !== '0') {
                return false;
            }

            if ($this->encounter_nr !== '0') {
                return false;
            }

            if ($this->timestamp !== '0') {
                return false;
            }

            if ($this->icd_10_code !== '') {
                return false;
            }

            if ($this->icd_10_description !== '') {
                return false;
            }

            if ($this->type !== '') {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CareTzDiagnosisTableMap::translateFieldName('CaseNr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->case_nr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CareTzDiagnosisTableMap::translateFieldName('ParentCaseNr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->parent_case_nr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CareTzDiagnosisTableMap::translateFieldName('Pid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CareTzDiagnosisTableMap::translateFieldName('EncounterNr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->encounter_nr = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CareTzDiagnosisTableMap::translateFieldName('Timestamp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->timestamp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CareTzDiagnosisTableMap::translateFieldName('Icd10Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->icd_10_code = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CareTzDiagnosisTableMap::translateFieldName('Icd10Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->icd_10_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CareTzDiagnosisTableMap::translateFieldName('Type', TableMap::TYPE_PHPNAME, $indexType)];
            $this->type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CareTzDiagnosisTableMap::translateFieldName('Comment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CareTzDiagnosisTableMap::translateFieldName('DoctorName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->doctor_name = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = CareTzDiagnosisTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\CareMd\\CareMd\\CareTzDiagnosis'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CareTzDiagnosisTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCareTzDiagnosisQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see CareTzDiagnosis::setDeleted()
     * @see CareTzDiagnosis::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzDiagnosisTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCareTzDiagnosisQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareTzDiagnosisTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                CareTzDiagnosisTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[CareTzDiagnosisTableMap::COL_CASE_NR] = true;
        if (null !== $this->case_nr) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CareTzDiagnosisTableMap::COL_CASE_NR . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_CASE_NR)) {
            $modifiedColumns[':p' . $index++]  = 'case_nr';
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_PARENT_CASE_NR)) {
            $modifiedColumns[':p' . $index++]  = 'parent_case_nr';
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_PID)) {
            $modifiedColumns[':p' . $index++]  = 'PID';
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_ENCOUNTER_NR)) {
            $modifiedColumns[':p' . $index++]  = 'encounter_nr';
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_TIMESTAMP)) {
            $modifiedColumns[':p' . $index++]  = 'timestamp';
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_ICD_10_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'ICD_10_code';
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_ICD_10_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'ICD_10_description';
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'type';
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_COMMENT)) {
            $modifiedColumns[':p' . $index++]  = 'comment';
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_DOCTOR_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'doctor_name';
        }

        $sql = sprintf(
            'INSERT INTO care_tz_diagnosis (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'case_nr':
                        $stmt->bindValue($identifier, $this->case_nr, PDO::PARAM_INT);
                        break;
                    case 'parent_case_nr':
                        $stmt->bindValue($identifier, $this->parent_case_nr, PDO::PARAM_INT);
                        break;
                    case 'PID':
                        $stmt->bindValue($identifier, $this->pid, PDO::PARAM_INT);
                        break;
                    case 'encounter_nr':
                        $stmt->bindValue($identifier, $this->encounter_nr, PDO::PARAM_INT);
                        break;
                    case 'timestamp':
                        $stmt->bindValue($identifier, $this->timestamp, PDO::PARAM_INT);
                        break;
                    case 'ICD_10_code':
                        $stmt->bindValue($identifier, $this->icd_10_code, PDO::PARAM_STR);
                        break;
                    case 'ICD_10_description':
                        $stmt->bindValue($identifier, $this->icd_10_description, PDO::PARAM_STR);
                        break;
                    case 'type':
                        $stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
                        break;
                    case 'comment':
                        $stmt->bindValue($identifier, $this->comment, PDO::PARAM_STR);
                        break;
                    case 'doctor_name':
                        $stmt->bindValue($identifier, $this->doctor_name, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setCaseNr($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CareTzDiagnosisTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getCaseNr();
                break;
            case 1:
                return $this->getParentCaseNr();
                break;
            case 2:
                return $this->getPid();
                break;
            case 3:
                return $this->getEncounterNr();
                break;
            case 4:
                return $this->getTimestamp();
                break;
            case 5:
                return $this->getIcd10Code();
                break;
            case 6:
                return $this->getIcd10Description();
                break;
            case 7:
                return $this->getType();
                break;
            case 8:
                return $this->getComment();
                break;
            case 9:
                return $this->getDoctorName();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['CareTzDiagnosis'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['CareTzDiagnosis'][$this->hashCode()] = true;
        $keys = CareTzDiagnosisTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCaseNr(),
            $keys[1] => $this->getParentCaseNr(),
            $keys[2] => $this->getPid(),
            $keys[3] => $this->getEncounterNr(),
            $keys[4] => $this->getTimestamp(),
            $keys[5] => $this->getIcd10Code(),
            $keys[6] => $this->getIcd10Description(),
            $keys[7] => $this->getType(),
            $keys[8] => $this->getComment(),
            $keys[9] => $this->getDoctorName(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\CareMd\CareMd\CareTzDiagnosis
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CareTzDiagnosisTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\CareMd\CareMd\CareTzDiagnosis
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCaseNr($value);
                break;
            case 1:
                $this->setParentCaseNr($value);
                break;
            case 2:
                $this->setPid($value);
                break;
            case 3:
                $this->setEncounterNr($value);
                break;
            case 4:
                $this->setTimestamp($value);
                break;
            case 5:
                $this->setIcd10Code($value);
                break;
            case 6:
                $this->setIcd10Description($value);
                break;
            case 7:
                $this->setType($value);
                break;
            case 8:
                $this->setComment($value);
                break;
            case 9:
                $this->setDoctorName($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CareTzDiagnosisTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCaseNr($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setParentCaseNr($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPid($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEncounterNr($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTimestamp($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIcd10Code($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIcd10Description($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setType($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setComment($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDoctorName($arr[$keys[9]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\CareMd\CareMd\CareTzDiagnosis The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CareTzDiagnosisTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_CASE_NR)) {
            $criteria->add(CareTzDiagnosisTableMap::COL_CASE_NR, $this->case_nr);
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_PARENT_CASE_NR)) {
            $criteria->add(CareTzDiagnosisTableMap::COL_PARENT_CASE_NR, $this->parent_case_nr);
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_PID)) {
            $criteria->add(CareTzDiagnosisTableMap::COL_PID, $this->pid);
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_ENCOUNTER_NR)) {
            $criteria->add(CareTzDiagnosisTableMap::COL_ENCOUNTER_NR, $this->encounter_nr);
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_TIMESTAMP)) {
            $criteria->add(CareTzDiagnosisTableMap::COL_TIMESTAMP, $this->timestamp);
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_ICD_10_CODE)) {
            $criteria->add(CareTzDiagnosisTableMap::COL_ICD_10_CODE, $this->icd_10_code);
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_ICD_10_DESCRIPTION)) {
            $criteria->add(CareTzDiagnosisTableMap::COL_ICD_10_DESCRIPTION, $this->icd_10_description);
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_TYPE)) {
            $criteria->add(CareTzDiagnosisTableMap::COL_TYPE, $this->type);
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_COMMENT)) {
            $criteria->add(CareTzDiagnosisTableMap::COL_COMMENT, $this->comment);
        }
        if ($this->isColumnModified(CareTzDiagnosisTableMap::COL_DOCTOR_NAME)) {
            $criteria->add(CareTzDiagnosisTableMap::COL_DOCTOR_NAME, $this->doctor_name);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildCareTzDiagnosisQuery::create();
        $criteria->add(CareTzDiagnosisTableMap::COL_CASE_NR, $this->case_nr);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getCaseNr();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getCaseNr();
    }

    /**
     * Generic method to set the primary key (case_nr column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setCaseNr($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getCaseNr();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \CareMd\CareMd\CareTzDiagnosis (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setParentCaseNr($this->getParentCaseNr());
        $copyObj->setPid($this->getPid());
        $copyObj->setEncounterNr($this->getEncounterNr());
        $copyObj->setTimestamp($this->getTimestamp());
        $copyObj->setIcd10Code($this->getIcd10Code());
        $copyObj->setIcd10Description($this->getIcd10Description());
        $copyObj->setType($this->getType());
        $copyObj->setComment($this->getComment());
        $copyObj->setDoctorName($this->getDoctorName());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCaseNr(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \CareMd\CareMd\CareTzDiagnosis Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->case_nr = null;
        $this->parent_case_nr = null;
        $this->pid = null;
        $this->encounter_nr = null;
        $this->timestamp = null;
        $this->icd_10_code = null;
        $this->icd_10_description = null;
        $this->type = null;
        $this->comment = null;
        $this->doctor_name = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CareTzDiagnosisTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
