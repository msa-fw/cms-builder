<?php

namespace System\Core\Database\Drivers\MySQLi\Abstracts;

use System\Core\Database\Statics\Expression;
use System\Core\Database\Table\Expression as QueryExpression;
use System\Core\Database\Table\Interfaces\InsertGetterInterface;
use System\Core\Database\Table\Interfaces\ExpressionGetterInterface;
use System\Core\Database\Table\Interfaces\AlterTableGetterInterface;

abstract class QueryBuilder
{
    const TABLE_ATTRIBUTES = array(
        "autoextendSize" => "AUTOEXTEND_SIZE",
        "autoIncrement" => "AUTO_INCREMENT",
        "avgRowLength" => "AVG_ROW_LENGTH",
        "checksum" => "CHECKSUM",
        "comment" => "COMMENT ",
        "compression" => "COMPRESSION",
        "connection" => "CONNECTION",
        "delayKeyWrite" => "DELAY_KEY_WRITE",
        "encryption" => "ENCRYPTION",
        "engine" => "ENGINE",
        "engineAttribute" => "ENGINE_ATTRIBUTE",
        "insertMethod" => "INSERT_METHOD",
        "keyBlockSize" => "KEY_BLOCK_SIZE",
        "maxRows" => "MAX_ROWS",
        "minRows" => "MIN_ROWS",
        "packKeys" => "PACK_KEYS",
        "password" => "PASSWORD",
        "rowFormat" => "ROW_FORMAT",
        "startTransaction" => "START TRANSACTION",
        "secondaryEngineAttribute" => "SECONDARY_ENGINE_ATTRIBUTE",
        "statsAutoRecalc" => "STATS_AUTO_RECALC",
        "statsPersistent" => "STATS_PERSISTENT",
        "statsSamplePages" => "STATS_SAMPLE_PAGES",
    );

    public function buildSelectQuery(ExpressionGetterInterface $interface, &$bindings = array())
    {
        $query = array();
        return implode(" ", $query);
    }

    protected function buildInsertNestedQuery($inserts, array &$fields, array &$values, array &$bindings)
    {
        foreach($inserts as $insert){
            if($insert instanceof InsertGetterInterface){
                return $this->buildInsertNestedQuery($insert->getInsert(), $fields, $values, $bindings);
            }
            $tmpValues = array();
            foreach($insert as $field => $value){
                $fields[$field] = "`{$field}`";
                if($value instanceof Expression){
                    $tmpValues[] = $value->getValue();
                }else{
                    $hash = $this->bind($value, $bindings);
                    $tmpValues[] = $hash;
                }
            }
            $values[] = "(" . implode(", ", $tmpValues) . ")";
        }
        $fields = array_values($fields);
        return true;
    }

    protected function buildQuery(ExpressionGetterInterface $interface, array &$query, array &$bindings)
    {
        if($wheres = $interface->getWhere()){
            $this->buildExpression($wheres, $query, $bindings);
        }
        if($joins = $interface->getJoin()){
            $this->buildJoin($joins, $query, $bindings);
        }
        if($groups = $interface->getGroup()){
            $tmp = array();
            foreach($groups as $group){
                $tmp[] = "{$group['key']} {$group['value']}";
            }
            $query[] = "GROUP BY " . implode(", ", $tmp);
        }
        if($orders = $interface->getOrder()){
            $tmp = array();
            foreach($orders as $order){
                $tmp[] = "{$order['key']} {$order['value']}";
            }
            $query[] = "ORDER BY " . implode(", ", $tmp);
        }
        if($heavings = $interface->getHeaving()){
            $this->buildHeaving($wheres, $query, $bindings);
        }
        if($limit = $interface->getLimit()){
            $query[] = "LIMIT {$limit}";
        }
        if($offset = $interface->getOffset()){
            $query[] = "OFFSET {$offset}";
        }
    }

    protected function buildJoin(array $joins, array &$query, array &$bindings)
    {
        foreach($joins as $join){
            $query[] = "{$join['operator']} {$join['table']} on {$join['expression']}";
        }
    }

    protected function buildHeaving(array $heavings, array &$query, array &$bindings)
    {
        foreach($heavings as $heaving){
            $hash = $this->bind($heaving['value'], $bindings);
            $query[] = "{$heaving['key']} {$heaving['operator']} {$hash}";
        }
    }

    protected function buildExpression(array $wheres, array &$query, array &$bindings)
    {
        if($query){ $query[] = "WHERE"; }

        foreach($wheres as $index => $where){
            if($index){
                $query[] = $where['concat'];
            }

            switch(true){
                case($where['key'] instanceof QueryExpression):
                    $result = "(" . $this->buildSelectQuery($where['key'], $bindings) .")";
                    break;
                case($where['value'] instanceof QueryExpression):
                    $result = "{$where['key']} {$where['operator']} (" . $this->buildSelectQuery($where['value'], $bindings) .")";
                    break;
                case($where['key'] instanceof Expression):
                    $result = $where['key']->getValue();
                    break;
                case(isset($bindings[$where['value']])):
                    $result = "{$where['key']} {$where['operator']} {$where['value']}";
                    break;
                default:{
                    $hash = $this->bind($where['value'], $bindings);
                    $result = "{$where['key']} {$where['operator']} {$hash}";
                }
            }
            $query[] = $result;
        }
    }

    protected function bind($value, array &$bindings)
    {
        $hash = md5($value . rand(PHP_INT_MIN, PHP_INT_MAX) . microtime(true) . mt_rand());
        $hash = "%b_{$hash}_b%";
        $bindings[$hash] = $value;
        return $hash;
    }

    //--

    protected function buildAlterColumnsQuery(AlterTableGetterInterface $interface)
    {
        $columns = array();
        foreach($interface->getColumns() as $name => $column){
            if($column['operator'] == 'rename'){
                $columns[] = "RENAME COLUMN `{$name}` TO `{$column['newName']}`";
                continue;
            }else
                if($column['operator'] == 'drop'){
                    $columns[] = "DROP COLUMN `{$name}`";
                    continue;
                }

            $prefix = '';
            switch(true){
                case $column['operator'] == 'add' : $prefix = "ADD COLUMN ";
                    break;
                case $column['operator'] == 'change' : $prefix = "CHANGE COLUMN `{$column['newName']}` ";
                    break;
                case $column['operator'] == 'modify' : $prefix = "MODIFY COLUMN ";
                    break;
            }
            $columns[] = $prefix . $this->buildColumn($name, $column);
        }
        if($columns = implode(",\n", $columns)){
            return  "{$columns},";
        }
        return '';
    }

    protected function buildAlterIndexesQuery(AlterTableGetterInterface $interface)
    {
        $indexes = array();
        foreach($interface->getIndexes() as $name => $index){
            $name = "`{$name}`";

            $query = $length = '';
            if($index['length']){
                $length = "({$index['length']})";
            }

            $index['type'] = strtoupper($index['type']);
            if($index['type'] == 'PRIMARY'){
                $name = 'KEY';
            }

            switch(true){
                case $index['operator'] == 'add' : $query = "ADD {$index['type']} $name (`{$index['colName']}`$length)";
                    break;
                case $index['operator'] == 'drop' : $query = "DROP {$index['type']} $name";
                    break;
                case $index['operator'] == 'rename' : $query = "RENAME {$index['type']} $name TO `{$index['newName']}`";
                    break;
            }
            $indexes[] = $query;
        }
        if($indexes = implode(",\n", $indexes)){
            return  "{$indexes},";
        }
        return '';
    }

    //--

    protected function buildTableOptions($engine, array $tableOptions, array &$attributes)
    {
        foreach($tableOptions as $key => $value){
            if($key == 'engine'){
                $value = $value ?: $engine;
            }

            if(isset(self::TABLE_ATTRIBUTES[$key])){
                $attribute = self::TABLE_ATTRIBUTES[$key];
                if($value){
                    $value = is_string($value) ? "'$value'" : $value;
                    $attribute .= " = $value";
                }
                $attributes[] = $attribute;
            }
        }
    }

    protected function buildIndex(array $columnIndexes, $columnName, array &$indexes, $type, $defaultLength)
    {
        foreach($columnIndexes as $index => $length){
            $value = "`{$index}` (`{$columnName}`)";
            $length = $length ?: $defaultLength;
            if($length){
                $length = "({$length})";
                if($type == 'UNIQUE'){
                    $length = "";
                }
                $value = "`{$index}` (`{$columnName}`$length)";
            }
            $indexes[] = "$type $value";
        }
    }

    protected function buildColumn($name, array $attributes)
    {
        $column = "`{$name}` {$attributes['type']}";

        if(isset($attributes['length']) && !empty($attributes['length'])){
            $column .= " ({$attributes['length']})";
        }

        if(isset($attributes['attributes']['charset'])){
            $column .= " CHARACTER SET {$attributes['attributes']['charset']}";
        }
        if(isset($attributes['attributes']['collate'])){
            $column .= " COLLATE {$attributes['attributes']['collate']}";
        }

        if(isset($attributes['attributes']['unsigned'])){
            $column .= " unsigned";
        }
        if(isset($attributes['attributes']['zerofill'])){
            $column .= " zerofill";
        }

        $default = " NOT NULL DEFAULT {$attributes['default']}";
        if(is_null($attributes['default'])){
            $default = " NULL DEFAULT NULL";
        }
        if(isset($attributes['indexes']['primary'])){
            $default = " NOT NULL AUTO_INCREMENT";
        }
        if(isset($attributes['attributes']['currenttimestamp'])){
            $default = " NOT NULL DEFAULT CURRENT_TIMESTAMP";
        }
        if(isset($attributes['attributes']['currenttimestamponupdate'])){
            $default = " NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP";
        }
        $column .= $default;

        if(isset($attributes['attributes']['comment'])){
            $column .= " COMMENT '{$attributes['attributes']['comment']}'";
        }
        if(isset($attributes['attributes']['after'])){
            $column .= " AFTER '{$attributes['attributes']['after']}'";
        }
        if(isset($attributes['attributes']['first'])){
            $column .= " FIRST";
        }

        return $column;
    }
}
