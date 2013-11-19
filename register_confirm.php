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
    <title>Fit Body 注册成功</title>
	</head>
	<body>
	<div class="container mpcontain" id="main">
		<div class="row">
				<div class="mplogbox" style="margin-top:0%;">
					<?
						$userid = $_GET["userid"];
						$code = $_GET["code"];
						include("api/cl/CL_Userinfo.php");
						$userinfo = new User_info();
						$result = $userinfo->func_active_user($userid,$code);
						//echo $result."<br>";
						$haha = "激活出错啦。<br>啦啦，啦啦，啦啦啦啦啦……";
						if($result == "success")
						{
							$haha = "激活结果：账号激活成功，请重新<a href=\"http://fitbody.sinaapp.com\">登录</a>";
						}
						else
							if($result == "time out")
							{
								$haha = "激活结果：超过了账号注册后的三十天期限，请重新注册，并及时激活";
							}
							else
								if($result == "no this userid")
								{
									$haha = "激活结果：您的账号不需要激活,或者这个账号没有被注册";
								}
								else
									if($result == "wrong code")
									{
										$haha = "激活结果：错误的激活码,请检查激活链接是否正确";
									}
						$haha .= "<br><br>返回首页：<a href='index.php'>Fit_Boddy</a>";
						echo $haha;
					?>
					<br>
					<!--<span id="jumpTo">10</span>秒后自动跳转到 http://fitbody.sinaapp.com/-->
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
						countDown(10,'http://fitbody.sinaapp.com/');
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