<?php require_once(C(ADMIN_VIEW_PATH) . 'header.php'); ?>
<?php include_once(C(ADMIN_VIEW_PATH) . 'menu.php'); ?>

<!-- main -->
<div class="main">
    <div class="content">
        <!-- bread crump -->
        <div class="breadcrump">
            <h4>
                当前位置：<a href="/admin">首页</a> &gt; 
                <a href="javascript:void(0);"><?php echo isset($controller_name) ? $controller_name : ''; ?></a> &gt; 
                <a href="javascript:void(0);"><?php echo isset($action_name) ? $action_name : ''; ?></a>
            </h4>
        </div>
        <!-- bread crump END -->

        <!-- form star -->
        <form action="<?php echo U('admin/categories/createoreditcategories'); ?>" method='post'>
            <ul class="s_list01 clearfix">
                <li>
                    <span>目前父级分类：</span>
                    <div class="cell">
                        <?php if($parent_categories): ?>
                        <?php foreach($parent_categories as $key => $parent): ?>
                            <?php echo $parent['name']; ?> 
                            <?php if(count($parent_categories) != ($key + 1)): ?>&gt;<?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </li>
                <li>
                    <span>分类：</span>
                    <div class="cell">
                        <input name='cid' type='hidden' value="<?php echo $category['cid']; ?>" />
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
                        <input name="name" type="text" class="s_input01 w200" value="<?php echo $category['name']; ?>">
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