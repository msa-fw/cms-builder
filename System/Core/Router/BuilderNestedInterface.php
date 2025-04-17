<?php

namespace System\Core\Router;

interface BuilderNestedInterface
{
    /**
     * @param $uri
     * @return BuilderInterface
     */
    public function suffix($uri);
}