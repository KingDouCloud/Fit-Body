
$(function(){
	//输入框获得焦点后给div加高亮
	$("#username").focus(function(){
		$(".usn").addClass("act");
	});
	$("#username").blur(function(){
		$(".usn").removeClass("act");
	});
	$("#password").focus(function(){
		$(".pwd").addClass("act");
	});
	$("#password").blur(function(){
		$(".pwd").removeClass("act");
	});
	//复选框点击样式变换
	$(".checkbox").bind("click", function(e){
		var ele = $(e.target);
		if (ele.hasClass("active")){
			ele.removeClass("active");
		}else {
			ele.addClass("active");
		}
	});
	//设定tab顺序同时使
	$(".checkbox").bind("keydown", function(e){
		if (e.keyCode == 13){
			var ele = $(e.target);
			if (ele.hasClass("active")){
				ele.removeClass("active");
			}else {
				ele.addClass("active");
			}
		}
	});

	
	$(".errorinfo").css("visibility","hidden");
	//绑定两个输入框的
	$("#username").bind("blur", function(){
		if ($(this).val()=="")
		{
			$(".errorinfo").css("visibility","visible");
			$(".errorinfo").html("用户名不能为空！");
		}
		else
			$(".errorinfo").css("visibility","hidden");
	});
	$("#username").bind("keyup",function(){
		if ($(this).val()=="")
		{
			$(".errorinfo").css("visibility","visible");
			$(".errorinfo").html("用户名不能为空！");
		}
		else
			$(".errorinfo").css("visibility","hidden");
	});
	$("#password").bind("blur", function(){
		if ($(this).val()=="")
		{
			$(".errorinfo").css("visibility","visible");
			$(".errorinfo").html("密码不能为空！");
		}
		else
			$(".errorinfo").css("visibility","hidden");
	});
	$("#password").bind("keyup",function(){
		if ($(this).val()=="")
		{
			$(".errorinfo").css("visibility","visible");
			$(".errorinfo").html("密码不能为空！");
		}
		else
			$(".errorinfo").css("visibility","hidden");
	});	

});



$(document).ready(function(){
	//檢測是不是已經有cookie了，如果有了就檢測存的cookie對不對，對的話直接跳轉
	var strCookie=document.cookie; 
	//将多cookie切割为多个名/值对 
	var arrCookie=strCookie.split("; "); 
	var c_userid; 
	var c_username;
	var c_psw;
	var c_authority;
	if(arrCookie.length > 4 )//如果存cookie
	{
		//遍历cookie数组，处理每个cookie对
		for(var i=0;i<arrCookie.length;i++)
		{ 
			var arr=arrCookie[i].split("=");
			//找到名称为userId的cookie，并返回它的值 
			if("userid" == arr[0])
				c_userid = decodeURI(arr[1]);
			if("username" == arr[0])
				c_username = decodeURI(arr[1]);
			if("password" == arr[0])
				c_psw = decodeURI(arr[1]);
			if("authority" == arr[0])
				c_authority = decodeURI(arr[1]);
		} 
		//檢測存的cookie是不是正確
		var postData = {
			"id": c_userid,
			"username":c_username,
			"psw": c_psw,
			"rem": 1
		};
		$.ajax({
			url: 'api/common/Login.php',
			type: 'POST',
			data: postData,
			dataType: 'json',
			timeout: 10000,
			success: function(l)
			{
				if (l.authority == 1)//普通用戶
					window.location.href='mine/mine_fitbody.php';
			},
			error: function(er){}
		});
	}
	

	
	$("#username").focus();
	//输入框敲回车登录
	$("#username").bind("keydown",function(){
		if (event.keyCode==13) 
		{ 
			func_login();
			$("#loginbtn").focus();
		} 
	});
	$("#password").bind("keydown",function(){
		if (event.keyCode==13) 
		{ 
			func_login();
			$("#loginbtn").focus();
		} 
	});

	//绑定登录按钮
	$("#loginbtn").bind("click", function(){
		func_login();
	});
	
	function func_login()
	{
		//判断用户名密码
		var name = $("#username").val();
		var password = $("#password").val();
		if (name==""||password=="")
		{
			$(".errorinfo").css("visibility","visible");
			$(".errorinfo").html("用户名密码不能为空！");
		}
		else
			$(".errorinfo").css("visibility","hidden");
			
		var rem = "0";
		if ($(".checkbox").hasClass("active"))
			rem= "1";
		var postData = {
			"username": name,
			"psw": $.md5(password),
			"rem": rem
		};
		$.ajax({
			url: 'api/common/Login.php',
			type: 'POST',
			data: postData,
			dataType: 'json',
			timeout: 10000,
			success: function(l)
			{
				if ( l.result != 0 )
				{
					$(".errorinfo").css("visibility","visible");
					if (l.result == 1)
						$(".errorinfo").html("用户名密码不匹配！");
					else
						$(".errorinfo").html("不存在该用户！");
				}
				else{
					$(".errorinfo").css("visibility","hidden");
				}
				if (l.authority == 1)//
					window.location.href='mine/mine_fitbody.php';
			},
			error: function(er){}
		});
	}
	
	//绑定註冊按钮
	$("#registerbtn").bind("click", function()
	{
		window.location.href="register.php";
	});
});