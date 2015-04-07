<?php
/* [namespace]
============================================================================= */

namespace Raisch\Libs\Database;

/* [use: namespace classes]
============================================================================= */

// use Namespace[\Subnamespace]\Class;

/* [use: namespace interfaces]
============================================================================= */

use Raisch\Libs\Interfaces\IHasBitFlag;
use Raisch\Libs\Interfaces\IHasLoggerContainer;
use Raisch\Libs\Interfaces\IBitFlag;
use Raisch\Libs\Interfaces\ILoggerContainer;

/* [use: global classes]
============================================================================= */

use \Exception;
use \PDO;
use \PDOException;

/* [use: global interfaces]
============================================================================= */

// use \GlobalInterface;

/**
 * In this file the Database class is defined.
 */

/**
 * Database connection and communication class.
 *
 * @author     Rainer Schulz <rainer@bitshifting.de>
 * @link       http://bitshifting.de
 * @copyright  2015 - Rainer Schulz
 * @license    CC BY-NC-SA 3.0
 *             - http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package    Raisch
 * @subpackage Libs
 * @version    1.3.0 04/04/2015 18:09
 */
class Database extends PDO implements IHasBitFlag, IHasLoggerContainer
{
    /* [class constants]
    ========================================================================= */

    const STR_LOG_DATE_FORMAT = 'Y-m-d H:m:iO';

    const FLAG_LOG_STMTS = 1;

    /* [class properties]
    ========================================================================= */

    /**
     * Property to save registered instances of this class.
     *
     * @access private
     * @var    array   array with instances of this class, default array()
     */
    private static $aInstances = array();

    /* [object properties]
    ========================================================================= */

    /**
     * Insctancename property.
     *
     * @access private
     * @var    string  default null
     */
    private $sInstanceName = null;

    /**
     * Property to hold a ILoggerContainer objects.
     *
     * @access private
     * @var    ILoggerContainer default null
     */
    private $oILoggerContainer = null;

    /**
     * Property to hold a IBitFlag object.
     *
     * @access private
     * @var    IBitFlag default null
     */
    private $oIBitFlag = null;

    /* [Constructor and Destructor]
    ========================================================================= */

    /**
     * The Constructor loads the PDO.
     *
     * @access public
     * @param  string $sDsn
     *         - the Data Source Name, or DSN, contains the
     *           information required to connect to the database
     * @param  string $sUser
     *         - the user name for the DSN string
     * @param  string $sPass
     *         - the password for the DSN string
     * @param  array[optional] $aOptions
     *         - a key => value array of driver-specific
     *           connection options
     * @return Database
     *         returns a new object of this class
     * @throws PDOException
     * @throws Exception
     */
    public function __construct($sDsn, $sUser, $sPass, $aOptions = array())
    {
        if (false === empty($aOptions)
            AND true === is_array($aOptions)
        ) {
            $aOptions += $this->getDefaultConnectionOptions();
        } else {
            $aOptions = $this->getDefaultConnectionOptions();
        }

        try {
            parent::__construct($sDsn, $sUser, $sPass, $aOptions);
        } catch (PDOException $oEx) {
            throw $oEx;
        } catch (Exception $oEx) {
            throw $oEx;
        }
    }

    /* [magical methods]
    ========================================================================= */

    // none yet

    /* [class methods]
    ========================================================================= */

    /**
     * Method to get an instance of this class by name.
     *
     * @static
     * @access    public
     * @staticvar array Database::$aInstances
     * @param     string $sInstanceName
     *            - the name of the instance
     * @return    bool|Database
     *            the named instance
     */
    public static function getNamedInstance($sInstanceName)
    {
        if (true === isset(self::$aInstances[$sInstanceName])) {
            return self::$aInstances[$sInstanceName];
        }

        return false;
    }

    /* [object methods]
    ========================================================================= */

    public function query()
    {
        $aArgs = func_get_args();

        if (true === isset($aArgs[0])) {
            $this->logStatement(__METHOD__, $aArgs[0]);
        }

        return call_user_func_array(array('parent', 'query'), $aArgs);
    }

    public function prepare($sStmt, $aDriverOptions = array())
    {
        $this->logStatement(__METHOD__, $sStmt);

        return parent::prepare($sStmt, $aDriverOptions);
    }

    public function exec($sStmt)
    {
        $this->logStatement(__METHOD__, $sStmt);

        return parent::exec($sStmt);
    }

    private function logStatement($sMethod, $sStmt)
    {
        if (true === $this->isInjectedIBitFlag()
            AND true === $this->oIBitFlag->issetFlag(self::FLAG_LOG_STMTS)
        ) {
            $this->logILoggerContainer(
                '[' . date(self::STR_LOG_DATE_FORMAT) . '] ' . $sMethod
                . '() given statement: ' . PHP_EOL . $sStmt . PHP_EOL
            );
        }
    }

    /**
     * Method to set PHP data object connection options.
     *
     * @access private
     * @return array
     *         returns an array with default connection options
     */
    private function getDefaultConnectionOptions()
    {
        return array(
            // make connection persistent to reuse on reload? no ...
            self::ATTR_PERSISTENT => false,

            // set own class for statements
            self::ATTR_STATEMENT_CLASS => array(
                __NAMESPACE__ . '\DatabaseStatement',
                array($this)
            ),

            // throw exception on error
            self::ATTR_ERRMODE => self::ERRMODE_EXCEPTION,

            // set default fetch mode
            self::ATTR_DEFAULT_FETCH_MODE => self::FETCH_ASSOC
        );
    }

    /**
     * Method to register the instance (with name) to the class.
     *
     * @access    public
     * @staticvar array  Database::$aInstances
     * @param     string $sInstanceName
     *            - the name for the instance
     * @return    bool
     */
    public function register($sInstanceName)
    {
        if (null === $this->sInstanceName) {
            self::$aInstances[$sInstanceName] = $this;

            $this->sInstanceName = $sInstanceName;

            return true;
        }

        return false;
    }

    /**
     * Method to unregister the instance from the class.
     *
     * @access    public
     * @staticvar array  Database::$aInstances
     * @return    bool
     */
    public function unregister()
    {
        if (null !== $this->sInstanceName) {
            self::$aInstances[$this->sInstanceName] = null;

            $this->sInstanceName = null;

            return true;
        }

        return false;
    }

    public function logILoggerContainer($sToLog)
    {
        if (false === $this->isInjectedILoggerContainer()) {
            return null;
        }
    
        return $this->oILoggerContainer->log($sToLog);
    }

    /**
     * Method to check if at least one logger object is injected.
     *
     * @access public
     * @return bool
     */
    public function isInjectedILoggerContainer()
    {
        return null !== $this->oILoggerContainer;
    }

    /**
     * Method to check if the bit flag object is injected.
     *
     * @access public
     * @return bool
     */
    public function isInjectedIBitFlag()
    {
        return null !== $this->oIBitFlag;
    }

    /* [Getter and Setter]
    ========================================================================= */

    public function getIBitFlag()
    {
        if (true === $this->isInjectedIBitFlag()) {
            return $this->oIBitFlag;
        }

        return null;
    }

    public function getILoggerContainer()
    {
        if (true === $this->isInjectedILoggerContainer()) {
            return $this->oILoggerContainer;
        }

        return null;
    }

    /* [Dependency Injection - (Setter Injection)]
    ========================================================================= */

    /**
     * Method to inject an object implementing the ILoggerContainer interface.
     *
     * @inject
     * @access public
     * @param  ILoggerContainer $oILoggerContainer
     *         - the logger container object
     * @return ILoggerContainer
     */
    public function injectILoggerContainer(ILoggerContainer $oILoggerContainer)
    {
        return $this->oILoggerContainer = $oILoggerContainer;
    }

    /**
     * Method to inject a object implementing the IBitFlag interface.
     *
     * @inject
     * @access public
     * @param  IBitFlag $oILogger
     *         - the bit flag object
     * @return IBitFlag
     */
    public function injectIBitFlag(IBitFlag $oIBitFlag)
    {
        return $this->oIBitFlag = $oIBitFlag;
    }
}
