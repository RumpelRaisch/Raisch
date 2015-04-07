<?php
/* [namespace]
============================================================================= */

namespace Raisch\Libs\Logger;

/* [use: namespace classes]
============================================================================= */

// use Namespace[\Subnamespace]\Class;

/* [use: namespace interfaces]
============================================================================= */

use Raisch\Libs\Interfaces\ILogger;

/* [use: global classes]
============================================================================= */

use \Exception;

/* [use: global interfaces]
============================================================================= */

// use \GlobalInterface;

/**
 * In this file the Logger class is defined.
 */

/**
 * Logging class.
 *
 * @author     Rainer Schulz <rainer@bitshifting.de>
 * @link       http://bitshifting.de
 * @copyright  2013 - Rainer Schulz
 * @license    CC BY-NC-SA 3.0
 *             - http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package    Raisch
 * @subpackage Libs
 * @version    1.0.1 02/09/2013 13:17
 */
class Logger implements ILogger
{
    /* [class constants]
    ========================================================================= */

    // none yet

    /* [class properties]
    ========================================================================= */

    // none yet

    /* [object properties]
    ========================================================================= */

    protected $sLogFile = null;

    /* [Constructor and Destructor]
    ========================================================================= */

    /**
     * The Constructor.
     *
     * @final
     * @access public
     * @param  string[optional] $sLogFile
     *         - the log file
     * @return Logger
     *         returns a new object of this class
     * @throws Exception
     */
    final public function __construct($sLogFile = null)
    {
        if (null !== $sLogFile) {
            try {
                $this->setLogFile($sLogFile);
            } catch (Exception $oEx) {
                throw $oEx;
            }
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

    final public function issetLogFile()
    {
        return null !== $this->sLogFile;
    }

    final public function log($sToLog, $bAppend = null)
    {
        if (false === $this->issetLogFile()) {
            throw new Exception('No log file given.');
        }

        $iFlags = LOCK_EX | FILE_APPEND;

        if (false === $bAppend) {
            $iFlags &= ~FILE_APPEND;
        }

        file_put_contents($this->sLogFile, $sToLog . PHP_EOL, $iFlags);

        return $this;
    }

    /* [Getter and Setter]
    ========================================================================= */

    final public function setLogFile($sLogFile)
    {
        if (false === is_file($sLogFile)
            AND false === is_writable(dirname($sLogFile) . DIRECTORY_SEPARATOR)
            OR true === is_file($sLogFile)
            AND false === is_writable($sLogFile)
        ) {
            throw new Exception(
                'Unable to write log file in \'' . $sLogFile . '\'.'
            );
        }

        $this->sLogFile = $sLogFile;

        return $this;
    }

    /* [Dependency Injection - (Setter Injection)]
    ========================================================================= */

    // none yet
}
