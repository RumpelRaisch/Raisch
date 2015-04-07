<?php
/* [namespace]
============================================================================= */

namespace Raisch\Libs\Logger;

/* [use: namespace classes]
============================================================================= */

// use Namespace[\Subnamespace]\Class;

/* [use: namespace interfaces]
============================================================================= */

use Raisch\Libs\Interfaces\ILoggerContainer;
use Raisch\Libs\Interfaces\ILogger;

/* [use: global classes]
============================================================================= */

// use \GlobalClass;

/* [use: global interfaces]
============================================================================= */

// use \GlobalInterface;

/**
 * In this file the LoggerContainer class is defined.
 */

/**
 * Container class for logger objects.
 *
 * @author     Rainer Schulz <rainer@bitshifting.de>
 * @link       http://bitshifting.de
 * @copyright  2013 - Rainer Schulz
 * @license    CC BY-NC-SA 3.0
 *             - http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package    Raisch
 * @subpackage Libs
 * @version    1.0.0 02/09/2013 13:17
 */
class LoggerContainer implements ILoggerContainer
{
    /* [class constants]
    ========================================================================= */

    // none yet

    /* [class properties]
    ========================================================================= */

    // none yet

    /* [object properties]
    ========================================================================= */

    private $aILogger = array();

    /* [Constructor and Destructor]
    ========================================================================= */

    // none yet

    /* [magical methods]
    ========================================================================= */

    // none yet

    /* [class methods]
    ========================================================================= */

    // none yet

    /* [object methods]
    ========================================================================= */

    public function isInjectedILogger()
    {
        return false === empty($this->aILogger);
    }

    public function log($sToLog, $bAppend = null)
    {
        if (false === $this->isInjectedILogger()) {
            return null;
        }

        for ($i = 0, $c = count($this->aILogger); $i < $c; ++$i) {
            if (true === $this->aILogger[$i]->issetLogFile()) {
                $this->aILogger[$i]->log($sToLog, $bAppend);
            }
        }

        return $this;
    }

    /* [Getter and Setter]
    ========================================================================= */

    public function getILoggers()
    {
        return $this->aILogger;
    }

    /* [Dependency Injection - (Setter Injection)]
    ========================================================================= */

    public function injectAddILogger(ILogger $oILogger)
    {
        $this->aILogger[] = $oILogger;

        return $this;
    }
}
