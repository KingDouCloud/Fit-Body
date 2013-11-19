<!DOCTYPE html>
<html>
	<head>
	<style>
		body{TEXT-ALIGN: center;}
		#center{ 
				MARGIN-RIGHT: auto;
				MARGIN-LEFT: auto;
				width:450px;
				vertical-align:middle;
				}
	</style>
	
    <meta charset="utf-8">		
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="css/footer.css" type="text/css" />
		<link rel="stylesheet" href="css/index.css" type="text/css" />
		<script src="js/jquery-1.8.1.js"></script>
		<script src="js/footer_header.js"></script>
    <title>Fit Body 注册</title>
	</head>
	<body>
	<div class="container mpcontain" id="main">
		<div class="row">
				<div class="mplogbox" style="margin-top:0%;">
					<div class="help-block" style="float:right;text-align: right;">
						已有账号
						<a class="btn btn-large info" tabindex="5" id="reg_btn_login" style="margin-top:0px;" href="index.php">登录</a>
						<br><br>
						<a class="btn btn-large info" tabindex="5" id="reg_btn_email_again" style="margin-top:0px;" href="register.php">返回注册页面</a>
					</div >
					<div  id="center">					
						<br><br>					
						<div class="control-group" id="reg_grp_username">
							<label class="control-label" style="width:60px">用戶名</label>
								<span style="float:right;margin-top:5px;margin-left:-100px;color:red;display:none" id="rg_tip_username">
									<i class="icon-remove"></i>该用户名已被注册
								</span>
							<div class="controls" style="margin-right:30px">
								<input type="text" class="input-xlarge" for="inputError" id="username" style="margin-left:-75px;width:250px">
								<p class="help-block">注册的用户名</p>
							</div>
						</div>
				
						
						<div class="control-group" id="reg_grp_email">
							<label class="control-label" style="width:60px">电子邮箱</label>
								<span style="float:right;margin-top:5px;margin-left:-100px;color:red;display:none" id="rg_tip_email">
									<i class="icon-remove"></i>该邮箱已被注册
								</span>
							<div class="controls" style="margin-right:30px">
								<input type="text" class="input-xlarge" id="email" style="margin-left:-75px;width:250px">
								<p class="help-block">注册时填写的邮箱</p>
							</div>
						</div>	
					<div class="lbn">
						<button class="btn btn-large primary" tabindex="4" id="reg_btn_send_email" style="margin-top:0px;" data-loading-text="loading...">发送注册激活邮件</button>
					</div>
						
					<script type="text/javascript">
					$("#reg_btn_send_email").live("click",function(ctl)
						{
							document.getElementById('reg_btn_send_email').disabled = true;
							$("#reg_btn_send_email").html("正在操作……");
							var username = $("#username").val();
							var email = $("#email").val();
							if(email == "" || username == "")
							{
								alert("所需信息没输入完整");
								$("#reg_btn_send_email").html("发送注册激活邮件");
								document.getElementById('reg_btn_send_email').disabled = false;
							}
							else
							{
								var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
								if(!myreg.test(email))
								{
									alert("邮箱格式不正确");
									$("#reg_btn_send_email").html("发送注册激活邮件");
									document.getElementById('reg_btn_send_email').disabled = false;
								}	
								else
								{								
									$postdata = {
										"username":$("#username").val(),
										"email":$("#email").val()
									};
									$.post('api/common/regist_send_email_again.php', $postdata, function(res) 
									{
										if(res == 1)
											alert("激活邮件已经发送，如一段时间后还未收到，请再次请求重发。\r\n非常抱歉给您带来的不便。");
										if(res == 0)
											alert("此账号不需要激活");
										if(res == -1)
											alert("您输入的用户名和绑定的邮箱不匹配");
										if(res == -2)
											alert("这个邮箱没有被注册过");
										$("#reg_btn_send_email").html("发送注册激活邮件");
										document.getElementById('reg_btn_send_email').disabled = false;
									});
								}
							}
						})
					</script>  
					
					</div>
				</div>
		</div>
		<hr class="soften">
		<div class="mpfooter">
		<?
            date_default_timezone_set('PRC');
			echo date('Y-m-d H:i:s',time());
		 ?>
		 </div>
		 
		 
	</div>
	</body>
</html>