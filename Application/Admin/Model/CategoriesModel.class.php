<?php 
namespace Admin\Model;
use Think\Model;

/**
 * @author zhanglei <zhanglei17@leju.com>
 * @brief 无限极分类
 * @date 2014-09-15 11:00:00
 */
class CategoriesModel extends Model{
    
    private $_categories = array();
    
    /**
     * @brief 增加分类, 如果父类的id是0(也就是添加的分类是顶级分类)或者已经传入level了, 就不用计算level
     * @param type $data array('name' => '', 'pid' => 0)
     * @return type last_insert_id
     */
    public function addCategories($data){
        if(!empty($data['pid']) && empty($data['level'])){
            $category = $this->getCategoryByCid($data['pid']);
            $data['level'] = $category['level'] + 1;
        }
        return $this->data($data)->add();
    }
    
    /**
     * @brief 通过主键得到记录
     * @param type $cid 分类ID
     * @return type
     */
    public function getCategoryByCid($cid){
        return $this->find($cid);
    }
    
    /**
     * @brief 返回某个分类下面的分类数组
     * @param type $pid 分类ID, 默认0, 返回顶级分类下面的子分类
     * @param type $page 分页的页数
     * @param type $limit 分页的每页条数
     * @return type 返回某个分类下面的分类数组
     */
    public function getCategoriesByPid($cid = 0, $page = 0, $limit = 0){
        $select = $this->where("pid = %d", $cid);
        if(!empty($page) && !empty($limit)){
            $categories_lists = $select->page($page)->limit($limit)->order('cid desc')->select();
        }else{
            $categories_lists = $select->order('cid desc')->select();
        }
        //echo $this->getLastSql();die;
        return $categories_lists;
    }
    
    public function getCategoriesList(){
        return $this->_categories;
    }
    
    
    public function getTotalCategories($pid = 0){
        // 得到全部父类
        $top_categories = $this->getCategoriesByPid($pid);
        if(!empty($top_categories)){
            foreach($top_categories as $category){
                $this->_categories[] = $category;
                $this->getTotalCategories($category['cid']);
            }
        }
        return $this->getCategoriesList();
    }
    
}