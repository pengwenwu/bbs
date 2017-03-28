<div class="login">
	<div class="alert_info">
		抱歉，您尚未登录，没有权限在该版块发帖
	</div>
	<div class="messagelogin">
		<table cellspacing="0" cellpadding="5">
			<tr>
				<td colspan="4"><h4>用户登录</h4></td>
			</tr>
			<tr>
				<td class="pll">用户名：</td>
				<td class="plm"><input type="text" name="username" id="username" maxlength="15" placeholder="用户名长度3-15"></td>
				<td class="plr"><a href="<?php echo site_url('Index/register');?>">用户注册</a></td>
				<td class="l_chk" id="chk_username"></td>
			</tr>
			<tr>
				<td class="pll">密码：</td>
				<td class="plm"><input type="password" name="password" id="password" maxlength="50" placeholder="密码长度不小于8"></td>
				<td class="plr"></td>
				<td class="l_chk" id="chk_password"></td>
			</tr>
			<tr>
				<td class="pll"></td>
				<td class="plm"><input type="checkbox" name="login_state" id="" value="1">自动登录</td>
				<td class="plr"></td>
				<td></td>
			</tr>
			<tr>
				<td class="pll"></td>
				<td class="plm"><input type="button" name="" id="btn" value="登录" class="pnc"></td>
				<td class="plr"></td>
				<td></td>
			</tr>
		</table>
	</div>
</div>
<script type="text/javascript" src='/static/js/jquery.js'></script>
<script type="text/javascript">
	var loginUrl = "<?php echo site_url('Index/login');?>";
	var homeUrl = "<?php echo site_url('Index/home');?>";
	$('#btn').click(function () {
		if ($('#username').val().length == 0) {
			$('#chk_username').html('用户名不能为空！');return;
		} else if ($('#username').val().length < 3) {
			$('#chk_username').html('用户名长度不能小于3！');return;
		} else if ($('#username').val().length > 15) {
			$('#chk_username').html('用户名长度不能大于15！');return;
		}
		if ($('#password').val().length == 0) {
			$('#chk_password').html('密码不能为空！');return;
		} else if ($('#password').val().length < 8) {
			$('#chk_password').html('密码长度不能小于8！');return;
		} else if ($('#password').val().length > 50) {
			$('#chk_password').html('密码长度不能大于50！');return;
		}
		$.post(
				loginUrl,
				{username:$('#username').val(),password:$('#password').val(),rem_state:$("input[name='login_state']:checked").val()},
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