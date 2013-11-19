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
		<!--<script src="js/jquery.md5.js"></script>
		<script src="js/page_register.js"></script>
		<script src="js/footer_header.js"></script>-->
    <title>Fit Body 注册成功</title>
	</head>
	<body>
	<div class="container mpcontain" id="main">
		<div class="row">
				<div class="mplogbox" style="margin-top:0%;">
					<?
						echo "恭喜你注册用户名为：".$_GET["username"]."的用户成功<br>账号激活邮件已经发到您的邮箱：".$_GET["email"]."<br>";
						echo "请在注册之后的三十天内点击激活邮件里面的链接激活账号，（三十天后不激活则会注销您的注册信息）";
						echo '<br>页面将会在<span id="jumpTo" style="color:red">20</span>秒后跳转到登陆页面 <a herf="index.php">http://fitbody.sinaapp.com/</a>';
					?>
					<script type="text/javascript">
						function countDown(secs,surl)
						{       
							var jumpTo = document.getElementById('jumpTo');
							jumpTo.innerHTML=secs;  
							if(--secs>0)
							{     
								setTimeout("countDown("+secs+",'"+surl+"')",1000);     
							}     
							else
							{       
								location.href=surl;     
							}     
						}     
						countDown(20,'index.php');
					</script>  

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