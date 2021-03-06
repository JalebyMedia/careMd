<?php

namespace CareMd\CareMd\Base;

use \DateTime;
use \Exception;
use \PDO;
use CareMd\CareMd\CareUsersQuery as ChildCareUsersQuery;
use CareMd\CareMd\Map\CareUsersTableMap;
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
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'care_users' table.
 *
 *
 *
 * @package    propel.generator.CareMd.CareMd.Base
 */
abstract class CareUsers implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\CareMd\\CareMd\\Map\\CareUsersTableMap';


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
     * The value for the name field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $name;

    /**
     * The value for the login_id field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $login_id;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * The value for the personell_nr field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $personell_nr;

    /**
     * The value for the lockflag field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $lockflag;

    /**
     * The value for the role_id field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $role_id;

    /**
     * The value for the exc field.
     *
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $exc;

    /**
     * The value for the s_date field.
     *
     * Note: this column has a database default value of: NULL
     * @var        DateTime
     */
    protected $s_date;

    /**
     * The value for the s_time field.
     *
     * Note: this column has a database default value of: '00:00:00.000000'
     * @var        DateTime
     */
    protected $s_time;

    /**
     * The value for the expire_date field.
     *
     * Note: this column has a database default value of: NULL
     * @var        DateTime
     */
    protected $expire_date;

    /**
     * The value for the expire_time field.
     *
     * Note: this column has a database default value of: '00:00:00.000000'
     * @var        DateTime
     */
    protected $expire_time;

    /**
     * The value for the status field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $status;

    /**
     * The value for the history field.
     *
     * @var        string
     */
    protected $history;

    /**
     * The value for the modify_id field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $modify_id;

    /**
     * The value for the modify_time field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $modify_time;

    /**
     * The value for the create_id field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $create_id;

    /**
     * The value for the create_time field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $create_time;

    /**
     * The value for the theme_name field.
     *
     * @var        string
     */
    protected $theme_name;

    /**
     * The value for the occupation field.
     *
     * @var        string
     */
    protected $occupation;

    /**
     * The value for the tel_no field.
     *
     * @var        string
     */
    protected $tel_no;

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
        $this->name = '';
        $this->login_id = '';
        $this->personell_nr = 0;
        $this->lockflag = 0;
        $this->role_id = 0;
        $this->exc = false;
        $this->s_date = PropelDateTime::newInstance(NULL, null, 'DateTime');
        $this->s_time = PropelDateTime::newInstance('00:00:00.000000', null, 'DateTime');
        $this->expire_date = PropelDateTime::newInstance(NULL, null, 'DateTime');
        $this->expire_time = PropelDateTime::newInstance('00:00:00.000000', null, 'DateTime');
        $this->status = '';
        $this->modify_id = '';
        $this->create_id = '';
    }

    /**
     * Initializes internal state of CareMd\CareMd\Base\CareUsers object.
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
     * Compares this with another <code>CareUsers</code> instance.  If
     * <code>obj</code> is an instance of <code>CareUsers</code>, delegates to
     * <code>equals(CareUsers)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|CareUsers The current object, for fluid interface
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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [login_id] column value.
     *
     * @return string
     */
    public function getLoginId()
    {
        return $this->login_id;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [personell_nr] column value.
     *
     * @return int
     */
    public function getPersonellNr()
    {
        return $this->personell_nr;
    }

    /**
     * Get the [lockflag] column value.
     *
     * @return int
     */
    public function getLockflag()
    {
        return $this->lockflag;
    }

    /**
     * Get the [role_id] column value.
     *
     * @return int
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Get the [exc] column value.
     *
     * @return boolean
     */
    public function getExc()
    {
        return $this->exc;
    }

    /**
     * Get the [exc] column value.
     *
     * @return boolean
     */
    public function isExc()
    {
        return $this->getExc();
    }

    /**
     * Get the [optionally formatted] temporal [s_date] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getSDate($format = NULL)
    {
        if ($format === null) {
            return $this->s_date;
        } else {
            return $this->s_date instanceof \DateTimeInterface ? $this->s_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [s_time] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getSTime($format = NULL)
    {
        if ($format === null) {
            return $this->s_time;
        } else {
            return $this->s_time instanceof \DateTimeInterface ? $this->s_time->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [expire_date] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getExpireDate($format = NULL)
    {
        if ($format === null) {
            return $this->expire_date;
        } else {
            return $this->expire_date instanceof \DateTimeInterface ? $this->expire_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [expire_time] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getExpireTime($format = NULL)
    {
        if ($format === null) {
            return $this->expire_time;
        } else {
            return $this->expire_time instanceof \DateTimeInterface ? $this->expire_time->format($format) : null;
        }
    }

    /**
     * Get the [status] column value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [history] column value.
     *
     * @return string
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Get the [modify_id] column value.
     *
     * @return string
     */
    public function getModifyId()
    {
        return $this->modify_id;
    }

    /**
     * Get the [optionally formatted] temporal [modify_time] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getModifyTime($format = NULL)
    {
        if ($format === null) {
            return $this->modify_time;
        } else {
            return $this->modify_time instanceof \DateTimeInterface ? $this->modify_time->format($format) : null;
        }
    }

    /**
     * Get the [create_id] column value.
     *
     * @return string
     */
    public function getCreateId()
    {
        return $this->create_id;
    }

    /**
     * Get the [optionally formatted] temporal [create_time] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreateTime($format = NULL)
    {
        if ($format === null) {
            return $this->create_time;
        } else {
            return $this->create_time instanceof \DateTimeInterface ? $this->create_time->format($format) : null;
        }
    }

    /**
     * Get the [theme_name] column value.
     *
     * @return string
     */
    public function getThemeName()
    {
        return $this->theme_name;
    }

    /**
     * Get the [occupation] column value.
     *
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Get the [tel_no] column value.
     *
     * @return string
     */
    public function getTelNo()
    {
        return $this->tel_no;
    }

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [login_id] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setLoginId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->login_id !== $v) {
            $this->login_id = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_LOGIN_ID] = true;
        }

        return $this;
    } // setLoginId()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [personell_nr] column.
     *
     * @param int $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setPersonellNr($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->personell_nr !== $v) {
            $this->personell_nr = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_PERSONELL_NR] = true;
        }

        return $this;
    } // setPersonellNr()

    /**
     * Set the value of [lockflag] column.
     *
     * @param int $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setLockflag($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->lockflag !== $v) {
            $this->lockflag = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_LOCKFLAG] = true;
        }

        return $this;
    } // setLockflag()

    /**
     * Set the value of [role_id] column.
     *
     * @param int $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setRoleId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->role_id !== $v) {
            $this->role_id = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_ROLE_ID] = true;
        }

        return $this;
    } // setRoleId()

    /**
     * Sets the value of the [exc] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param  boolean|integer|string $v The new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setExc($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->exc !== $v) {
            $this->exc = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_EXC] = true;
        }

        return $this;
    } // setExc()

    /**
     * Sets the value of [s_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setSDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->s_date !== null || $dt !== null) {
            if ( ($dt != $this->s_date) // normalized values don't match
                || ($dt->format('Y-m-d') === NULL) // or the entered value matches the default
                 ) {
                $this->s_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CareUsersTableMap::COL_S_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setSDate()

    /**
     * Sets the value of [s_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setSTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->s_time !== null || $dt !== null) {
            if ( ($dt != $this->s_time) // normalized values don't match
                || ($dt->format('H:i:s.u') === '00:00:00.000000') // or the entered value matches the default
                 ) {
                $this->s_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CareUsersTableMap::COL_S_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setSTime()

    /**
     * Sets the value of [expire_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setExpireDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->expire_date !== null || $dt !== null) {
            if ( ($dt != $this->expire_date) // normalized values don't match
                || ($dt->format('Y-m-d') === NULL) // or the entered value matches the default
                 ) {
                $this->expire_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CareUsersTableMap::COL_EXPIRE_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setExpireDate()

    /**
     * Sets the value of [expire_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setExpireTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->expire_time !== null || $dt !== null) {
            if ( ($dt != $this->expire_time) // normalized values don't match
                || ($dt->format('H:i:s.u') === '00:00:00.000000') // or the entered value matches the default
                 ) {
                $this->expire_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CareUsersTableMap::COL_EXPIRE_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setExpireTime()

    /**
     * Set the value of [status] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [history] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setHistory($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->history !== $v) {
            $this->history = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_HISTORY] = true;
        }

        return $this;
    } // setHistory()

    /**
     * Set the value of [modify_id] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setModifyId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->modify_id !== $v) {
            $this->modify_id = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_MODIFY_ID] = true;
        }

        return $this;
    } // setModifyId()

    /**
     * Sets the value of [modify_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setModifyTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->modify_time !== null || $dt !== null) {
            if ($this->modify_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->modify_time->format("Y-m-d H:i:s.u")) {
                $this->modify_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CareUsersTableMap::COL_MODIFY_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setModifyTime()

    /**
     * Set the value of [create_id] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setCreateId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->create_id !== $v) {
            $this->create_id = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_CREATE_ID] = true;
        }

        return $this;
    } // setCreateId()

    /**
     * Sets the value of [create_time] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setCreateTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->create_time !== null || $dt !== null) {
            if ($this->create_time === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->create_time->format("Y-m-d H:i:s.u")) {
                $this->create_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CareUsersTableMap::COL_CREATE_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setCreateTime()

    /**
     * Set the value of [theme_name] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setThemeName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->theme_name !== $v) {
            $this->theme_name = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_THEME_NAME] = true;
        }

        return $this;
    } // setThemeName()

    /**
     * Set the value of [occupation] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setOccupation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->occupation !== $v) {
            $this->occupation = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_OCCUPATION] = true;
        }

        return $this;
    } // setOccupation()

    /**
     * Set the value of [tel_no] column.
     *
     * @param string $v new value
     * @return $this|\CareMd\CareMd\CareUsers The current object (for fluent API support)
     */
    public function setTelNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tel_no !== $v) {
            $this->tel_no = $v;
            $this->modifiedColumns[CareUsersTableMap::COL_TEL_NO] = true;
        }

        return $this;
    } // setTelNo()

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
            if ($this->name !== '') {
                return false;
            }

            if ($this->login_id !== '') {
                return false;
            }

            if ($this->personell_nr !== 0) {
                return false;
            }

            if ($this->lockflag !== 0) {
                return false;
            }

            if ($this->role_id !== 0) {
                return false;
            }

            if ($this->exc !== false) {
                return false;
            }

            if ($this->s_date && $this->s_date->format('Y-m-d') !== NULL) {
                return false;
            }

            if ($this->s_time && $this->s_time->format('H:i:s.u') !== '00:00:00.000000') {
                return false;
            }

            if ($this->expire_date && $this->expire_date->format('Y-m-d') !== NULL) {
                return false;
            }

            if ($this->expire_time && $this->expire_time->format('H:i:s.u') !== '00:00:00.000000') {
                return false;
            }

            if ($this->status !== '') {
                return false;
            }

            if ($this->modify_id !== '') {
                return false;
            }

            if ($this->create_id !== '') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CareUsersTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CareUsersTableMap::translateFieldName('LoginId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->login_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CareUsersTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CareUsersTableMap::translateFieldName('PersonellNr', TableMap::TYPE_PHPNAME, $indexType)];
            $this->personell_nr = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CareUsersTableMap::translateFieldName('Lockflag', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lockflag = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CareUsersTableMap::translateFieldName('RoleId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->role_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CareUsersTableMap::translateFieldName('Exc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exc = (null !== $col) ? (boolean) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CareUsersTableMap::translateFieldName('SDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->s_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CareUsersTableMap::translateFieldName('STime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->s_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CareUsersTableMap::translateFieldName('ExpireDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->expire_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CareUsersTableMap::translateFieldName('ExpireTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->expire_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CareUsersTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CareUsersTableMap::translateFieldName('History', TableMap::TYPE_PHPNAME, $indexType)];
            $this->history = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : CareUsersTableMap::translateFieldName('ModifyId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->modify_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : CareUsersTableMap::translateFieldName('ModifyTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->modify_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : CareUsersTableMap::translateFieldName('CreateId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->create_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : CareUsersTableMap::translateFieldName('CreateTime', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->create_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : CareUsersTableMap::translateFieldName('ThemeName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->theme_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : CareUsersTableMap::translateFieldName('Occupation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->occupation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : CareUsersTableMap::translateFieldName('TelNo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tel_no = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 20; // 20 = CareUsersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\CareMd\\CareMd\\CareUsers'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(CareUsersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCareUsersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see CareUsers::setDeleted()
     * @see CareUsers::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CareUsersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCareUsersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CareUsersTableMap::DATABASE_NAME);
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
                CareUsersTableMap::addInstanceToPool($this);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CareUsersTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_LOGIN_ID)) {
            $modifiedColumns[':p' . $index++]  = 'login_id';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_PERSONELL_NR)) {
            $modifiedColumns[':p' . $index++]  = 'personell_nr';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_LOCKFLAG)) {
            $modifiedColumns[':p' . $index++]  = 'lockflag';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_ROLE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'role_id';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_EXC)) {
            $modifiedColumns[':p' . $index++]  = 'exc';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_S_DATE)) {
            $modifiedColumns[':p' . $index++]  = 's_date';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_S_TIME)) {
            $modifiedColumns[':p' . $index++]  = 's_time';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_EXPIRE_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'expire_date';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_EXPIRE_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'expire_time';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_HISTORY)) {
            $modifiedColumns[':p' . $index++]  = 'history';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_MODIFY_ID)) {
            $modifiedColumns[':p' . $index++]  = 'modify_id';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_MODIFY_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'modify_time';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_CREATE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'create_id';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_CREATE_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'create_time';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_THEME_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'theme_name';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_OCCUPATION)) {
            $modifiedColumns[':p' . $index++]  = 'occupation';
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_TEL_NO)) {
            $modifiedColumns[':p' . $index++]  = 'tel_no';
        }

        $sql = sprintf(
            'INSERT INTO care_users (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'login_id':
                        $stmt->bindValue($identifier, $this->login_id, PDO::PARAM_STR);
                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'personell_nr':
                        $stmt->bindValue($identifier, $this->personell_nr, PDO::PARAM_INT);
                        break;
                    case 'lockflag':
                        $stmt->bindValue($identifier, $this->lockflag, PDO::PARAM_INT);
                        break;
                    case 'role_id':
                        $stmt->bindValue($identifier, $this->role_id, PDO::PARAM_INT);
                        break;
                    case 'exc':
                        $stmt->bindValue($identifier, (int) $this->exc, PDO::PARAM_INT);
                        break;
                    case 's_date':
                        $stmt->bindValue($identifier, $this->s_date ? $this->s_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 's_time':
                        $stmt->bindValue($identifier, $this->s_time ? $this->s_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'expire_date':
                        $stmt->bindValue($identifier, $this->expire_date ? $this->expire_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'expire_time':
                        $stmt->bindValue($identifier, $this->expire_time ? $this->expire_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_STR);
                        break;
                    case 'history':
                        $stmt->bindValue($identifier, $this->history, PDO::PARAM_STR);
                        break;
                    case 'modify_id':
                        $stmt->bindValue($identifier, $this->modify_id, PDO::PARAM_STR);
                        break;
                    case 'modify_time':
                        $stmt->bindValue($identifier, $this->modify_time ? $this->modify_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'create_id':
                        $stmt->bindValue($identifier, $this->create_id, PDO::PARAM_STR);
                        break;
                    case 'create_time':
                        $stmt->bindValue($identifier, $this->create_time ? $this->create_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'theme_name':
                        $stmt->bindValue($identifier, $this->theme_name, PDO::PARAM_STR);
                        break;
                    case 'occupation':
                        $stmt->bindValue($identifier, $this->occupation, PDO::PARAM_STR);
                        break;
                    case 'tel_no':
                        $stmt->bindValue($identifier, $this->tel_no, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = CareUsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getName();
                break;
            case 1:
                return $this->getLoginId();
                break;
            case 2:
                return $this->getPassword();
                break;
            case 3:
                return $this->getPersonellNr();
                break;
            case 4:
                return $this->getLockflag();
                break;
            case 5:
                return $this->getRoleId();
                break;
            case 6:
                return $this->getExc();
                break;
            case 7:
                return $this->getSDate();
                break;
            case 8:
                return $this->getSTime();
                break;
            case 9:
                return $this->getExpireDate();
                break;
            case 10:
                return $this->getExpireTime();
                break;
            case 11:
                return $this->getStatus();
                break;
            case 12:
                return $this->getHistory();
                break;
            case 13:
                return $this->getModifyId();
                break;
            case 14:
                return $this->getModifyTime();
                break;
            case 15:
                return $this->getCreateId();
                break;
            case 16:
                return $this->getCreateTime();
                break;
            case 17:
                return $this->getThemeName();
                break;
            case 18:
                return $this->getOccupation();
                break;
            case 19:
                return $this->getTelNo();
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

        if (isset($alreadyDumpedObjects['CareUsers'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['CareUsers'][$this->hashCode()] = true;
        $keys = CareUsersTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getName(),
            $keys[1] => $this->getLoginId(),
            $keys[2] => $this->getPassword(),
            $keys[3] => $this->getPersonellNr(),
            $keys[4] => $this->getLockflag(),
            $keys[5] => $this->getRoleId(),
            $keys[6] => $this->getExc(),
            $keys[7] => $this->getSDate(),
            $keys[8] => $this->getSTime(),
            $keys[9] => $this->getExpireDate(),
            $keys[10] => $this->getExpireTime(),
            $keys[11] => $this->getStatus(),
            $keys[12] => $this->getHistory(),
            $keys[13] => $this->getModifyId(),
            $keys[14] => $this->getModifyTime(),
            $keys[15] => $this->getCreateId(),
            $keys[16] => $this->getCreateTime(),
            $keys[17] => $this->getThemeName(),
            $keys[18] => $this->getOccupation(),
            $keys[19] => $this->getTelNo(),
        );
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('c');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('c');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('c');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('c');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('c');
        }

        if ($result[$keys[16]] instanceof \DateTimeInterface) {
            $result[$keys[16]] = $result[$keys[16]]->format('c');
        }

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
     * @return $this|\CareMd\CareMd\CareUsers
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CareUsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\CareMd\CareMd\CareUsers
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setName($value);
                break;
            case 1:
                $this->setLoginId($value);
                break;
            case 2:
                $this->setPassword($value);
                break;
            case 3:
                $this->setPersonellNr($value);
                break;
            case 4:
                $this->setLockflag($value);
                break;
            case 5:
                $this->setRoleId($value);
                break;
            case 6:
                $this->setExc($value);
                break;
            case 7:
                $this->setSDate($value);
                break;
            case 8:
                $this->setSTime($value);
                break;
            case 9:
                $this->setExpireDate($value);
                break;
            case 10:
                $this->setExpireTime($value);
                break;
            case 11:
                $this->setStatus($value);
                break;
            case 12:
                $this->setHistory($value);
                break;
            case 13:
                $this->setModifyId($value);
                break;
            case 14:
                $this->setModifyTime($value);
                break;
            case 15:
                $this->setCreateId($value);
                break;
            case 16:
                $this->setCreateTime($value);
                break;
            case 17:
                $this->setThemeName($value);
                break;
            case 18:
                $this->setOccupation($value);
                break;
            case 19:
                $this->setTelNo($value);
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
        $keys = CareUsersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setName($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLoginId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPassword($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPersonellNr($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLockflag($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setRoleId($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setExc($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSDate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setSTime($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setExpireDate($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setExpireTime($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setStatus($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setHistory($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setModifyId($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setModifyTime($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setCreateId($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setCreateTime($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setThemeName($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setOccupation($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setTelNo($arr[$keys[19]]);
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
     * @return $this|\CareMd\CareMd\CareUsers The current object, for fluid interface
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
        $criteria = new Criteria(CareUsersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CareUsersTableMap::COL_NAME)) {
            $criteria->add(CareUsersTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_LOGIN_ID)) {
            $criteria->add(CareUsersTableMap::COL_LOGIN_ID, $this->login_id);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_PASSWORD)) {
            $criteria->add(CareUsersTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_PERSONELL_NR)) {
            $criteria->add(CareUsersTableMap::COL_PERSONELL_NR, $this->personell_nr);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_LOCKFLAG)) {
            $criteria->add(CareUsersTableMap::COL_LOCKFLAG, $this->lockflag);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_ROLE_ID)) {
            $criteria->add(CareUsersTableMap::COL_ROLE_ID, $this->role_id);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_EXC)) {
            $criteria->add(CareUsersTableMap::COL_EXC, $this->exc);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_S_DATE)) {
            $criteria->add(CareUsersTableMap::COL_S_DATE, $this->s_date);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_S_TIME)) {
            $criteria->add(CareUsersTableMap::COL_S_TIME, $this->s_time);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_EXPIRE_DATE)) {
            $criteria->add(CareUsersTableMap::COL_EXPIRE_DATE, $this->expire_date);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_EXPIRE_TIME)) {
            $criteria->add(CareUsersTableMap::COL_EXPIRE_TIME, $this->expire_time);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_STATUS)) {
            $criteria->add(CareUsersTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_HISTORY)) {
            $criteria->add(CareUsersTableMap::COL_HISTORY, $this->history);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_MODIFY_ID)) {
            $criteria->add(CareUsersTableMap::COL_MODIFY_ID, $this->modify_id);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_MODIFY_TIME)) {
            $criteria->add(CareUsersTableMap::COL_MODIFY_TIME, $this->modify_time);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_CREATE_ID)) {
            $criteria->add(CareUsersTableMap::COL_CREATE_ID, $this->create_id);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_CREATE_TIME)) {
            $criteria->add(CareUsersTableMap::COL_CREATE_TIME, $this->create_time);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_THEME_NAME)) {
            $criteria->add(CareUsersTableMap::COL_THEME_NAME, $this->theme_name);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_OCCUPATION)) {
            $criteria->add(CareUsersTableMap::COL_OCCUPATION, $this->occupation);
        }
        if ($this->isColumnModified(CareUsersTableMap::COL_TEL_NO)) {
            $criteria->add(CareUsersTableMap::COL_TEL_NO, $this->tel_no);
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
        $criteria = ChildCareUsersQuery::create();
        $criteria->add(CareUsersTableMap::COL_LOGIN_ID, $this->login_id);

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
        $validPk = null !== $this->getLoginId();

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
        return $this->getLoginId();
    }

    /**
     * Generic method to set the primary key (login_id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setLoginId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getLoginId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \CareMd\CareMd\CareUsers (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setLoginId($this->getLoginId());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setPersonellNr($this->getPersonellNr());
        $copyObj->setLockflag($this->getLockflag());
        $copyObj->setRoleId($this->getRoleId());
        $copyObj->setExc($this->getExc());
        $copyObj->setSDate($this->getSDate());
        $copyObj->setSTime($this->getSTime());
        $copyObj->setExpireDate($this->getExpireDate());
        $copyObj->setExpireTime($this->getExpireTime());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setHistory($this->getHistory());
        $copyObj->setModifyId($this->getModifyId());
        $copyObj->setModifyTime($this->getModifyTime());
        $copyObj->setCreateId($this->getCreateId());
        $copyObj->setCreateTime($this->getCreateTime());
        $copyObj->setThemeName($this->getThemeName());
        $copyObj->setOccupation($this->getOccupation());
        $copyObj->setTelNo($this->getTelNo());
        if ($makeNew) {
            $copyObj->setNew(true);
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
     * @return \CareMd\CareMd\CareUsers Clone of current object.
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
        $this->name = null;
        $this->login_id = null;
        $this->password = null;
        $this->personell_nr = null;
        $this->lockflag = null;
        $this->role_id = null;
        $this->exc = null;
        $this->s_date = null;
        $this->s_time = null;
        $this->expire_date = null;
        $this->expire_time = null;
        $this->status = null;
        $this->history = null;
        $this->modify_id = null;
        $this->modify_time = null;
        $this->create_id = null;
        $this->create_time = null;
        $this->theme_name = null;
        $this->occupation = null;
        $this->tel_no = null;
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
        return (string) $this->exportTo(CareUsersTableMap::DEFAULT_STRING_FORMAT);
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
