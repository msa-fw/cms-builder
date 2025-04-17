<?php

namespace System\Core\Database\Table\Interfaces;

interface ExpressionGetterInterface
{
    public function getDatabase();
    public function getTable();
    public function getLimit();
    public function getOffset();
    public function getFields();
    public function getWhere();
    public function getJoin();
    public function getOrder();
    public function getGroup();
    public function getHeaving();
}