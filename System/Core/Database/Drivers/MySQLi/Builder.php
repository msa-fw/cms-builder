<?php

namespace System\Core\Database\Drivers\MySQLi;

use System\Core\Database\Statics\Expression;
use System\Core\Database\Drivers\MySQLi\Abstracts\QueryBuilder;
use System\Core\Database\Table\Interfaces\TableGetterInterface;
use System\Core\Database\Table\Interfaces\InsertGetterInterface;
use System\Core\Database\Table\Interfaces\UpdateGetterInterface;
use System\Core\Database\Table\Interfaces\ExpressionGetterInterface;
use System\Core\Database\Table\Interfaces\AlterTableGetterInterface;

class Builder extends QueryBuilder
{
    public function buildSelectQuery(ExpressionGetterInterface $interface, &$bindings = array())
    {
        $query = array();

        if($fieldsList = $interface->getFields()){
            $fields = array();
            $query[] = "SELECT";
            foreach($fieldsList as $field){
                if($field instanceof Expression){
                    $field = $field->getValue();
                }else
                    if($field != '*'){
                        $field = "`$field`";
                    }
                $fields[] = $field;
            }
            $query[] = implode(", ", $fields);
        }
        if($table = $interface->getTable()){
            $query[] = "FROM `{$interface->getDatabase()}`.`{$table}`";
        }
        $this->buildQuery($interface, $query, $bindings);
        return implode(" ", $query);
    }

    public function buildDeleteQuery(ExpressionGetterInterface $interface, &$bindings = array())
    {
        $query = array();

        if($table = $interface->getTable()){
            $query[] = "DELETE FROM `{$interface->getDatabase()}`.`{$table}`";
        }
        $this->buildQuery($interface, $query, $bindings);
        return implode(" ", $query);
    }

    /**
     * @param UpdateGetterInterface $interface
     * @param array $bindings
     * @return string
     */
    public function buildUpdateQuery(UpdateGetterInterface $interface, &$bindings = array())
    {
        $query = array();

        if($table = $interface->getTable()){
            $query[] = "UPDATE `{$interface->getDatabase()}`.`{$table}`";
        }
        if($valuesList = $interface->getValues()){
            $values = array();
            $query[] = "SET";
            foreach($valuesList as $field => $value){
                if($value instanceof Expression){
                    $value = $value->getValue();
                    $values[] = "`{$field}` = $value";
                }else{
                    $hash = $this->bind($value, $bindings);
                    $values[] = "`{$field}` = $hash";
                }
            }
            $query[] = implode(", ", $values);
        }
        $this->buildQuery($interface, $query, $bindings);
        return implode(" ", $query);
    }

    public function buildInsertQuery(InsertGetterInterface $interface, &$bindings = array())
    {
        $query = array();

        if($table = $interface->getTable()){
            $query[] = "INSERT INTO `{$interface->getDatabase()}`.`{$table}`";
        }
        if($insert = $interface->getInsert()){
            $values = array();
            $fields = array();
            $this->buildInsertNestedQuery($insert, $fields, $values, $bindings);

            $fields = "(" . implode(", ", $fields) . ")";
            $values = implode(",\n", $values);

            $query[] = "$fields VALUES $values";
        }

        if($update = $interface->getUpdate()){
            $query[] = "ON DUPLICATE KEY UPDATE";
            $values = array();
            foreach($update as $field => $value){
                if($value instanceof Expression){
                    $value = $value->getValue();
                    $values[] = "`{$field}` = {$value}";
                }else{
                    $hash = $this->bind($value, $bindings);
                    $values[] = "`{$field}` = {$hash}";
                }
            }
            $query[] = implode(", ", $values);
        }
        return implode(" ", $query);
    }

    public function buildAlterTableQuery($engine, AlterTableGetterInterface $interface)
    {
        $query = $columns = array();

        $query[] = "ALTER TABLE `{$interface->getDatabase()}`.`{$interface->getTable()}`";

        if($columns = $this->buildAlterColumnsQuery($interface)){
            $query[] =  $columns;
        }

        if($indexes = $this->buildAlterIndexesQuery($interface)){
            $query[] = $indexes;
        }

        $attributes = array();

        if($directory = $interface->getDirectory()){
            $attributes[] = "DIRECTORY = '{$directory}'";
        }

        if($tableOptions = $interface->getAttributes()){
            $this->buildTableOptions($engine, $tableOptions, $attributes);
        }

        if($attributes = implode(" ", $attributes)){
            $query[] = $attributes;
        }

        if($charset = $interface->getCharset()){
            $query[] = "DEFAULT CHARSET={$charset}";
            if($collate = $interface->getCollate()){
                $query[] = "COLLATE={$collate}";
            }
        }

        return trim(implode("\n", $query), ',');
    }

    public function buildCreateTableQuery($engine, $charset, $collate, TableGetterInterface $interface)
    {
        $query = $columns = $indexes = array();

        foreach($interface->getColumns() as $name => $column){
            $columns[] = $this->buildColumn($name, $column);

            if(isset($column['indexes']['primary'])){
                $indexes[] = "PRIMARY KEY (`{$name}`)";
            }

            if(isset($column['indexes']['keys'])){
                foreach($column['indexes']['keys'] as $index){
                    $indexes[] = "KEY `{$index}` (`{$name}`)";
                }
            }

            if(isset($column['indexes']['index'])){
                $this->buildIndex($column['indexes']['index'], $name, $indexes, 'INDEX', $column['length']);
            }

            if(isset($column['indexes']['unique'])){
                $this->buildIndex($column['indexes']['unique'], $name, $indexes, 'UNIQUE', $column['length']);
            }

            if(isset($column['indexes']['fulltext'])){
                $this->buildIndex($column['indexes']['fulltext'], $name, $indexes, 'FULLTEXT', $column['length']);
            }
        }
        $columns = implode(",\n", $columns);

        $query[] = "CREATE TABLE IF NOT EXISTS `{$interface->getDatabase()}`.`{$interface->getTable()}` (";

        if($indexes){
            $query[] = "$columns,";
            $query[] = implode(",\n", $indexes);
        }else{
            $query[] = $columns;
        }

        $attributes = array();

        if($directory = $interface->getDirectory()){
            $attributes[] = "DIRECTORY = '{$directory}'";
        }
        if($tableOptions = $interface->getAttributes()){
            $this->buildTableOptions($engine, $tableOptions, $attributes);
        }
        $attributes = implode(" ", $attributes);

        $query[] = ") $attributes DEFAULT CHARSET={$charset} COLLATE={$collate}";

        return implode("\n", $query);
    }
}
