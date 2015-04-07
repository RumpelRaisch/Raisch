<?php
/* [namespace]
============================================================================= */

namespace Raisch\Libs\Database;

/* [use: namespace classes]
============================================================================= */

use Raisch\Libs\ResultSet;

/* [use: namespace interfaces]
============================================================================= */

// use Namespace[\Subnamespace]\Interface;

/* [use: global classes]
============================================================================= */

use \Exception;
use \PDOException;
use \PDOStatement;

/* [use: global interfaces]
============================================================================= */

// use \GlobalInterface;

/**
 * In this file the DatabaseStatement class is defined.
 */

/**
 * Statement class for the Database class.
 *
 * @author     Rainer Schulz <rainer@bitshifting.de>
 * @link       http://bitshifting.de
 * @copyright  2013 - Rainer Schulz
 * @license    CC BY-NC-SA 3.0
 *             - http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package    Raisch
 * @subpackage Libs
 * @version    1.0.1 30/08/2013 21:53
 */
class DatabaseStatement extends PDOStatement
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
     * Property to save the Database object.
     *
     * @access private
     * @var    Database default null
     */
    private $oDatabase = null;

    /* [Constructor and Destructor]
    ========================================================================= */

    /**
     * The Constructor.
     *
     * @access protected
     * @param  Database $oDatabase
     *         - the database object
     * @return DatabaseStatement
     *         returns a new object of this class
     */
    protected function __construct(Database $oDatabase)
    {
        $this->oDatabase = $oDatabase;
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
     * Method to get a single line of the fetch result as ResultSet object.
     *
     * @access public
     * @param  int[optional] $iFetchMode
     *         - the fetch mode identifier
     *         - http://www.php.net/manual/en/pdo.constants.php
     *         - http://www.php.net/manual/en/pdostatement.fetch.php
     * @return ResultSet
     *         the result as instance of ResultSet
     * @throws PDOException
     * @throws Exception
     */
    final public function fetchAsResultSet($iFetchMode = null)
    {
        try {
            if (null === $iFetchMode) {
                return new ResultSet($this->fetch()); // default fetch mode
            }

            return new ResultSet($this->fetch($iFetchMode));
        } catch (PDOException $oEx) {
            throw $oEx;
        } catch (Exception $oEx) {
            throw $oEx;
        }
    }

    /**
     * Method to get all lines of the fetch result as ResultSet object.
     *
     * @access public
     * @param  int[optional] $iFetchMode
     *         - the fetch mode identifier
     *         - http://www.php.net/manual/en/pdo.constants.php
     *         - http://www.php.net/manual/en/pdostatement.fetch.php
     * @return ResultSet
     *         the result as instance of ResultSet
     * @throws PDOException
     * @throws Exception
     */
    final public function fetchAllAsResultSet($iFetchMode = null)
    {
        try {
            if (null === $iFetchMode) {
                return new ResultSet($this->fetchAll()); // default fetch mode
            }

            return new ResultSet($this->fetchAll($iFetchMode));
        } catch (PDOException $oEx) {
            throw $oEx;
        } catch (Exception $oEx) {
            throw $oEx;
        }
    }

    /* [Getter and Setter]
    ========================================================================= */

    // none yet

    /* [Dependency Injection - (Setter Injection)]
    ========================================================================= */

    // none yet
}
