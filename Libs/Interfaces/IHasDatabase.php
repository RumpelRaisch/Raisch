<?php
namespace Raisch\Libs\Interfaces;

use  Raisch\Libs\Database\Database;

interface IHasDatabase
{
    public function injectDatabase(Database $oDatabase);
    public function isInjectedDatabase();
    public function getDatabase();
}
