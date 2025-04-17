<?php

namespace System\Core\Database\Table\Interfaces;

interface TableGetterInterface
{
    public function getDatabase();
    public function getTable();
    public function getColumns();
    public function getCharset();
    public function getCollate();
    public function getDirectory();
    public function getAttributes();
}