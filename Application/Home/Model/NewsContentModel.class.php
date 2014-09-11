<?php
namespace Home\Model;
use Think\Model;

class NewsContentModel extends Model{

    /**
     * @brief 通过news_id找到内容
     * @param type $news_id
     * @return type
     */
    public function getNewsByNewsId($news_id){
        return $this->where("news_id = %d", $news_id)->find();
    }
    
    /**
     * @brief 新闻内容表插入数据
     * @param type $data
     * @return 如果news_id重复, 返回重复的新闻内容, 不重复, 插入 返回last_insert_id
     */
    public function insert($data){
        if(!isset($data['news_id']) || empty($data['news_id'])){
            return false;
        }
        $news = $this->getNewsByNewsId($data['news_id']);
        if(!empty($news)){
            return $news;
        }
        $last_insert_id = $this->data($data)->add();
        if($last_insert_id && is_int($last_insert_id)){
            return $last_insert_id;
        }else{
            throw new Exception($this->getDbError());
        }
    }

}