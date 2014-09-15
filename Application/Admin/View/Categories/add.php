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
        <form action="<?php echo U('admin/categories/createoreditcategories'); ?>" method='post'>
            <ul class="s_list01 clearfix">
                <li>
                    <span>分类：</span>
                    <div class="cell">
                        <input name='pid' type='hidden' />
                        <select class="s_select mr10" onchange='get_sub_categories(this)'>
                            <option value='0'>请选择</option>
                            <?php if(!empty($top_categories)): ?>
                            <?php foreach($top_categories as $top_c): ?>
                            <option value="<?php echo $top_c['cid']; ?>"><?php echo $top_c['name']; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </li>
                <li>
                    <span>分类名称：</span>
                    <div class="cell">
                        <input name="name" type="text" class="s_input01 w200">
                    </div>
                </li>
                <li>
                    <span>
                        <input name='submit' value='提交' type='submit' />
                    </span>
                </li>
            </ul>    
        </form>
        <!-- form END -->
    </div>
</div>
<!-- main END -->

<?php include_once(C(ADMIN_VIEW_PATH) . 'footer.php'); ?>