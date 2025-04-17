<?php

namespace System\Core\Database\Table\Interfaces;

interface AlterTableGetterInterface extends TableGetterInterface
{
    public function getIndexes();
}