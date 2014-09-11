<?php
namespace Home\Model;
use Think\Model;

class NewsModel extends Model{

    /**
     * @brief 通过标题查询记录
     * @param type $title 记录
     * @return type 
     */
    public function getRecordByTitle($title){
        return $this->where("title = '%s'", $title)->find();
    }

    /**
     * @brief 插入
     * @param type $data 需要插入的数据
     * @return boolean 如果错误 false 如果成功 返回last_insert_id
     */
    public function insert($data){
        if(!isset($data['title'])){
            return false;
        }
        $record = $this->getRecordByTitle($data['title']);
        if(!empty($record)){
            return false;
        }
        return $this->data($data)->add();
    }

}