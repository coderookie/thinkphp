<!-- siderbar -->
<div class="siderbar" >

	<div class="siderbar_con" >
		<!-- user infor -->
		<div class="sidebar_user_info">
			<p>用户：<span>姓名</span></p>
			<p>地址：<span>219.142.118.227</span></p>
		</div>
		<!-- user infor END -->

		<!-- menu list -->
		<div class="menu_title menu_t1">
			<span>频道列表</span>
			<em class="cur" onclick="Show_Hidden(mt0)">展开</em>
		</div>
		<div class="menu_content" id="mt0" <?php if($controller != 'index'): ?>style="display: none"<?php endif; ?>>
			<ul class="menu_list">
				<li><a href='#'>测试频道</a></li>
			</ul>
		</div>
		<!-- menu list END -->

		<!-- menu list -->
		<div class="menu_title menu_t2">
			<span>分类管理</span>
			<em onclick="Show_Hidden(mt1)" class="cur">展开</em>
		</div>
		<div class="menu_content" id="mt1" <?php if($controller != 'categories'): ?>style="display:none;"<?php endif; ?>>
			<ul class="menu_list">
				<li><a href="<?php echo U('admin/categories/createoreditcategories'); ?>">添加分类</a></li>
				<li><a href="<?php echo U('admin/categories/getcategorieslist'); ?>">分类列表</a></li>
			</ul>
		</div>
		<!-- menu list END -->

		<!-- menu list -->
		<div class="menu_title menu_t3">
			<span>高级配置</span>
			<em class="cur" onclick="Show_Hidden(mt2)">展开</em>
		</div>
		<div class="menu_content" id="mt2" style="display:none;">
			<ul class="menu_list">
				<li><a href='#'>默认项目</a></li>
				<li><a href='#'>默认模板</a></li>
				<li><a href='#'>通用模板域</a></li>
				<li><a href='#'>通用函数</a></li>
				<li><a href='#'>计划任务</a></li>
				<li><a href='#'>资源列表</a></li>
				<li><a href='#'>专题风格</a></li>
			</ul>
		</div>
		<!-- menu list END -->
		
					<!-- menu list -->
		<div class="menu_title menu_t4">
			<span>系统管理</span>
			<em class="cur" onclick="Show_Hidden(mt3)">展开</em>
		</div>
		<div class="menu_content" id="mt3" style="display:none;">
			<ul class="menu_list">
				<li><a href='#'>频道管理</a></li>
				<li><a href='#'>用户管理</a></li>
				<li><a href='#'>文章属性</a></li>
			</ul>
		</div>
		<!-- menu list END -->
		
		<!-- menu list -->
		<div class="menu_title menu_t4">
			<span>维护工具</span>
			<em class="cur" onclick="Show_Hidden(mt4)">展开</em>
		</div>
		<div class="menu_content" id="mt4" style="display:none;">
			<ul class="menu_list">
				<li><a href='#'>数据查询</a></li>
				<li><a href='#'>缓存管理</a></li>
				<li><a href='#'>接口日志</a></li>
				<li><a href='#'>系统日志</a></li>
				<li><a href='#'>用户跟踪</a></li>
				<li><a href='#'>导数据配置</a></li>
			</ul>
		</div>
		<!-- menu list END -->
		
		<!-- menu list -->
		<div class="menu_title menu_t5">
			<span>系统帮助</span>
			<em class="cur" onclick="Show_Hidden(mt5)">展开</em>
		</div>
		<div class="menu_content" id="mt5" style="display:none;">
			<ul class="menu_list">
				<li><a href='#'>模板域参考</a></li>
				<li><a href='#'>SQL查询</a></li>
				<li><a href='#'>算法查询</a></li>
				<li><a href='#'>文档管理</a></li>
			</ul>
		</div>
		<!-- menu list END -->
	</div>
	
</div>
<!-- siderbar END -->