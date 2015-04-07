<?php
/* [namespace]
============================================================================= */

namespace Raisch\Libs;

/* [use: namespace classes]
============================================================================= */

// use Namespace[\Subnamespace]\Class;

/* [use: namespace interfaces]
============================================================================= */

// use Namespace[\Subnamespace]\Interface;

/* [use: global classes]
============================================================================= */

// use \GlobalClass;

/* [use: global interfaces]
============================================================================= */

use \Countable;
use \Iterator;

/**
 * In this file the ResultSet class is defined.
 */

/**
 * Resultset class.
 *
 * @author     Rainer Schulz <rainer@bitshifting.de>
 * @link       http://bitshifting.de
 * @copyright  2013 - Rainer Schulz
 * @license    CC BY-NC-SA 3.0
 *             - http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package    Raisch
 * @subpackage Libs
 * @version    1.0.0 13/08/2013 10:11
 */
class ResultSet implements Countable, Iterator
{
    /* [class constants]
    ========================================================================= */

    // none yet

    /* [class properties]
    ========================================================================= */

    // none yet

    /* [object properties]
    ========================================================================= */

    /**
     * Var to save the counter.
     *
     * @see    Countable
     * @link   http://php.net/manual/en/class.countable.php
     *
     * @access protected
     * @var    int       default 0
     */
    protected $iCount = 0;

    /**
     * Var to save the current position for the iteration.
     *
     * @see    Iterator
     * @link   http://php.net/manual/en/class.iterator.php
     *
     * @access protected
     * @var    int       default 0
     */
    protected $iPosition = 0;

    /**
     * Array for the keys to itarate over.
     *
     * @see    Iterator
     * @link   http://php.net/manual/en/class.iterator.php
     *
     * @access protected
     * @var    array     default array()
     */
    protected $aDataKeys = array();

    /**
     * Array for the data to itarate over.
     *
     * @see    Iterator
     * @link   http://php.net/manual/en/class.iterator.php
     *
     * @access protected
     * @var    array     default array()
     */
    protected $aData = array();

    /* [Constructor and Destructor]
    ========================================================================= */

    /**
     * The Constructor.
     *
     * @access public
     * @param  mixed|array $mData
     *                     - the data ... hopefully an array
     * @return object      ResultSet
     *                     returns a new object of this class
     */
    public function __construct($mData = null)
    {
        if (true === is_array($mData)
            AND false === empty($mData)
        ) {
            $this->aData     = $mData;
            $this->aDataKeys = array_keys($this->aData);
            $this->iCount    = count($this->aDataKeys);
        }
    }

    /* [magical methods]
    ========================================================================= */

    // none yet

    /* [class methods]
    ========================================================================= */

    // none yet

    /* [object methods]
    ========================================================================= */

    /**
     * Method to check if object is empty or not.
     *
     * @final
     * @access public
     * @return bool
     */
    final public function isEmpty()
    {
        return !((bool) $this->iCount);
    }

    /**
     * Method to get the counter.
     *
     * Usage:
     * ======
     * $oResultSet->count();
     * or
     * count($oResultSet);
     *
     * @see    Countable::count()
     * @link   http://php.net/manual/en/class.countable.php
     *
     * @final
     * @access public
     * @return int
     */
    final public function count()
    {
        return $this->iCount;
    }

    /**
     * Method to get the current dataset.
     *
     * @see    Iterator::current()
     * @link   http://php.net/manual/en/class.iterator.php
     *
     * @final
     * @access public
     * @return array  the current dataset
     */
    final public function current()
    {
        return $this->aData[$this->aDataKeys[$this->iPosition]];
    }

    /**
     * Method to get the current key for the iteration.
     *
     * @see    Iterator::key()
     * @link   http://php.net/manual/en/class.iterator.php
     *
     * @final
     * @access public
     * @return mixed  the current key
     */
    final public function key()
    {
        return $this->aDataKeys[$this->iPosition];
    }

    /**
     * Method to set the position to the next element in the iteration.
     *
     * @see    Iterator::next()
     * @link   http://php.net/manual/en/class.iterator.php
     *
     * @final
     * @access public
     * @return void
     */
    final public function next()
    {
        $this->iPosition += 1;
    }

    /**
     * Method the reset the iteration position to 0.
     *
     * @see    Iterator::rewind()
     * @link   http://php.net/manual/en/class.iterator.php
     *
     * @final
     * @access public
     * @return void
     */
    final public function rewind()
    {
        $this->iPosition = 0;
    }

    /**
     * Method checks if the current position is a valid element.
     *
     * @see    Iterator::valid()
     * @link   http://php.net/manual/en/class.iterator.php
     *
     * @final
     * @access public
     * @return bool
     */
    final public function valid()
    {
        return array_key_exists($this->iPosition, $this->aDataKeys);
    }

    /* [Getter and Setter]
    ========================================================================= */

    /**
     * Method to get the data keys.
     *
     * @final
     * @access public
     * @return array
     */
    final public function getKeys()
    {
        return $this->aDataKeys;
    }

    /**
     * Method to get the data keys as JSON string.
     *
     * @final
     * @access public
     * @return string
     */
    final public function getJsonEncodedKeys()
    {
        return json_encode($this->aDataKeys);
    }

    /**
     * Method to get the data.
     *
     * @final
     * @access public
     * @return array
     */
    final public function getData()
    {
        return $this->aData;
    }

    /**
     * Method to get the data as JSON string.
     *
     * @final
     * @access public
     * @return string
     */
    final public function getJsonEncodedData()
    {
        return json_encode($this->aData);
    }

    /* [Dependency Injection - (Setter Injection)]
    ========================================================================= */

    // none yet
}
