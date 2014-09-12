<?php require_once(C(ADMIN_VIEW_PATH) . 'header.php'); ?>
<?php include_once(C(ADMIN_VIEW_PATH) . 'menu.php'); ?>

<!-- main -->
<div class="main">
    <div class="content">
        <!-- bread crump -->
        <div class="breadcrump">
            <h4>当前位置：<a href="#">首页</a> &gt; <a href="#">频道：新浪房产</a> &gt; <a href="#">项目：淮南房产</a> &gt; 模板：正文页</h4>
        </div>
        <!-- bread crump END -->

        <!-- form star -->
        <form>

            <ul class="s_list01 clearfix">
                <li>
                    <span>新闻标题：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>短标题：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>作者：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>明星编辑推荐：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>请选择</option></select><input name="" type="text" class="s_input01 w100 mr10">
                    </div>
                </li>
                <li>
                    <span>正文：</span>
                    <div class="cell">
                        编辑器位置
                    </div>
                </li>
                <li class="pl150"><input name="" type="button" value="代码模式" class="mr10 pro_btn" /><input name="" type="button" value="插入调查" class="mr10 pro_btn" /><input name="" type="button" value="关键词" class="mr10 pro_btn" /><input name="" type="button" value="楼盘关键词" class="mr10 pro_btn" /><input name="" type="button" value="微博关键字" class="pro_btn" /></li>
                <li>
                    <span>摘要：</span>
                    <div class="cell">
                        <textarea name="" cols="" rows="" class="s_textarea w450"></textarea>
                    </div>
                </li>
                <li>
                    <span>其它媒体：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>媒体名称：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>新浪房产</option></select><input name="" type="text" class="s_input01 w100 mr10"><input name="" type="button" value="查询" class="pro_btn" />
                    </div>
                </li>
                <li>
                    <span>栏目名称：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>地产新闻</option></select><input name="" type="text" class="s_input01 w100 mr10"><input name="" type="button" value="查询" class="pro_btn" />
                    </div>
                </li>
                <li>
                    <span>子栏目名称：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>市场动态</option></select><input name="" type="text" class="s_input01 w100 mr10"><input name="" type="button" value="查询" class="pro_btn" />
                    </div>
                </li>
                <li>
                    <span>搜索关键字：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>是否发往首页：</span>
                    <div class="cell">
                        <select name="" class="s_select"><option>yes</option></select>
                    </div>
                </li>
                <li>
                    <span>发往会员置业刊：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>市场动态</option></select><input name="" type="text" class="s_input01 w100 mr10"><input name="" type="button" value="查询" class="pro_btn" />
                    </div>
                </li>
                <li>
                    <span>发往楼盘：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>市场动态</option></select><input name="" type="text" class="s_input01 w100 mr10"><input name="" type="button" value="查询" class="pro_btn" />
                    </div>
                </li>
            </ul>
            <div class="clearfix">
                <div class="fl s_list06">
                    <h2>相关搜索</h2>
                    <ul>
                        <li>搜索方式</li>
                        <li><select name="" class="s_select"><option>按标题</option></select></li>
                        <li><input name="" type="checkbox" value="" id="pdsearch" class="vm mr5"><label for="pdsearch">只在本频道搜索</label></li>
                        <li>显示字段</li>
                        <li><input name="" type="checkbox" value="" id="mtname"  class="vm mr5"><label for="mtname">媒体名称</label></li>
                        <li><input name="" type="checkbox" value="" id="data"  class="vm mr5"><label for="data">媒体名称</label></li>
                        <li>关键字：<input name="" type="text" class="s_input01 w50"></li>
                        <li><input name="" type="button" value="搜索"></li>
                    </ul>
                </div>
                <div class="cell">
                    <textarea name="" cols="" rows="" class="s_textarea w450 h200"></textarea>
                </div>
            </div>
            <ul class="s_list01 clearfix">
                <li>
                    <span>图片：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>水印位置</option></select><select name="" class="s_select"><option>缩放大小</option></select>
                    </div>
                </li>
                <li>
                    <span>图片1说明：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>图片2：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>水印位置</option></select><select name="" class="s_select"><option>缩放大小</option></select>
                    </div>
                </li>
                <li>
                    <span>图片2说明：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>图片3：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>水印位置</option></select><select name="" class="s_select"><option>缩放大小</option></select>
                    </div>
                </li>
                <li>
                    <span>图片3说明：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>图片20：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                 <li>
                    <span>所属专题：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>请选择</option></select>
                    </div>
                </li>
                <li>
                    <span>所属子专题：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>请选择</option></select><input name="" type="text" class="s_input01 w100 mr10"><input name="" type="button" value="查询" class="pro_btn" />
                    </div>
                </li>
                <li>
                    <span>所属企业：</span>
                    <div class="cell">
                        <select name="" class="s_select mr10"><option>请选择</option></select><input name="" type="text" class="s_input01 w100 mr10"><input name="" type="button" value="查询" class="pro_btn" />
                    </div>
                </li>
                <li>
                    <span>涨降价：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>视频id：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>新闻留言id：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>微博id：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450">
                    </div>
                </li>
                <li>
                    <span>是否增加声明：</span>
                    <div class="cell">
                        <select name="" class="s_select"><option>no</option></select>
                    </div>
                </li>
                <li>
                    <span>是否增加留言板：</span>
                    <div class="cell">
                        <select name="" class="s_select"><option>yes</option></select>
                    </div>
                </li>
                <li>
                    <span>发往平台：</span>
                    <div class="cell">
                        <input name="" type="checkbox" value="" class="mr5 vm" id="leju"><label class="mr10" for="leju">新浪乐居</label><input name="" type="checkbox" value="" class="mr5 vm" id="baile"><label for="baile">百度乐居</label>

                    </div>
                </li>
                <li>
                    <span>是否显示topnews：</span>
                    <div class="cell">
                        <select name="" class="s_select"><option>显示</option></select>
                    </div>
                </li>

            </ul>
            <div class="s_line mt20 mb20"></div>
             <ul class="s_list01 clearfix">
             <li>
                    <span>是否执行相关触发：</span>
                    <div class="cell">
                        <input name="" type="checkbox" value="" class="vm">
                    </div>
                </li>
                <li>
                    <span>显示发布进度：</span>
                    <div class="cell">
                        <input name="" type="checkbox" value="" class="vm">
                    </div>
                </li>
                <li>
                    <span>修改文档的创建时间：</span>
                    <div class="cell">
                        <input name="" type="checkbox" value="" class="vm mr5"><input name="" type="text" class="s_input01 w100"><cite>(YYYY-MM-DD HH:MM:SS)</cite>
                    </div>
                </li>
                <li class=" pl50 s_col1 fb">文档URL样式</li>
                <li>
                    <span>URL模板：</span>
                    <div class="cell">
                        <input name="" type="text" class="s_input01 w450 mr10 vm"><input name="" type="button" class="vm pro_btn" value="修改为默认UR" />
                    </div>
                </li>
             </ul>
        </form>
        <!-- form END -->
    </div>
</div>
<!-- main END -->

<?php include_once(C(ADMIN_VIEW_PATH) . 'footer.php'); ?>