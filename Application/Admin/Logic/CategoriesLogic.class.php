<?php
namespace Admin\Logic;
use Think\Model;

class CategoriesLogic extends Model{
    
    /**
     * @brief 逻辑层删除分类
     * @param type $cid 分类ID
     * @return type 返回数组 key status message
     */
    public function delCategories($cid){
        // 先查看被删除的分类是否有子分类, 有不让删除, 如果没有则删除
        $categories_model = D('categories');
        
        $sub_categories = $categories_model->getCategoriesByPid($cid);
        
        if(!empty($sub_categories)){
            // 有子分类
            return array('status' => false, 'message' => '父级分类不允许删除');
        }
        
        $result = $categories_model->delCategories($cid);
        if($result !== false){
            // 删除成功
            return array('status' => true, 'message' => '删除成功');
        }else{
            // 删除失败
            return array('status' => false, 'message' => '删除失败');
        }
    }
    
}