	<div class="postdetail">
	<table cellspacing="0" cellpadding="0">
			<tr>
				<td class="pls">
					<div class="pi">作者名字很长</div>
					<div class="avatar"><img src="/static/images/noavatar_middle.gif"></div>
				</td>
				<td class="plc">
					<div class="pi">
						<img src="/static/images/online_admin.gif" id="vm">
					</div>
					<form>
					<table>
						<tr>
							<td>标题：</td>
							<td><input type="text" name="title" id="title" value="<?php echo $title ;?>" maxlength='20'><div id="title_alert"></div></td>
						</tr>
						<tr>
							<td>分类：</td>
							<td>
								<select name="cate_id" id='cate_id'>
									<?php foreach($columns as $v):?>
										<option value="<?php echo $v['id'];?>" <?php echo  $v['id'] == $cate_id ? 'selected=selected' : '';?> ><?php echo $v['name'] ;?></option>
									<?php endforeach;?>
								</select>
							</td>
						</tr>
						<tr>
							<td>内容：</td>
							<td>
								<textarea name="content" id="content" style="width: 700px;height: 300px;visibility: hidden;" id="content"><?=$content ;?></textarea>
								<div id="content_alert"></div>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center;">
								<input type="hidden" name="id" id='id' value="<?php echo $id; ?>">
								<input type="button" value="修改" class="pnc" onclick="return checkPost();">&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
					</table>
				</form>
				</td>
			</tr>
		</table>
		
	</div>
</body>
<script charset="UTF-8" src="/static/js/editor/kindeditor-min.js"></script>
<script charset="utf-8" src="/static/js/editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="/static/js/jquery.js"></script>
<script type="text/javascript">
	var editPostUrl = "<?php echo site_url('Index/editPost'); ?>";
	var postDetailUrl = "<?php echo site_url('Index/postDetail/');?>";
 	//加入在线编辑器
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="content"]', {
            allowFileManager : true,
	        afterBlur:function(){ 
	        }            
        });
    });

    $(document).ready(function(){
    	$('#title').focus();
   		$('#title').blur(function(){
   			if ($("#title").val() == '') {
   				$('#title_alert').html('标题不能为空！');
   				return false;
   			}
   			if ($("#title").val().length < 5) {
   				$('#title_alert').html('标题长度不能少于5！');
   				return false;
   			}
   			if ($("#title").val().length > 20) {
   				$('#title_alert').html('标题长度不能大于20！');
   				return false;
   			}
   			$('#title_alert').html('');
   		}); 
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
	    
		$.post(
				editPostUrl, 
				{id:$('#id').val(), title:$('#title').val(), cate_id:$('#cate_id').val(),content:$('#content').val()},
				function(msg){    
	                if (msg.state == 0) {
	                	$('#content_alert').html(msg.info);
	                } else {
	                	alert(msg.info);
	                	location.href = postDetailUrl + $('#id').val();
		            }
                },
                'json'        
			);	    
   }
</script> 
</html>