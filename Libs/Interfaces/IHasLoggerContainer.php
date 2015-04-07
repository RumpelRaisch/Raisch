<?php
namespace Raisch\Libs\Interfaces;

interface IHasLoggerContainer
{
    /**
     * Method to inject a object implementing the ILoggerContainer interface.
     *
     * private $oILoggerContainer = null;
     *
     * public function injectILoggerContainer(ILoggerContainer $oILoggerContainer)
     * {
     *     $this->oILoggerContainer = $oILoggerContainer;
     * }
     * 
     * @access public
     * @param  ILoggerContainer $oILogger
     *         - the logger container object
     * @return void
     */
    public function injectILoggerContainer(ILoggerContainer $oILoggerContainer);

    /**
     * Method to check if the logger object is injected.
     *
     * private $oILoggerContainer = null;
     *
     * public function isInjectedILoggerContainer()
     * {
     *     return null !== $this->oILoggerContainer;
     * }
     * 
     * @access public
     * @return bool
     */
    public function isInjectedILoggerContainer();

    public function getILoggerContainer();
}
