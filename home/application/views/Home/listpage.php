<?php if (isset($error)) { ?>
	<div class="error_msg">
		<div class="errorleft"><img src="/static/images/error.gif"></div>
		<div class="errorright">
			<p>抱歉，指定的版块不存在</p>
			<p><a href="#" onclick="javascript:history.go(-1);">[点击这里返回上一页]</a></p>
		</div>
		
	</div>
<?php } else { ?>
	<div class="addpost">
		<span id='add_post'><img src="/static/images/pn_post.png"></span>
		<?php echo $this->pagination->create_links(); ?>
	</div>
	<div class="list">
		<div class="top">
			<div class="left">
				&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('Index/catList/1');?>">全部主题</a>
				&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('Index/hotPost/').($this->uri->segment(3, 1));?>">热门</a>
			</div>
			<span class="author">作者</span>
			<span class="reply_num">回复</span>
			<span class="reply">最后发表</span>
		</div>
		<table class="post_list">
			<?php foreach ($list as $v) { ?>
			<tr>
				<td width="55%">
					<?php if (in_array($v['id'], $top_id)){?>
							<img src=/static/images/recommend_1.gif>
					<?php }?>

					<a href=<?php echo site_url("Index/postDetail/{$v['id']}");?> ><?php echo $v['title'];?></a>
					<?php if ($v['is_ban'] == 1) { ?>
						<span class="wp">已解决</span>
					<?php } ?>
				</td>
				<td width="20%" class="item">
					<p><?php echo $v['user_name'];?></p> <p><?php echo $v['update_dated'];?></p>
				</td>
				<td width="5%" class="item"><?php echo $v['reply_num']?></td>
				<td width="20%" class="item">
					<?php if (!empty($v['reply_dated'])) { ?>
						<p><?php echo $v['reply_user_name'];?></p> 
						<p><?php echo $v['reply_dated'];?></p>
					<?php } else { ?>
						<p><?php echo $v['user_name'];?></p> 
						<p><?php echo $v['update_dated'];?></p>
					<?php } ?>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>
	<div class="addpost">
		<?php echo $this->pagination->create_links(); ?>
	</div>
	<div class="add_list">
		<div class="bm_h">快速发帖</div>
		<form>
			<table>
				<tr>
					<td>标题：</td>
					<td>
						<input type="text" name="title" id="title" placeholder='标题长度5-20' maxlength='20' <?php echo ($is_login == false) ? "readonly='readonly'" : '' ?> >
						<?php if ($is_login == true) {?>
							<div id="title_alert"></div>
						<?php }?>
					</td>
				</tr>
				<tr>
					<td>分类：</td>
					<td>
						<select name="cate_id" id="cate_id">
							<?php foreach($columns as $v):?>
								<option value="<?php echo $v['id'];?>" <?php echo  $v['id'] == $cate_id ? 'selected=selected' : '';?>><?php echo $v['name'] ;?></option>
							<?php endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td>发帖内容：</td>
					<td>
						<textarea name="content" style="width: 700px;height: 300px;" id="content" >
							<?php if ($is_login == false) {?>
								<br><br><br><br>
								您需要登录后才可以发帖 &nbsp;|&nbsp; 
								<a href=javascript:parent.location.href="<?php echo site_url('Index/loginSub');?>">登录</a> &nbsp;|&nbsp; 
								还没账号？<a href=javascript:top.location.href="<?php echo site_url('Index/register');?>">新用户注册</a>
							<?php }?>
						</textarea>
						<div id="content_alert"></div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php if ($is_login == false) {?>
							<input type="button" value="发表帖子" class="pnc" onclick=javascript:window.location.href="<?php echo site_url('Index/loginSub');?>">
						<?php } else {?>
							<input type="button" value="发表帖子" class="pnc" id="btn" onclick="return checkPost();">
						<?php }?>	
					</td>
				</tr>
			</table>
			
		</form>
	</div>
<?php } ?>
</body>
<script charset="UTF-8" src="/static/js/editor/kindeditor-min.js"></script>
<script charset="utf-8" src="/static/js/editor/lang/zh_CN.js"></script>
<!-- <script charset="utf-8" src="/static/js/jquery.js"></script> -->
<script type="text/javascript">
	var addPostUrl = "<?php echo site_url('Index/addPost'); ?>";
	var catListUrl = "<?php echo site_url('Index/catList/'); ?>";
	//加入在线编辑器
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="content"]', {
        	filterMode : true, 
        	uploadJson : '/application/libraries/upload_json.php',
			fileManagerJson : '/application/libraries/file_manager_json.php',
            allowFileManager : true,
	        afterBlur:function(){ 
	        }            
        });
        <?php if ($is_login == false) {?>
        editor.readonly(true);
        <?php }?>
    });

    $(document).ready(function(){
   		$('#title').blur(function(){
   			if ($("#title").val() == '') {
   				$('#title_alert').html('标题不能为空！');
   				return false;
   			}
   			if ($("#title").val().length < 5) {
   				$('#title_alert').html('标题长度不能少于五！');
   				return false;
   			}
   			if ($("#title").val().length > 20) {
   				$('#title_alert').html('标题长度不能多余二十！');
   				return false;
   			}
   			$('#title_alert').html('');
   		}); 
    });
    function checkPost () 
    {
		editor.sync();
		if ($("#title").val() == '') {
   				$('#title_alert').html('标题不能为空！');
   				return false;
   			}
   			if ($("#title").val().length < 5) {
   				$('#title_alert').html('标题长度不能少于五！');
   				return false;
   			}
   			if ($("#title").val().length > 20) {
   				$('#title_alert').html('标题长度不能多余二十！');
   				return false;
   			}
   			$('#title_alert').html('');
   			
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
	    
		$.post(
				addPostUrl, 
				{title:$('#title').val(), cate_id:$('#cate_id').val(),content:$('#content').val()},
				function(msg){    
	                if (msg.state == 0) {
	                	$('#content_alert').html(msg.info);
	                } else {
	                	alert(msg.info);
	                	location.href = catListUrl + $('#cate_id').val();
		            }
                },
                'json'        
			);	    
    }
   	$('#add_post').click(function(){
    	$('html, body').animate({scrollTop:'1000px'}, 1000);     
    });
</script> 
</html>