<?php
namespace Admin\Controller;
use Think\Controller;

class CategoriesController extends Controller{
    
    /**
     * @brief 初始化, 每次都执行的函数
     */
    public function _initialize(){
        $this->assign('controller', 'categories');
        $this->assign('controller_name', '分类管理');
    }
    
    /**
     * @brief 分类列表
     */
    public function getCategoriesListAction(){
        $this->assign('action_name', '分类列表');
        
        $categories_model = D('categories');
        $categories_lists = $categories_model->getTotalCategories();
        
        //print_r($categories_lists);die;
        $this->assign('categories_lists', $categories_lists);
        
        $this->display('list');
    }
    
    /**
     * @brief 编辑 增加分类
     */
    public function createOrEditCategoriesAction(){
        // 得到顶级的分类
        $categories_model = D('categories');
        $top_categories = $categories_model->getCategoriesByPid();
        
        // 得到一些请求参数
        $cid  = I('request.cid', false);
        $pid  = I('post.pid',    0);
        $name = I('post.name',   '');
        
        //赋值
        $this->assign('top_categories', $top_categories);
        
        if(IS_POST){
            if($cid){
                // 提交编辑动作
                $data['cid']  = $cid;
                $data['name'] = $name;
                $data['pid']  = $pid;
                $return       = $categories_model->updateCategories($data);
            }else{
                // 提交增加动作
                $data['name'] = $name;
                $data['pid']  = $pid;
                $return       = $categories_model->addCategories($data);
            }

            if($return['status']){
                //$this->redirect('admin/categories/getcategorieslist');
            }else{
                /*
                $this->error(
                    isset($return['message']) ? $return['message'] : '', 
                    '/admin/categories/' . ($cid ? 'getcategorieslist' : 'createoreditcategories')
                );
                */
            }
        }else{
            // 显示 增加 或者 编辑的模板
            if($cid){
                // 编辑
                
                // 查看编辑的分类是否存在
                $category = $categories_model->getCategoryByCid($cid);
                if(!$category){
                    $this->error('编辑的分类不存在', '/admin/categories/getcategorieslist');
                }
                
                // 得到该分类的父级分类
                $parent_categories = $categories_model->getParentCategories($cid);
                
                $this->assign('category', $category);
                $this->assign('parent_categories', $parent_categories);
                $this->assign('action_name', sprintf('分类编辑 %s', $category['name']));
                $this->display('edit');
            }else{
                // 增加
                $this->assign('action_name', '分类增加');
                $this->display('add');
            }
        }
    }
    
    /**
     * @brief 得到某个分类下面的子分类
     */
    public function getSubCategoriesAction(){
        // 得到请求的参数
        $cid = I('post.cid');
        
        // 得到传入分类下面的子分类
        $categories_model = D('categories');
        $sub_categories = $categories_model->getCategoriesByPid($cid);
        
        return $this->ajaxReturn($sub_categories);
    }
    
    /**
     * @brief 删除分类
     */
    public function delCategoriesAction(){
        $cid = I('post.cid');
        
        $categories_logic = D('categories', 'Logic');
        $returns = $categories_logic->delCategories($cid);
        
        return $this->ajaxReturn($returns);
    }
    
}