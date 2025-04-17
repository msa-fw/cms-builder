<?php

namespace System\Core\Form\Validator;

class Filters
{
    protected $fieldName;

    protected $field = array();

    public function __construct($fieldName, &$field)
    {
        $this->fieldName = $fieldName;
        $this->field = &$field;
    }

    public function bool($flags = FILTER_NULL_ON_FAILURE)
    {
        $this->field['filters']['bool'] = array(
            FILTER_VALIDATE_BOOLEAN => $flags
        );
        return $this;
    }

    public function domain($flags = FILTER_FLAG_HOSTNAME)
    {
        $this->field['filters']['domain'] = array(
            FILTER_VALIDATE_DOMAIN => $flags
        );
        return $this;
    }

    public function email($flags = FILTER_FLAG_EMAIL_UNICODE)
    {
        $this->field['filters']['email'] = array(
            FILTER_VALIDATE_EMAIL => $flags
        );
        return $this;
    }

    public function float($flags = FILTER_FLAG_ALLOW_THOUSAND)
    {
        $this->field['filters']['float'] = array(
            FILTER_VALIDATE_FLOAT => $flags
        );
        return $this;
    }

    public function int($flags = FILTER_FLAG_ALLOW_OCTAL|FILTER_FLAG_ALLOW_HEX)
    {
        $this->field['filters']['int'] = array(
            FILTER_VALIDATE_INT => $flags
        );
        return $this;
    }

    public function ip($flags = FILTER_FLAG_IPV4|FILTER_FLAG_IPV6|FILTER_FLAG_NO_PRIV_RANGE|FILTER_FLAG_NO_RES_RANGE)
    {
        $this->field['filters']['ip'] = array(
            FILTER_VALIDATE_IP => $flags
        );
        return $this;
    }

    public function mac($flags = FILTER_NULL_ON_FAILURE)
    {
        $this->field['filters']['mac'] = array(
            FILTER_VALIDATE_MAC => $flags
        );
        return $this;
    }

    public function url($flags = FILTER_FLAG_PATH_REQUIRED|FILTER_FLAG_QUERY_REQUIRED|FILTER_NULL_ON_FAILURE)
    {
        $this->field['filters']['url'] = array(
            FILTER_VALIDATE_URL => $flags
        );
        return $this;
    }
}