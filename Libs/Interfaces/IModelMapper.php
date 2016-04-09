<?php
namespace Raisch\Libs\Interfaces;

interface IModelMapper
{
    public function insert(IModel $oModel);
    public function update(IModel $oModel);
    public function delete($iId);
    public function exists($iId);
    public function fetch($iId);
    public function fetchAll();
}
