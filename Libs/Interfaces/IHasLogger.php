<?php
namespace Raisch\Libs\Interfaces;

interface IHasLogger
{
    /**
     * Method to inject a object implementing the ILogger interface.
     *
     * private $oILogger = null;
     *
     * public function injectILogger(ILogger $oILogger)
     * {
     *     $this->oILogger = $oILogger;
     * }
     * 
     * @access public
     * @param  ILogger $oILogger
     *         - the logger object
     * @return void
     */
    public function injectILogger(ILogger $oILogger);

    /**
     * Method to check if the logger object is injected.
     *
     * private $oILogger = null;
     *
     * public function isInjectedILogger()
     * {
     *     return null !== $this->oILogger;
     * }
     * 
     * @access public
     * @return bool
     */
    public function isInjectedILogger();

    public function getILogger();
}
