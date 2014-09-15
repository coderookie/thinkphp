<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller{
    
    /**
     * @brief 初始化函数
     */
    public function _initialize(){
        $this->assign('controller', 'index');
    }
    
    public function indexAction(){
        $this->display();
    }
    
}