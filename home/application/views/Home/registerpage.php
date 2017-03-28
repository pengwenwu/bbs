<div class="add_list">
	<div class="bm_h">
		立即注册
	</div>
	<div class="register">
		<form id="registerForm">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="pls"><span class="rq">*</span>用户名：</td>
					<td class="plc">
						<input type="text" name="username" id="username"  maxlength="15" placeholder="请输入3-15个字符"><span class="p_chk" id="chk_username"></span>
					</td>
				</tr>
				<tr>
					<td class="pls"><span class="rq">*</span>密码：</td>
					<td class="plc"><input type="password" name="password" id="password" placeholder="长度大于8密码"><span class="p_chk" id="chk_password"></span></td>
				</tr>
				<tr>
					<td class="pls"><span class="rq">*</span>昵称：</td>
					<td class="plc"><input type="text" name="nickname" id="nickname" maxlength="15" placeholder="请输入3-15个字符"><span class="p_chk" id="chk_nickname"></span></td>
				</tr>
				<tr>
					<td class="pls"><span class="rq">*</span>性别：</td>
					<td class="plc"><input type="radio" name="sex" value="1" checked="checked">男<input type="radio" name="sex" value="2">女</td>
				</tr>
				<tr>
					<td class="pls"><span class="rq">*</span>邮箱：</td>
					<td class="plc"><input type="email" name="email" id="email" placeholder="请输入合法邮箱"><span class="p_chk" id="chk_email"></span></td>
				</tr>
				<tr>
					<td class="pls">出生日期：</td>
					<td class="plc">
						<select name="birthday" class="sel_year" rel="1994"> </select> 年 
						<select name="birthday" class="sel_month" rel="5"> </select> 月 
						<select name="birthday" class="sel_day" rel="1"> </select> 日 
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="" id="btn" value="提交" class="pnc"></td>
				</tr>
			</table>
		</form>
	</div>
	
</div>
</body>
<script src="/static/js/jquery.js"></script>
<script src="/static/js/jquery.validate.min.js"></script>
<script src="/static/js/messages_zh.js"></script>
<script src="/static/js/birthday.js"></script>
<script type="text/javascript">
	var registerUrl = "<?php echo site_url('Index/registerSub');?>";
	var homeUrl = "<?php echo site_url('Index/home');?>";
	$(document).ready(function() {	
		jQuery.validator.addMethod("regPwd", function(value, element) {     
	        var pwd = /[a-zA-Z]+[0-9]+/;  
	        return this.optional(element) || (pwd.test(value));  
	    }, "此字段只允许英文数字组合");  

    	$("#registerForm").validate({
    		debug : true,
    		rules : {
    			username : {
    				required : true,
    				minlength : 3,
    				maxlength : 15
    			},
    			password : {
    				required : true,
    				minlength : 8,
    				maxlength : 50,
    				regPwd : true
    			},
    			nickname : {
    				required : true,
    				minlength : 3,
    				maxlength : 15
    			},
    			email : {
    				required : true,
    				maxlength : 50,
    				email : true
    			}
    		},
    		messages : {
    			username : {
    				required : '请出入用户名',
    				minlength : '至少3个字符',
    				maxlength : '最大长度不超过15'
    			},
    			password : {
    				required : '请输入密码',
    				minlength : '密码长度至少为8',
    				maxlength : '密码最大长度不要超过50',
    				regPwd : '密码必须以字母开头,包含数字'
    			},
    			nickname : {
    				required : '请输入昵称',
    				minlength : '至少三个字符',
    				maxlength : '最大长度不超过15'
    			},
    			email : {
    				required : '请输入邮箱',
    				maxlength : '邮箱长度不要超过50',
    				email : '请输入合法邮箱,如pww@163.com'
    			}	
    		},
    		submitHandler : function (form) {
				$.post(
						registerUrl, 
						{username:$('#username').val(), password:$('#password').val(), nickname:$('#nickname').val(),
						sex:$("input[name='sex']:checked").val(), email:$('#email').val(),sel_year:$('.sel_year').val(),
						sel_month:$('.sel_month').val(),sel_day:$('.sel_day').val()	
						},
						function (msg) {
							if (msg.state == 0) {
								if (msg.name == 'username') {
									$('#chk_username').html(msg.info);
								} else if (msg.name == 'nickname') {
									$('#chk_nickname').html(msg.info);
								} else if (msg.name == 'password') {
									$('#chk_password').html(msg.info);
								} else if (msg.name == 'email') {
									$('#chk_email').html(msg.info);
								}
							} else {
								alert('注册成功');
								location.href = homeUrl;
							}
						},
						'json'
					);
    		}

    	});

    	
    	$(function () { 
		    $.ms_DatePicker({ 
		            YearSelector: ".sel_year", 
		            MonthSelector: ".sel_month", 
		            DaySelector: ".sel_day" 
		    }); 
		});
		(function($){ 
			$.extend({ 
			ms_DatePicker: function (options) { 
			   var defaults = { 
			         YearSelector: "#sel_year", 
			         MonthSelector: "#sel_month", 
			         DaySelector: "#sel_day", 
			         FirstText: "--", 
			         FirstValue: 0 
			   }; 
			   var opts = $.extend({}, defaults, options); 
			   var $YearSelector = $(opts.YearSelector); 
			   var $MonthSelector = $(opts.MonthSelector); 
			   var $DaySelector = $(opts.DaySelector); 
			   var FirstText = opts.FirstText; 
			   var FirstValue = opts.FirstValue; 
			 
			   // 初始化 
			   var str = "<option value=\"" + FirstValue + "\">"+FirstText+"</option>"; 
			   $YearSelector.html(str); 
			   $MonthSelector.html(str); 
			   $DaySelector.html(str); 
			 
			   // 年份列表 
			   var yearNow = new Date().getFullYear(); 
			   var yearSel = $YearSelector.attr("rel"); 
			   for (var i = yearNow; i >= 1900; i--) { 
			        var sed = yearSel==i?"selected":""; 
			        var yearStr = "<option value=\"" + i + "\" " + sed+">"+i+"</option>"; 
			        $YearSelector.append(yearStr); 
			   } 
			 
			    // 月份列表 
			    var monthSel = $MonthSelector.attr("rel"); 
			    for (var i = 1; i <= 12; i++) { 
			        var sed = monthSel==i?"selected":""; 
			        var monthStr = "<option value=\"" + i + "\" "+sed+">"+i+"</option>"; 
			        $MonthSelector.append(monthStr); 
			    } 
			 
			    // 日列表(仅当选择了年月) 
			    function BuildDay() { 
			        if ($YearSelector.val() == 0 || $MonthSelector.val() == 0) { 
			            // 未选择年份或者月份 
			            $DaySelector.html(str); 
			        } else { 
			            $DaySelector.html(str); 
			            var year = parseInt($YearSelector.val()); 
			            var month = parseInt($MonthSelector.val()); 
			            var dayCount = 0; 
			            switch (month) { 
			                 case 1: 
			                 case 3: 
			                 case 5: 
			                 case 7: 
			                 case 8: 
			                 case 10: 
			                 case 12: 
			                      dayCount = 31; 
			                      break; 
			                 case 4: 
			                 case 6: 
			                 case 9: 
			                 case 11: 
			                      dayCount = 30; 
			                      break; 
			                 case 2: 
			                      dayCount = 28; 
			                      if ((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0)) { 
			                          dayCount = 29; 
			                      } 
			                      break; 
			                 default: 
			                      break; 
			            } 
			                     
			            var daySel = $DaySelector.attr("rel"); 
			            for (var i = 1; i <= dayCount; i++) { 
			                var sed = daySel==i?"selected":""; 
			                var dayStr = "<option value=\"" + i + "\" "+sed+">" + i + "</option>"; 
			                $DaySelector.append(dayStr); 
			             } 
			         } 
			      } 
			      $MonthSelector.change(function () { 
			         BuildDay(); 
			      }); 
			      $YearSelector.change(function () { 
			         BuildDay(); 
			      }); 
			      if($DaySelector.attr("rel")!=""){ 
			         BuildDay(); 
			      } 
			   } // End ms_DatePicker 
			}); 
		})(jQuery);

});	
	
</script>
</html>