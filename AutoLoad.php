<?php
/* [namespace]
============================================================================= */

namespace Raisch;

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
 * In this file the AutoLoad class is defined.
 */

/**
 * Autoloader class for Raisch package.
 *
 * @final
 * @author     Rainer Schulz <rainer@bitshifting.de>
 * @link       http://bitshifting.de
 * @copyright  2015 - Rainer Schulz
 * @license    CC BY-NC-SA 3.0
 *             - http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package    Raisch
 * @subpackage Libs
 * @version    1.0.0 02/04/2015 21:40
 */
final class AutoLoad
{
    /* [class constants]
    ========================================================================= */

    // none yet

    /* [class properties]
    ========================================================================= */

    private static $sBasePath   = null;
    private static $bRegistered = null;

    /* [object properties]
    ========================================================================= */

    // none yet

    /* [Constructor and Destructor]
    ========================================================================= */
 
    // none yet

    /* [magical methods]
    ========================================================================= */

    // none yet

    /* [class methods]
    ========================================================================= */

    public static function register()
    {
        if (false === function_exists('spl_autoload_register')) {
            throw new RaischException(__CLASS__ . ' needs the spl_autoload_register function to work.');
        }

        self::$sBasePath = rtrim(realpath(dirname(__DIR__)), '\/' . DIRECTORY_SEPARATOR);

        if (true === function_exists('__autoload')) {
            spl_autoload_register('__autoload');
        }

        if (true === spl_autoload_register(array(__CLASS__, 'load'), true, true)) {
            self::$bRegistered = true;
        }
    }

    public static function load($sClass)
    {
        $sFile = ltrim($sClass, '\/' . DIRECTORY_SEPARATOR);

        if ('Raisch\\' !== substr($sFile, 0, 7)) {
            return false;
        }

        $sFile = strtr($sFile, '\/' . DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR);
        $sFile = self::$sBasePath . DIRECTORY_SEPARATOR . $sFile . '.php';

        if (true === is_file($sFile)) {
            require_once $sFile;

            return true;
        }

        return false;
    }

    public static function isRegistered()
    {
        return true === self::$bRegistered ? true : false;
    }

    /* [object methods]
    ========================================================================= */

    // none yet

    /* [Getter and Setter]
    ========================================================================= */

    // none yet

    /* [Dependency Injection - (Setter Injection)]
    ========================================================================= */

    // none yet
}
