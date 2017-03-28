<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/static/css/style.css">
</head>
<body>
	<div class="top">
		<img src="/static/images/logo.png">
		<div class="right">
			<?php if ($is_login) {?>
				<div class="head_msg">
					<p class="msg">昵称：<?php echo get_cookie('nickname');?>   |  <a href="<?php echo site_url('Index/logout');?>">退出</a></p>
				</div>
				<div class="head_img">
					<img src="/static/images/noavatar_small.gif">
				</div>
			<?php } else {?>
				<table cellspacing="0" cellpadding="0">
					<tbody>
					<tr>
						<td>用户名</td>
						<td><input type="text" name="username" id='login_name' maxlength='15'></td>
						<td><input type="checkbox" name="rem_state" value='1'>自动登录</td>
						<td>&nbsp;<a href="">找回密码</a></td>
					</tr>
					<tr>
						<td>密码</td>
						<td><input type="password" name="password" id="login_pwd"></td>
						<td>&nbsp;<button type="button" id='login_btn' tabindex="904" style="width: 75px;">登录</button></td>
						<td>&nbsp;<a href="<?php echo site_url('Index/register'); ?>" ><span class="xi">立即注册</span></a></td>
					</tr>
					</tbody>
				</table>
			<?php }?>
		</div>
	</div>
	<div class="nv">
		<ul>
			<li><a href="<?php echo site_url('Index/home');?>">论坛首页</a></li>
			<li><a href="<?php echo site_url('Index/catList/1');?>">插件</a></li>
			<li><a href="<?php echo site_url('Index/catList/2');?>">模板</a></li>
			<li><a href="<?php echo site_url('Index/catList/3');?>">应用中心</a></li>
			<li><a href="<?php echo site_url('Index/catList/4');?>">安装使用</a></li>
			<li><a href="<?php echo site_url('Index/catList/5');?>">站长帮</a></li>
			<li><a href="<?php echo site_url('Index/catList/6');?>">bug反馈</a></li>
		</ul>
	</div>
	<div class="leading">
		<div class="left">
		<a href="<?php echo site_url('Index/home'); ?>"><img src="/static/images/home.png" ></a> </div>
		>> <a href="<?php echo site_url('Index/home'); ?>">论坛首页</a> 
		<?php if (isset($leading_url['name']) &&  $leading_url['name'] == '用户注册') { ?>
			>> <a href=''>用户注册</a>
		<?php } else if (isset($leading_url['name']) &&  $leading_url['name'] == '用户登录') { ?>
			>> <a href=''>用户登录</a>
		<?php } else if (isset($leading_url['cate_name'])) { ?>
			>> <a href=<?php echo site_url("Index/catList/{$leading_url['cate_id']}");?> > <?php echo $leading_url['cate_name'];?> </a>
			>> <a href=<?php echo site_url("Index/postDetail/{$leading_url['id']}");?> > <?php echo $leading_url['name'];?> </a>
		<?php } else if (isset($leading_url['name'])) { ?>	
			>> <a href=<?php echo site_url("Index/catList/{$leading_url['id']}");?> > <?php echo $leading_url['name'];?> </a>
		<?php } ?>	
	</div>
<script type="text/javascript" src='/static/js/jquery.js'></script>
<script type="text/javascript">
	var loginUrl = "<?php echo site_url('Index/login');?>";
	var homeUrl = "<?php echo site_url('Index/home');?>";
	$('#login_btn').click(function () {
		if ($('#login_name').val().length == 0 || $('#login_pwd').val.length == 0) {
			alert('用户名或密码不能为空！！！');return;
		} else if ($('#login_name').val().length < 3) {
			alert('用户名不小于3个字符');return;
		} else if ($('#login_name').val().length > 15) {
			alert('用户名不超过15个字符');return;
		}
		$.post(
				loginUrl,
				{username:$('#login_name').val(),password:$('#login_pwd').val(),rem_state:$("input[name='rem_state']:checked").val()},
				function (msg) {
					if(msg.state == 1) {
						alert('登录成功');
						location.href = homeUrl;
					} else {
						alert('用户名或密码错误');
					}
				},
				'json'
			);
	});
</script>