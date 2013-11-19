<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8">		
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="css/footer.css" type="text/css" />
		<link rel="stylesheet" href="css/index.css" type="text/css" />
		<script src="js/jquery-1.8.1.js"></script>
		<script src="js/jquery.md5.js"></script>
		<script src="js/page_index.js"></script>
		<script src="js/footer_header.js"></script>
    <title>Fit Body</title>
	</head>
	<body>
	<div class="container mpcontain" id="main">
		<div class="row">
			 <div class="span5 offset6">
				<div class="mplogbox">
					<div class="errorinfo" style="visibility:hidden">不存在该用户名！</div>
					<div class="usn">
						<div class="cotitle"><label></label></div>
						<div class="coinput"><input class="input-big"  id="username"type="text" placeholder="用户名" tabindex="1"></div>
						<div class="clearb"></div>
					</div>
					<div class="pwd">
						<div class="cotitle"><label></label></div>
						<div class="coinput"><input class="input-big"  id="password" type="password" placeholder="密码" tabindex="2"></div>
						<div class="clearb"></div>
					</div>
					<div class="rme">
						<div class="checkbox" tabindex="3">✓</div>
						<div class="checklabel"><span>下次自动登录</span></div>
						<div class="clearb"></div>
					</div>
					<div class="lbn">
						<button class="btn btn-large primary" tabindex="4" id="loginbtn">登录</button>
						<button class="btn btn-large" tabindex="5" id="registerbtn">注册</button>
					</div>
					<hr class="soften small">
					<div class="tip">
						<h4>忘记密码</h4>
						<p>忘記就忘記了吧，就像有些東西，錯過了就是錯過了</p>
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