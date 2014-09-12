<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
    
    public function indexAction(){
        //$news_model = D('news');
        //$news_lists = $news_model->getNewsLists();
        $this->show('a');
    }
    
    public function _empty(){
        $this->error('404啦', U('home/index/index'));
    }
    
}