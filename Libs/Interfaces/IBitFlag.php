<?php
namespace Raisch\Libs\Interfaces;

interface IBitFlag
{
    public function setFlag($iFlag = null);

    public function removeFlag($iFlag = null);

    public function issetFlag($iFlag = null);

    public function resetFlags();

    public function getFlags();
}
