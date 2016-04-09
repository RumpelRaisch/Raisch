<?php
namespace Raisch\Libs\Interfaces;

interface IModel
{
    public function setData(array $aData);
    public function getModelMapper();
    public function injectModelMapper(IModelMapper $oModelMapper);
}
