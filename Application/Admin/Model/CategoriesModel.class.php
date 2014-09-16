<?php 
namespace Admin\Model;
use Think\Model;

/**
 * @author zhanglei <zhanglei17@leju.com>
 * @brief 无限极分类
 * @date 2014-09-15 11:00:00
 */
class CategoriesModel extends Model{
    
    // 属性结构的数组
    private $_categories = array();
    
    // 某个分类下的父级分类的数组
    private $_parent_categories = array();
    
    
    /**
     * @brief 通过分类名称得到记录
     * @param type $category_name   分类名称
     * @param type $cid             分类ID, 如果传入, 则表示查询非此CID的分类名称等于$name的分类
     * @return type array
     */
    public function getCategoryByName($category_name, $cid = false){
        $where = sprintf("name = '%s'", $category_name);
        if($cid){
            $where .= sprintf(" and cid != %d", $cid);
        }
        $record = $this->where($where)->find();
        //echo $this->getLastSql();die;
        //echo $this->getDbError();die;
        return $record;
    }
    
    /**
     * @brief 增加分类, 如果父类的id是0(也就是添加的分类是顶级分类)或者已经传入level了, 就不用计算level
     * @param type $data array('name' => '', 'pid' => 0)
     * @return type last_insert_id
     */
    public function addCategories($data){
        $record = $this->getCategoryByName($data['name']);
        if(!empty($record)){
            return array('status' => false, 'message' => '分类名称重复');
        }
        
        if(!empty($data['pid']) && empty($data['level'])){
            $category = $this->getCategoryByCid($data['pid']);
            $data['level'] = $category['level'] + 1;
        }
        $last_insert_id = $this->data($data)->add();
        if($last_insert_id){
            return array('status' => true, 'message' => '添加成功');
        }else{
            return array('status' => false, 'message' => '添加失败');
        }
    }
    
    /**
     * @biref 修改分类
     *     修改分类名称
     *     修改分类的父分类
     *     修改父类下面子分类以及自己的level
     * @param type $data 需要修改的内容
     * @return type array
     */
    public function updateCategories($data){
        $record = $this->getCategoryByName($data['name'], $data['cid']);
        if(!empty($record)){
            return array('status' => false, 'message' => '分类名称重复');
        }
        
        // 修改分类时, 需要修改名称, 父级分类(pid), 以及level, 以及自己下面的子分类, 子分类的其他不变, 需要统一修改level
        //$this->execute('set autocommit = 0');
        
        $category_result = $this->save($data);
        $category_level_result = $this->updateCategoriesLevel($data['cid']);
        
        if($category_result && $category_level_result){
            //$this->execute('commit');
            $return = array('status' => true, 'message' => '修改成功');
        }else{
            //$this->execute('rollback');
            $return = array('status' => false, 'message' => '修改失败');
        }
        //  $this->execute('set autocommit = 1');
        return $return;
    }
    
    /**
     * @brief 修改自己以及子分类的level
     *     看下当前分类的父级分类, 将自己的level修改成父级分类的level + 1
     *     然后得到当前分类的子分类, 递归此方法
     * @param type $cid 分类ID
     * @return type boolean
     */
    public function updateCategoriesLevel($cid){
        // 找到当前的分类记录
        $current_category = $this->getCategoryByCid($cid);
        
        // 找到父分类的记录
        $pid = $current_category['pid'];   
        $parent_category = $this->getCategoryByCid($pid);
        
        // 将当前分类的level修改等于父级分类level的值 + 1
        $data['cid'] = $cid;
        if(empty($parent_category)){
            $data['level'] = 1;
        }else{
            $data['level'] = $parent_category['level'] + 1;
        }
 
        // 修改
        $result = $this->save($data);
        
        if($result === false){
            throw new Exception($this->getDbError());
        }
        
        // 得到当前分类的所有子类
        $sub_categories = $this->getCategoriesByPid($cid);
        if(!empty($sub_categories)){
            foreach($sub_categories as $sub){
                // 递归
                $this->updateCategoriesLevel($sub['cid']);
            }
        }
        return true;
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
    
    /*
     * @brief 返回私有属性
     */
    public function getCategoriesList(){
        return $this->_categories;
    }
    
    /**
     * @brief 递归得到所有分类的树形结构
     *     取到顶级分类
     *         循环, 将被循环的放入属性中, 将自己的cid传入该函数再循环
     *         一直到没有子分类位置, 进入上一级循环
     * @param type $pid 分类ID, 默认0, 顶级分类
     * @return type see $this->getCategoriesList()
     */
    public function getTotalCategories($pid = 0){
        // 得到全部父类
        $categories = $this->getCategoriesByPid($pid);
        if(!empty($categories)){
            foreach($categories as $category){
                $this->_categories[] = $category;
                $this->getTotalCategories($category['cid']);
            }
        }
        return $this->getCategoriesList();
    }
    
    /**
     * @brief 删除分类
     * @param type $cid 分类ID
     * @return type 成功true 失败false
     */
    public function delCategories($cid){
        return $this->where("cid = %d", $cid)->delete();
    }
    
    /**
     * @brief 得到某个分类的父级分类
     * @param type $cid 分类ID
     * @return type array
     */
    public function getParentCategories($cid){
        $category = $this->getCategoryByCid($cid);
        if($category){
            $this->_parent_categories[] = $category;
            return $this->getParentCategories($category['pid']);
        }else{
            return array_reverse($this->_parent_categories);
        }
    }
    
}