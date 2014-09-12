<?php
namespace Admin\Controller;
use Think\Controller;

class CategoriesController extends Controller{
    
    public function getCategoriesListAction(){
        $this->display('list');
    }
    
}