<?php

namespace System\Core\Router;

interface BuilderInterface
{
    /**
     * @param $action
     * @param array ...$arguments
     * @return BuilderInterface
     */
    public function action($action, ...$arguments);

    /**
     * @param $pattern
     * @return BuilderInterface
     */
    public function pattern($pattern);

    /**
     * @param $status
     * @return BuilderInterface
     */
    public function enabled($status);

    /**
     * @param array ...$granted
     * @return BuilderInterface
     */
    public function granted(...$granted);

    /**
     * @param array ...$denied
     * @return BuilderInterface
     */
    public function denied(...$denied);

    /**
     * @param int $index
     * @param int $position
     * @return BuilderInterface
     */
    public function index(int $index = 0, $position = Builder::INDEX_POSITION_APPEND);

    /**
     * @param callable|BuilderInterface $callback
     * @param array ...$arguments
     * @return BuilderInterface
     */
    public function call(callable $callback, ...$arguments);

    /**
     * @param $key
     * @param $value
     * @return BuilderInterface
     */
    public function custom($key, $value);

    /**
     * @return array
     */
    public function get();
}