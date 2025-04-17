<?php

namespace System\Core\Database\Interfaces;

interface CollateInterface
{
    public function getCharset();
    public function getCollate();
}