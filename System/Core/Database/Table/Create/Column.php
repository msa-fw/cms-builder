<?php

namespace System\Core\Database\Table\Create;

/**
 * Class Column
 * @package System\Core\Database\Table\Create
 * @method Attributes int($length)
 * @method Attributes varchar($length)
 * @method Attributes text()
 * @method Attributes date()
 * @method Attributes tinyint($length)
 * @method Attributes smallint($length)
 * @method Attributes mediumint($length)
 * @method Attributes bigint($length)
 * @method Attributes decimal($length = 0)
 * @method Attributes float($length = 0)
 * @method Attributes double($length = 0)
 * @method Attributes real($length = 0)
 * @method Attributes bit($length = 0)
 * @method Attributes boolean($length = 0)
 * @method Attributes serial($length = 0)
 * @method Attributes datetime()
 * @method Attributes timestamp()
 * @method Attributes time()
 * @method Attributes year()
 * @method Attributes char($length = 0)
 * @method Attributes tinytext()
 * @method Attributes mediumtext()
 * @method Attributes longtext()
 * @method Attributes binary($length = 0)
 * @method Attributes varbinary($length = 0)
 * @method Attributes tinyblob()
 * @method Attributes blob()
 * @method Attributes mediumblob()
 * @method Attributes longblob()
 */
class Column
{
    protected $name;
    protected $column = array();

    public function __call($name, $arguments)
    {
        $this->column['type'] = $name;
        $this->column['length'] = 0;
        if(isset($arguments[0])){
            $this->column['length'] = $arguments[0];
        }
        return new Attributes($this->name, $this->column);
    }

    public function __construct($name, array &$column)
    {
        $this->name = $name;
        $this->column = &$column;
    }
}