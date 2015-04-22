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

use \Exception;

/* [use: global interfaces]
============================================================================= */

// use \GlobalInterface;

/**
 * This file is to include the Raisch package
 * and register the autoloader to SPL stack.
 * Also the RsLibsException class is defined here.
 */

/**
 * Exception class for this package.
 *
 * @author    Rainer Schulz <rainer@bitshifting.de>
 * @link      http://bitshifting.de
 * @copyright 2015 - Rainer Schulz
 * @license   CC BY-NC-SA 3.0
 *            - http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package   Raisch
 * @version   1.0.0 02/04/2015 21:45
 */
class RaischException extends Exception {}

// check PHP version to avoid errors in PHP < 5.3.0
if (true === version_compare(PHP_VERSION, '5.3.0', '<')) {
    throw new RaischException('Raisch package expects PHP >= 5.3.0 running.');
} else {
    // add this directory to the include path
    set_include_path(__DIR__ . PATH_SEPARATOR . get_include_path());

    include_once __DIR__ . DIRECTORY_SEPARATOR . 'AutoLoad.php';

    AutoLoad::isRegistered() ?: AutoLoad::register();
}
