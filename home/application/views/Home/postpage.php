<?php if (isset($error)) { ?>
	<div class="error_msg">
		<div class="errorleft"><img src="/static/images/error.gif"></div>
		<div class="errorright">
			<p>抱歉，指定的主题不存在或已被删除或正在被审核</p>
			<p><a href="#" onclick="javascript:history.go(-1);">[点击这里返回上一页]</a></p>
		</div>
		
	</div>
<?php } else { ?>
	<div class="addpost">
		<span id='reply_post'><img src="/static/images/pn_reply.png"></span>
		<?php echo $this->pagination->create_links(); ?>
	</div>
	<div class="postdetail">
		<table cellspacing='0' cellpadding="0">
			<tr>
				<td class="pls">回复：<?php echo $info['reply_num']; ?></td>
				<td class="plc">
					<?php echo in_array($info['id'], $top_id) ? '<img src=/static/images/recommend_1.gif>' : ''; ?>
					<span class="posttitle"><?php echo $info['title'];?></span>
				</td>
			</tr>
		</table>
		<table cellpadding="0" cellspacing="0" class="ad">
			<tr>
				<td class="pls"></td>
				<td class="plc"></td>
			</tr>
		</table>
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td class="pls">
					<div class="pi"><?php echo $info['user_name'] ;?></div>
					<div class="avatar"><img src="/static/images/noavatar_middle.gif"></div>
				</td>
				<td class="plc">
					<div class="pi">
					<img src="/static/images/online_admin.gif" id="vm">
					发表于 <?php echo $info['update_dated'];?>
					<?php if ($info['user_id'] == get_cookie('id')) {?>
					<span class="pipe">|</span><a href=<?php echo site_url("Index/editPost/{$info['id']}");?> >修改</a>
					<span class="pipe">|</span><a href=<?php echo site_url("Index/deletePost/{$info['id']}");?> onclick="return confirm('确定要删除吗?')">删除</a>
					<span class="pipe">|</span><a href=<?php echo site_url("Index/topPost/{$info['id']}");?> >置顶</a>
					<span class="pipe">|</span><a href=<?php echo site_url("Index/endPost/{$info['id']}");?> >结帖</a>
					<?php }?>
					</div>
					<?php echo $info['content'] ;?>
						
				</td>
			</tr>
		</table>
		<!-- 回复内容 -->
		<?php foreach ($reply_list as $v) { ?>
		<table cellpadding="0" cellspacing="0" class="ad">
			<tr>
				<td class="pls"></td>
				<td class="plc"></td>
			</tr>
		</table>
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td class="pls">
					<div class="pi"><?php echo $v['reply_user_name']; ?></div>
					<div class="avatar">
						<img src="/static/images/noavatar_middle.gif">
					</div>
				</td>
				<td class="plc">
					<div class="pi">
						<?php if ($v['user_id'] == $info['user_id']) {?>
							<img src="/static/images/online_admin.gif" id="vm">	
						<?php } else {?>
							<img src="/static/images/online_member.gif" id="vm">	
						<?php }?>
						回复于 <?php echo $v['dated'] ;?>
						<?php if ($v['user_id'] == get_cookie('id')) {?>
							<span class="pipe">|</span><a href=<?php echo site_url("Index/deleteReply/{$info['id']}/{$v['id']}");?> onclick="return confirm('确定要删除吗?')">删除</a>
						<?php }?>
					</div>
						<?php echo $v['content']; ?> 
				</td>
			</tr>
		</table>
		<?php } ?>
	</div>
	<div class="addpost">
		<?php echo $this->pagination->create_links(); ?>
	</div>
		
	<div class="postdetail">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td class="pls"></td>
				<td class="plc">
					<?php if ($info['is_ban'] == 0) { ?>
					<form>
						<textarea name="content" id='content'>
							<?php if ($is_login == false) {?>
								<br><br><br>
								您需要登录后才可以回复 &nbsp;|&nbsp; 
								<a href=javascript:parent.location.href="<?php echo site_url('Index/loginSub');?>">登录</a> &nbsp;|&nbsp; 
								还没账号？<a href=javascript:top.location.href="<?php echo site_url('Index/register');?>">新用户注册</a>
							<?php }?>
						</textarea>
						<div id="content_alert"></div>
						<input type="hidden" name="post_id" value="<?php echo $info['id'];?>" id='post_id'>	
						<?php if ($is_login == false) {?>
							<input type="button" value="发表回复" class="pnc" onclick=javascript:window.location.href="<?php echo site_url('Index/loginSub');?>">
						<?php } else {?>
							<input type="button" value="发表回复" class="pnc" id='btn' onclick="return checkPost();">&nbsp;&nbsp;&nbsp;
						<?php }?>
						
					</form>
					<?php } else { ?>
						暂不提供回复功能
					<?php } ?>
				</td>
			</tr>
		</table>
	</div>
<?php } ?>
</body>
<script charset="UTF-8" src="/static/js/editor/kindeditor-min.js"></script>
<script charset="utf-8" src="/static/js/editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="/static/js/jquery.js"></script>
<script type="text/javascript">
	var replyPostUrl = "<?php echo site_url('Index/replyPost'); ?>";
	var postDetailUrl = "<?php echo site_url('Index/postDetail/') ;?>";
	//加入在线编辑器
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="content"]', {
            allowFileManager : true,
	        afterBlur:function(){ 
	        }            
        });
        <?php if ($is_login == false) {?>
        editor.readonly(true);
        <?php }?>
    });

	function checkPost () 
	    {
			editor.sync();
			if ($("#content").val() == '') {
				$('#content_alert').html('内容不能为空！');
				return false;
			}
			if ($("#content").val().length < 5) {
				$('#content_alert').html('内容长度不能少于5！');
				return false;
			}
			if ($("#content").val().length > 1000) {
				$('#content_alert').html('内容长度不能大于1000！');
				return false;
			}
			$('#content_alert').html('');
		    
		    $.ajax({
            type : 'post',       
            url : replyPostUrl, 
            dataType : 'json',
            data : {post_id:$('#post_id').val(),content:$('#content').val()},
            success : function(msg){    
                if (msg.state == 0) {
                	$('#content_alert').html(msg.info);
                } else {
                	alert(msg.info);
                	location.href = postDetailUrl + $('#post_id').val();
                };         
            }
        });
	}
	$(document).ready(function() {
		//对超出边界的图片进行处理
	    $(".plc img").each(function(){
		var c =$(this).width();
		var maxWidth = $('.plc').width();
		if(c>maxWidth){
			$(this).width(maxWidth)
		}
	});
	$('#reply_post').click(function(){
    	$('html, body').animate({scrollTop:'2000px'}, 1000);     
    });

	
});
</script> 
</html>