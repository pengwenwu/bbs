	<div class="info">
		<div class="left">
			<img src="/static/images/chart.png">
		</div>
		<span style="color:#A19B9B">今日: </span><?php echo $post_count_today;?>
		<span style="color:#A19B9B">| 昨日: </span><?php echo $post_count_lastday;?>
		<span style="color:#A19B9B">| 帖子: </span><?php echo $post_count_total;?>
		<span style="color:#A19B9B">| 会员: </span><?php echo $member_counts;?>
	</div>
	<div class="main">
		<div class="header">
			<a href=""><span class="title">交流与讨论</span></a>
		</div>
		<div class="content">
			<div class="column">
				<div class="column_child">
					<img src="/static/images/forum_new.gif">
					<a href="<?php echo site_url('Index/catList/1');?>" >插件</a>
				</div>
				<div class="column_child">
					<img src="/static/images/forum_new.gif">
					<a href="<?php echo site_url('Index/catList/2');?>">模板</a>
				</div>
			</div>
			<div class="column" id="column_mid">
				<div class="column_child">
					<img src="/static/images/forum_new.gif">
					<a href="<?php echo site_url('Index/catList/3');?>">应用中心</a>
				</div>
				<div class="column_child">
					<img src="/static/images/forum_new.gif">
					<a href="<?php echo site_url('Index/catList/4');?>">安装使用</a>
				</div>
			</div>
			<div class="column">
				<div class="column_child">
					<img src="/static/images/forum_new.gif">
					<a href="<?php echo site_url('Index/catList/5');?>">站长帮</a>
				</div>
				<div class="column_child">
					<img src="/static/images/forum_new.gif">
					<a href="<?php echo site_url('Index/catList/6');?>">bug反馈</a>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>