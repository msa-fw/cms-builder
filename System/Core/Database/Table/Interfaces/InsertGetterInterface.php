<?php

namespace System\Core\Database\Table\Interfaces;

interface InsertGetterInterface
{
    public function getDatabase();
    public function getTable();
    public function getInsert();
    public function getUpdate();
}