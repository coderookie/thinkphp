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
     * @notice 
     *     由于需要先修改自己的name跟pid(update), 再去后去修改分类后新父级分类的level(select)
     *     此时用到事务, 未commit的时候. 不会写入到binlog中, select取不到最新的数据
     *     切换数据库, 将DB_CONFIG2设置为主库, 则以后用$this->db(2)的都是主库
     * @param type $data 需要修改的内容
     * @return type array
     */
    public function updateCategories($data){
        // 切换数据库 切换到主库, 解决master 与 slave 在事务中存在的问题
        $this->db(2, DB_CONFIG2);
        
        $record = $this->getCategoryByName($data['name'], $data['cid']);
        if(!empty($record)){
            return array('status' => false, 'message' => '分类名称重复');
        }
        
        // 修改分类时, 需要修改名称, 父级分类(pid), 以及level, 以及自己下面的子分类, 子分类的其他不变, 需要统一修改level
        $this->db(2)->execute('start transaction');
        
        // 先修改名称, pid
        $category_result = $this->db(2)->save($data);
        
        // 修改子分类的level
        $category_level_result = $this->updateCategoriesLevel($data['cid']);
        
        if($category_result !== false && $category_level_result !== false){
            $this->db(2)->execute('commit');
            $return = array('status' => true, 'message' => '修改成功');
        }else{
            $this->db(2)->execute('rollback');
            $return = array('status' => false, 'message' => '修改失败');
        }
        return $return;
    }

    /**
     * @brief 修改被修改分类以及子分类的level
     *     得到修改前分类与修改后分类的level之间的差值
     *     得到所有子分类的cid以及自己的cid
     *     统一修改level
     * @param type $cid 分类ID
     * @return boolean
     */
    public function updateCategoriesLevel($cid){
        // 获取被修改的分类记录
        $current_category = $this->getCategoryByCidFromMaster($cid);
        $pid = $current_category['pid'];
        
        // 获取修改后父类的level
        $parent_category = $this->getCategoryByCidFromMaster($pid);
        $level = !empty($parent_category) ? $parent_category['level'] : 1;
        
        // 计算修改后的level 与 修改之前的level之间的差值, 修改后的level = 父类的level + 1
        $level_diff = $level + 1 - $current_category['level'];
        
        // 找到被修改分类的全部子类的ID
        $cids = array();
        $sub_categories = $this->getTotalCategories($cid);
        if(!empty($sub_categories)){
            foreach($sub_categories as $value){
                $cids[] = $value['cid'];
            }
        }
        
        array_push($cids, $cid);
        // 修改被修改的分类, 以及子类的level
        $result = $this->db(2)->where(sprintf("cid in (%s)", implode(',', $cids)))->setInc('level', $level_diff);
        //echo $this->getLastSql();die;
        
        if($result !== false){
            return true;
        }else{
            return false;
        }
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
     * @brief 通过主键得到记录, 从master上得到记录
     * @param type $cid 分类ID
     */
    public function getCategoryByCidFromMaster($cid){
        return $this->db(2)->find($cid);
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
    
    public function getSubCategories($cid, $edit_cid = false){
        $where = '';
        $where .= sprintf("pid = %d", $cid);
        if(!empty($edit_cid)){
            $where .= sprintf(" and cid != %d", $edit_cid);
        }
        return $this->where($where)->order('cid desc')->select();
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