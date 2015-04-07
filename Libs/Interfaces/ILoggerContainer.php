<?php
namespace Raisch\Libs\Interfaces;

interface ILoggerContainer
{
    /**
     * Method to inject/add a object implementing the ILogger interface.
     *
     * private $aILogger = array();
     *
     * public function injectAddILogger(ILogger $oILogger)
     * {
     *     $this->aILogger[] = $oILogger;
     * }
     * 
     * @access public
     * @param  ILogger $oILogger
     *         - the logger object
     * @return void
     */
    public function injectAddILogger(ILogger $oILogger);

    /**
     * Method to check if at least one logger object is injected.
     *
     * private $aILogger = array();
     *
     * public function isInjectedILogger()
     * {
     *     return false === empty($this->aILogger);
     * }
     * 
     * @access public
     * @return bool
     */
    public function isInjectedILogger();

    /**
     * Method to log in multiple logger objects.
     *
     * private $aILogger = array();
     *
     * public function log($sToLog)
     * {
     *     if (false === $this->isInjectedILogger())
     *     {
     *         return;
     *     }
     *
     *     for ($i = 0, $c = count($this->aILogger); $i < $c; ++$i)
     *     {
     *         if (true === $this->aILogger[$i]->issetLogFile())
     *         {
     *             $this->aILogger[$i]->log($sToLog);
     *         }
     *     }
     * }
     * 
     * @access public
     * @return void
     */
    public function log($sToLog);

    public function getILoggers();
}
