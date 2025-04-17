<?php

namespace System\Helpers\Classes\ArrayManager;
use function reflection\countCallbackParams;

/**
 * Class _Array
 * @package System\Helpers\Classes\ArrayManager
 * @method json_encode($options = 0, $depth = 512)
 * @method array_all(callable $callback)
 * @method array_any(callable $callback)
 * @method array_change_key_case($case = CASE_LOWER)
 * @method array_chunk($length, $preserve_keys = false)
 * @method array_column($column_key, $index_key = null)
 * @method array_combine(array $values)
 * @method array_diff(array ...$arrays)
 * @method array_diff_assoc(array ...$arrays)
 * @method array_diff_key(array ...$arrays)
 * @method array_fill($start_index, $count, $value)
 * @method array_fill_keys($keys, $value)
 * @method array_filter(?callable $callback = null, int $mode = 0): array
 * @method array_find(callable $callback): mixed
 * @method array_find_key(callable $callback): mixed
 * @method array_merge(array ...$arrays)
 * @method array_merge_recursive(array ...$arrays)
 * @method array_intersect(array ...$arrays)
 * @method array_intersect_assoc(array ...$arrays)
 * @method array_intersect_key(array ...$arrays)
 * @method array_pad(int $length, mixed $value): array
 * @method array_rand(int $num = 1): int|string|array
 * @method array_reduce(callable $callback, mixed $initial = null): mixed
 * @method array_replace(array ...$replacements): array
 * @method array_replace_recursive(array ...$replacements): array
 * @method array_reverse(bool $preserve_keys = false): array
 * @method array_slice(int $offset, ?int $length = null, bool $preserve_keys = false): array
 * @method array_splice($offset, $length = null, $replacement = array())
 * @method array_unique(int $flags = SORT_STRING): array
 * @method count(int $mode = COUNT_NORMAL): int
 * @method sizeof(int $mode = COUNT_NORMAL): int
 * @method compact(array|string ...$var_names): array
 * @method current(): mixed
 * @method pos(): mixed
 * @method key()
 * @method array_flip()
 * @method array_is_list()
 * @method array_key_first()
 * @method array_key_last()
 * @method array_keys()
 * @method array_values()
 * @method array_pop()
 * @method array_product()
 * @method array_sum()
 * @method array_count_values()
 */
class _Array
{
    protected $subject;

    public function __call($name, $arguments)
    {
        if(function_exists($name)){
            return call_user_func($name, $this->subject, ...$arguments);
        }
        return null;
    }

    public function __construct($subject)
    {
        $this->subject = is_array($subject) ? $subject : array();
    }

    public function raw()
    {
        return $this->subject;
    }

    public function loop(callable $callback)
    {
        $callbackParams = countCallbackParams($callback);

        foreach($this->subject as $index => $value){
            if($callbackParams > 1){
                call_user_func($callback, $index, $value);
            }else{
                call_user_func($callback, $value);
            }
        }
    }

    public function array_key_exists($key)
    {
        return array_key_exists($key, $this->subject);
    }

    public function key_exists($key)
    {
        return key_exists($key, $this->subject);
    }

    public function array_map($callback, array ...$arrays)
    {
        return array_map($callback, $this->subject, ...$arrays);
    }

    public function array_multisort($array1_sort_order = SORT_ASC, $array1_sort_flags = SORT_REGULAR, ...$rest)
    {
        array_multisort($this->subject, $array1_sort_order, $array1_sort_flags, ...$rest);
        return $this->subject;
    }

    public function array_push(...$values)
    {
        array_push($this->subject, $values);
        return $this->subject;
    }

    public function array_shift()
    {
        array_shift($this->subject);
        return $this->subject;
    }

    public function array_unshift(...$values)
    {
        array_unshift($this->subject, $values);
        return $this->subject;
    }

    public function array_walk($callback, $values = null)
    {
        array_walk($this->subject, $callback, $values);
        return $this->subject;
    }

    public function array_walk_recursive($callback, $values = null)
    {
        array_walk_recursive($this->subject, $callback, $values);
        return $this->subject;
    }

    public function arsort($flags = SORT_REGULAR)
    {
        arsort($this->subject, $flags);
        return $this->subject;
    }

    public function asort($flags = SORT_REGULAR)
    {
        asort($this->subject, $flags);
        return $this->subject;
    }

    public function krsort($flags = SORT_REGULAR)
    {
        krsort($this->subject, $flags);
        return $this->subject;
    }

    public function sort($flags = SORT_REGULAR)
    {
        sort($this->subject, $flags);
        return $this->subject;
    }

    public function uasort(callable $callback)
    {
        uasort($this->subject, $callback);
        return $this->subject;
    }

    public function uksort(callable $callback)
    {
        uksort($this->subject, $callback);
        return $this->subject;
    }

    public function usort(callable $callback)
    {
        usort($this->subject, $callback);
        return $this->subject;
    }

    public function ksort($flags = SORT_REGULAR)
    {
        ksort($this->subject, $flags);
        return $this->subject;
    }

    public function rsort($flags = SORT_REGULAR)
    {
        rsort($this->subject, $flags);
        return $this->subject;
    }

    public function shuffle()
    {
        shuffle($this->subject);
        return $this->subject;
    }

    public function end()
    {
        end($this->subject);
        return $this->subject;
    }

    public function prev()
    {
        prev($this->subject);
        return $this->subject;
    }

    public function reset()
    {
        reset($this->subject);
        return $this->subject;
    }

    /**
     * @deprecated
     * @return array
     */
    public function each()
    {
        each($this->subject);
        return $this->subject;
    }

    public function natcasesort()
    {
        natcasesort($this->subject);
        return $this->subject;
    }

    public function natsort()
    {
        natsort($this->subject);
        return $this->subject;
    }

    public function next()
    {
        next($this->subject);
        return $this->subject;
    }

    public function extract($flags = EXTR_OVERWRITE, $prefix = "")
    {
        extract($this->subject, $flags, $prefix);
        return $this->subject;
    }

    public function array_search($needle, $strict = false)
    {
        return array_search($needle, $this->subject, $strict);
    }

    public function in_array($needle, $strict = false)
    {
        return in_array($needle, $this->subject, $strict);
    }
}