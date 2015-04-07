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

// use \GlobalInterface;

/**
 * In this file the Debug class is defined.
 */

/**
 * Debugging class.
 *
 * @author     Rainer Schulz <rainer@bitshifting.de>
 * @link       http://bitshifting.de
 * @copyright  2015 - Rainer Schulz
 * @license    CC BY-NC-SA 3.0
 *             - http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package    Raisch
 * @subpackage Libs
 * @version    1.0.0 02/04/2015 21:48
 */
class Debug
{
    /* [class constants]
    ========================================================================= */

    // none yet

    /* [class properties]
    ========================================================================= */

    private static $oInstance = null;

    /* [object properties]
    ========================================================================= */

    // none yet

    /* [Constructor and Destructor]
    ========================================================================= */

    /**
     * The Constructor.
     *
     * @access private
     * @return object Debug
     *                returns a new object of this class
     */
    private function __construct() {}

    /* [magical methods]
    ========================================================================= */

    // none yet

    /* [class methods]
    ========================================================================= */

    public static function getInstance()
    {
        if (null === self::$oInstance) {
            self::$oInstance = new self();
        }

        return self::$oInstance;
    }

    /* [object methods]
    ========================================================================= */

    public function echoPrintRInPre()
    {
        $aArgs = func_get_args();

        foreach ($aArgs as $mArg) {
            echo $this->setInPre($this->getPrintR($mArg));
        }

        unset($aArgs);
    }

    public function echoPrintRInPreWithExit()
    {
        call_user_func_array(
            array($this, 'echoPrintRInPre'),
            func_get_args()
        );

        exit;
    }

    public function echoVarDumpInPre()
    {
        $aArgs = func_get_args();

        foreach ($aArgs as $mArg)
        {
            echo $this->setInPre($this->getVarDump($mArg));
        }

        unset($aArgs);
    }

    public function echoVarDumpInPreWithExit()
    {
        call_user_func_array(
            array($this, 'echoVarDumpInPre'),
            func_get_args()
        );

        exit;
    }

    public function echoInPre()
    {
        $aArgs = func_get_args();

        foreach ($aArgs as $mArg) {
            echo $this->setInPre($mArg);
        }

        unset($aArgs);
    }

    public function setInPre($mValue)
    {
        return '<pre>' . htmlspecialchars($mValue, ENT_QUOTES) . '</pre>' . PHP_EOL;
    }

    public function getPrintR($mArg)
    {
        return print_r($mArg, true);
    }

    public function getPrintRInPre($mArg)
    {
        return $this->setInPre($this->getPrintR($mArg));
    }

    public function getVarDump($mArg)
    {
        $sQuotedEol = preg_quote(PHP_EOL);

        ob_start();

        var_dump($mArg);

        return preg_replace('#\]=\>' . $sQuotedEol . ' +#', '] => ', ob_get_clean());
    }

    public function getVarDumpInPre($mArg)
    {
        return $this->setInPre($this->getVarDump($mArg));
    }

    /* [Getter and Setter]
    ========================================================================= */

    // none yet

    /* [Dependency Injection - (Setter Injection)]
    ========================================================================= */

    // none yet
}
