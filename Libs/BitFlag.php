<?php
/* [namespace]
============================================================================= */

namespace Raisch\Libs;

/* [use: namespace classes]
============================================================================= */

use Raisch\RaischException;

/* [use: namespace interfaces]
============================================================================= */

use Raisch\Libs\Interfaces\IBitFlag;

/* [use: global classes]
============================================================================= */

// use \GlobalClass;

/* [use: global interfaces]
============================================================================= */

// use \GlobalInterface;

/**
 * In this file the BitFlag class is defined.
 */
 
/**
 * Class to set and check flags.
 *
 * @author     Rainer Schulz <rainer@bitshifting.de>
 * @link       http://bitshifting.de
 * @copyright  2015 - Rainer Schulz
 * @license    CC BY-NC-SA 3.0
 *             - http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package    Raisch
 * @subpackage Libs
 * @version    1.1.0 02/04/2015 21:56
 */
class BitFlag implements IBitFlag
{
    /* [class constants]
    ========================================================================= */

    const ERROR_PARAM_NOT_INT = 'Method \'%s\' expects parameter %d to be integer.';

    const FLAGS_NONE = 0;

    /* [class properties]
    ========================================================================= */

    // none yet

    /* [object properties]
    ========================================================================= */
 
    private $iBitFlags = self::FLAGS_NONE;

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
 
    final public function setFlag($iFlag = null)
    {
        if (false === is_int($iFlag)) {
            throw new RaischException(sprintf(
                self::ERROR_PARAM_NOT_INT,
                __METHOD__,
                1
            ));
        }
 
        $this->iBitFlags |= $iFlag;
    }

    final public function removeFlag($iFlag = null)
    {
        if (false === is_int($iFlag)) {
            throw new RaischException(sprintf(
                self::ERROR_PARAM_NOT_INT,
                __METHOD__,
                1
            ));
        }

        $this->iBitFlags &= ~$iFlag;
    }
 
    final public function issetFlag($iFlag = null)
    {
        if (false === is_int($iFlag)) {
            throw new RaischException(sprintf(
                self::ERROR_PARAM_NOT_INT,
                __METHOD__,
                1
            ));
        }
 
        return ($iFlag === ($this->iBitFlags & $iFlag));
    }
 
    final public function resetFlags()
    {
        $this->iBitFlags = self::FLAGS_NONE;
    }
 
    /* [Getter and Setter]
    ========================================================================= */
 
    final public function getFlags()
    {
        return $this->iBitFlags;
    }

    /* [Dependency Injection - (Setter Injection)]
    ========================================================================= */

    // none yet
}
