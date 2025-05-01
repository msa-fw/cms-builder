<?php

namespace Controllers\_BaseController_\Models;

use System\Core\Model;
use System\Core\Database\Table;

/**
 * Class IndexModel
 * @package Controllers\_BaseController_\Models
 *
 * @property Table _BaseController_
 * @method static|Table _BaseController_()
 */
class IndexModel extends Model
{
    protected static $staticName = '_BaseController_';

    protected $tableName = '_BaseController_';

    // $this->cache->key('setCustomPredefinedStaticCacheKeyName');
    protected $cacheKeyPath = '_BaseController_.Index';

    public function total()
    {
        $query = $this->table->count('id')->get();
        if($result = $this->findOneInCache($query)->array()){
            return $result['id'];
        }
        return 0;
    }

    public function selectList($limit, $offset = 0)
    {
        $query = $this->table->select('*')
            ->order('id', 'asc')
            ->limit($limit, $offset)->get();

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