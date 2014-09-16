<?php include_once(C(ADMIN_VIEW_PATH) . 'header.php'); ?>
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


		<!-- tabel -->
		<table class="d_table">
			<tr>
				<th><div class="w50"><i class="d d_01"></i>分类ID</div></th>
				<th><div class="w200"><i class="d d_01"></i>分类标题</div></th>
				<th><div class="w150"><i class="d d_01"></i>创建时间</div></th>
				<th><div class="w150"><i class="d d_01"></i>操作</div></th>
			</tr>
            <?php if($categories_lists): ?>
            <?php foreach($categories_lists as $category): ?>
			<tr class="d_gray_bg">
				<td><?php echo $category['cid']; ?></td>
                <td>
                    <?php for($i = 2; $i <= $category['level']; $i++): ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php endfor; ?>
                    <?php echo $category['name']; ?>
                </td>
				<td><?php echo $category['created_time']; ?></td>
                <td>
                    <a href="<?php echo U('/admin/categories/createoreditcategories/cid/' . $category['cid']); ?>">编辑</a>
                    <a href='javascript:void(0)' onclick="del_cat(<?php echo $category['cid']; ?>)">删除</a>
                </td>
			</tr>
            <?php endforeach; ?>
            <?php endif; ?>
		</table>
		<!-- tabel END -->
	</div>
</div>
<!-- main END -->

<?php include_once(C(ADMIN_VIEW_PATH) . 'footer.php'); ?>