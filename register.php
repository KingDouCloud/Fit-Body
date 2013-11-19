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
		<script src="js/jquery.md5.js"></script>
		<script src="js/page_register.js"></script>
		<script src="js/footer_header.js"></script>
		<!--<link rel="stylesheet" href="css/datetimepicker.css" media="screen">
		<script src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>--><!--这个日曆控件-->
    <title>Fit Body 注册</title>
	</head>
	<body>
	<div class="container mpcontain" id="main">
		<div class="row">
				<div class="mplogbox" style="margin-top:0%;">
					<div class="help-block" style="float:right;text-align: right;">
						已有账号
						<a class="btn btn-large info" tabindex="5" id="reg_btn_login" style="margin-top:0px;" href="index.php">登录</a>
						<br>
						注册了但一直没收到注册激活邮件？
						<br>
						<a class="btn btn-large info" tabindex="5" id="reg_btn_email_again" style="margin-top:0px;" href="register_sendemail_again.php">再次发送激活邮件</a>
					</div >
					<div  id="center">
						<div class="control-group" id="reg_grp_username">
							<label class="control-label" style="width:60px">用戶名</label>
								<span style="float:right;margin-top:5px;margin-left:-100px;color:red;display:none" id="rg_tip_username">
									<i class="icon-remove"></i>该用户名已被注册
								</span>
							<div class="controls" style="margin-right:30px">
								<input type="text" class="input-xlarge" for="inputError" id="reg_username" style="margin-left:-75px;width:250px">
								<p class="help-block">用户名，区分大小写，注册后可修改</p>
							</div>
						</div>
						
						<div class="control-group" id="reg_grp_birthday">
							<label class="control-label" style="width:60px">生日</label>
							<div class="controls" style="margin-right:30px">
								<!--<div class="input-append date form_datetime" id="time_start">
									<input size="10" type="text" id="reg_birthday">
									<span class="add-on"><i class="icon-th"></i></span>
								</div>-->
							
								<input type="text" class="input-xlarge" id="reg_birthday" style="margin-left:-75px;width:250px">
								<p class="help-block">日期格式如：1990-03-19</p>
							
							</div>
						</div>
						
						
						<div class="control-group" id="reg_grp_psw">
							<label class="control-label" style="width:60px">密码</label>
							<div class="controls" style="margin-right:30px">
								<input type="password" class="input-xlarge" id="reg_psw" style="margin-left:-75px;width:250px">
								<p class="help-block">6至20位数字、符号或字符</p>
							</div>
						</div>
						
						<div class="control-group" id="reg_grp_psw_conf">
							<label class="control-label" style="width:60px">密码确认</label>
								<span style="float:right;margin-top:5px;margin-left:-100px;color:red;display:none" id="rg_tip_psw_conf">
									<i class="icon-remove"></i>两次密码需一致
								</span>
							<div class="controls" style="margin-right:30px">
								<input type="password" class="input-xlarge" id="reg_psw_conf" style="margin-left:-75px;width:250px">
								<p class="help-block">再次输入上面的密码</p>
							</div>
						</div>
						
						<div class="control-group" id="reg_grp_email">
							<label class="control-label" style="width:60px">电子邮箱</label>
								<span style="float:right;margin-top:5px;margin-left:-100px;color:red;display:none" id="rg_tip_email">
									<i class="icon-remove"></i>该邮箱已被注册
								</span>
							<div class="controls" style="margin-right:30px">
								<input type="text" class="input-xlarge" id="reg_email" style="margin-left:-75px;width:250px">
								<p class="help-block">用于注册验证及密码找回，注册后可修改</p>
							</div>
						</div>
						
						<div class="control-group" id="reg_grp_sex">
							<label class="control-label" style="width:60px">性别</label>
							<div class="controls" style="margin-right:30px">
								<select class="span5" id="reg_sex" style="margin-left:-75px;width:260px">
									<option>男</option>
									<option>女</option>
								</select>
								</p>
							</div>
						</div>
						
						
					<div class="lbn">
						<button class="btn btn-large primary" tabindex="4" id="reg_btn_register" style="margin-top:0px;">注册</button>
					</div>
						
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