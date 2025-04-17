<?php

namespace System\Core\Database\Table\Interfaces;

interface UpdateGetterInterface extends ExpressionGetterInterface
{
    public function getValues();
}