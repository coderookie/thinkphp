<?php
namespace Crontab\Controller;
use Think\Controller;

class NewsController extends Controller{

    /**
     * @brief 采集直播8
     */
    public function curlZhiboAction(){
        $news_logic = D('News', 'Logic');
        return $news_logic->curlMultiZhibo();
    }
    
    public function curlSinaAction(){
        echo 'curl sina';
    }
    
}
