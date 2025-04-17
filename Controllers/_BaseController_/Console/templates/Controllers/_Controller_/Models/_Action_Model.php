<?php

namespace Controllers\_Controller_\Models;

use System\Core\Model;
use System\Core\Database\Table;

/**
 * Class _Action_Model
 * @package Controllers\_Controller_\Models
 *
 * @property Table _Controller_
 * @method static|Table _Controller_()
 */
class _Action_Model extends Model
{
    protected static $staticName = '_Controller_';

    protected $tableName = '_Controller_';

    // $this->cache->key('setCustomPredefinedStaticCacheKeyName');
    protected $cacheKeyPath = '_Controller_._Action_';

    public function selectList()
    {
        $query = $this->table->select('*')
            ->where('id', '>', 30)
            ->order('id', 'asc')
            ->limit(10)->get();

        return $this->findManyInCache($query)->array();
    }

    public function selectItem($id)
    {
        $query = $this->table->select('*')
            ->where('id', '=', $id)
            ->limit(1)->get();

        return $this->findOneInCache($query)->array();
    }

    public function updateItemById($id, array $update)
    {
        $rows = $this->table->update($update)
            ->where('id', '=', $id)
            ->limit(1)
            ->order('id', 'desc')
            ->exec()->rows();

        if($rows){ $this->cache->clear(); }

        return $rows;
    }

    public function insertData(array $insert, array $update = array())
    {
        $id = $this->table->insert($insert)
            ->update($update)
            ->exec()->id();

        if($id){ $this->cache->clear(); }

        return $id;
    }

    public function deleteItemById($id)
    {
        $rows = $this->table->delete()
            ->where('id', '=', $id)
            ->limit(1)
            ->order('id', 'desc')
            ->exec()->rows();

        if($rows){ $this->cache->clear(); }

        return $rows;
    }
}