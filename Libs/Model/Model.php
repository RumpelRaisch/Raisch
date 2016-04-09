<?php
/* [namespace]
============================================================================= */

namespace Raisch\Libs\Model;

/* [use: namespace classes]
============================================================================= */

// use Namespace[\Subnamespace]\Class;

/* [use: namespace interfaces]
============================================================================= */

use Raisch\Libs\Interfaces\IModel;
use Raisch\Libs\Interfaces\IModelMapper;

/* [use: global classes]
============================================================================= */

// use \GlobalClass;

/* [use: global interfaces]
============================================================================= */

// use \GlobalInterface;

/**
 * In this file the Model class is defined.
 */

/**
 * Short class description ...
 *
 * @author     Rainer Schulz <rainer@bitshifting.de>
 * @link       http://bitshifting.de
 * @copyright  2016 - Rainer Schulz
 * @license    CC BY-NC-SA 3.0
 *             - http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @package    Raisch
 * @subpackage Libs
 * @version    1.0.0 09/04/2016 17:43
 */
class Model implements IModel
{
    /* [class constants]
    ========================================================================= */

    // none yet

    /* [class properties]
    ========================================================================= */

    protected $oModelMapper = null;

    /* [object properties]
    ========================================================================= */

    // none yet

    /* [Constructor and Destructor]
    ========================================================================= */

    /**
     * The Constructor.
     *
     * @access public
     * @return object Model
     *                returns a new object of this class
     */
    public function __construct(array $aData = null)
    {
        if (null !== $aData) {
            $this->setData($aData);
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

    public function setData(array $aData) // must be assoc
    {
        $aKeys = explode(
            ' ',
            implode(
                '',
                array_map(
                    'ucfirst',
                    explode(
                        '_',
                        implode(
                            ' _',
                            array_keys($aData)
                        )
                    )
                )
            )
        );

        $aData = array_combine($aKeys, $aData);

        foreach ($aData as $sKey => $mValue) {
            $this->{'set' . $sKey}($mValue);
        }

        return $this;
    }

    /* [Getter and Setter]
    ========================================================================= */

    public function getModelMapper()
    {
        return $this->oModelMapper;
    }

    /* [Dependency Injection - (Setter Injection)]
    ========================================================================= */

    final public function injectModelMapper(IModelMapper $oModelMapper)
    {
        $this->oModelMapper = $oModelMapper;

        return $this;
    }
}
