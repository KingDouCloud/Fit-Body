$(document).ready(function(){
	
	//檢測是不是已經有cookie了，如果有了就檢測存的cookie對不對，對的話直接跳轉
	var strCookie=document.cookie; 
	//将多cookie切割为多个名/值对 
	var arrCookie=strCookie.split("; "); 
	var c_userid; 
	var c_username;
	var c_psw;
	var c_authority;
	var c_email;
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
		//获取用户基本信息
		var postData = {
			"id": c_userid,
			"psw": c_psw,
			"rem": 1
		};
		$.ajax({
			url: '../api/mine/get_userinfo.php',
			type: 'POST',
			data: postData,
			dataType: 'json',
			timeout: 10000,
			success: function(l)
			{
				$("#pop_username").val(l.username);
				if(l.sex == 1)
					$("#pop_sex").val("男");
				else
					$("#pop_sex").val("女");
				$("#pop_birthday").val(l.birthday);
				$("#pop_email").val(l.email);
				c_email = l.email;
			},
			error: function(er){}
		});
	}
	else//没有cookie了，退出到登陆页面
		window.location.href='../';
	
	
	//用戶名輸入框失去焦點時，檢測用戶名是否可用
	$("#pop_username").blur(function()
	{
        var username_check = $("#pop_username").val();
		if(username_check != c_username)//如果新修改的用户名和原用户名不一致则检验用户名的唯一性
		{				
			var postData = {
				"username": username_check,
				"userid":c_userid
			};
			$.ajax({
				url: '../api/common/username_only_check_with_id.php',
				type: 'POST',
				data: postData,
				dataType: 'json',
				timeout: 10000,
				success: function(l)
				{
					if(l.only == true)
						;
					else
						alert(c_username+"用户名重了"+username_check);
				}
			});
		}
    });
	
	//修改用户信息
	$("#pop_userinfo_save").bind("click", function(){
		var username = $("#pop_username").val();
		var email = $("#pop_email").val();
		
		if(c_email == email && username == c_username)
			alert("当前没有修改");
		else
		{					
			var postData = {
				"userid":c_userid,
				"username": username,
				"email":email
			};
			$.ajax({
				url: '../api/common/change_userinfo.php',
				type: 'POST',
				data: postData,
				dataType: 'json',
				timeout: 10000,
				success: function(l)
				{
					if(l.success == true)
					{
						if(c_username != $("#pop_username").val())
						{
							alert("修改成功,用户名有改变，需要重新登录");
							window.location.href='../';//跳转回登陆界面重新登录
						}
						else
							alert("修改成功");
					}
					else
						alert("修改失败");
				}
			});
		}
	});
	
	//修改密码
	$("#pop_psw_save").bind("click", function(){		
		var psw_old = $("#pop_psw_old").val();	
		var psw_new = $("#pop_psw_new").val();	
		var psw_conf = $("#pop_psw_confirm").val();
		if(psw_new != psw_conf)//兩次新密碼不正確
		{
			alert("两次输入的密码不一致");
		}
		else//兩次新密碼正確
		{			
			var postData = {
				"id": c_userid,
				"psw_old": $.md5(psw_old),
				"psw_new": $.md5(psw_new)
			};
			$.ajax({
				url: '../api/common/change_psw.php',
				type: 'POST',
				data: postData,
				dataType: 'json',
				timeout: 10000,
				success: function(l)
				{
					//alert(l.success);
					if(l.success == "true")//修改成功
					{
						alert("修改成功,需要重新登录");
						window.location.href='../';//跳转回登陆界面重新登录
					}
					else//修改失败
						alert("原密码错误");
				}
			});
		}
	});
	
});