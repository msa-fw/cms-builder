<?php

namespace math;

function percent($number, $percent, callable $roundFunction = null)
{
    $result = ($number / 100) * $percent;
    return $roundFunction ? $roundFunction($result) : $result;
}