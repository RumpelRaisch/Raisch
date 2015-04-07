<?php
namespace Raisch\Libs\Interfaces;

interface ILogger
{
    public function setLogFile($sLogFile);

    public function issetLogFile();

    public function log($sToLog);
}
