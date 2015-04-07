<?php
namespace Raisch\Libs\Interfaces;

interface IHasBitFlag
{
    public function injectIBitFlag(IBitFlag $oIBitFlag);

    public function isInjectedIBitFlag();

    public function getIBitFlag();
}
