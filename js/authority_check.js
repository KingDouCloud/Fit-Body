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
			"psw": c_psw,
			"authority": 1
		};
		$.ajax({
			url: '../api/common/Authority_check.php',
			type: 'POST',
			data: postData,
			dataType: 'json',
			timeout: 1000,
			success: function(l)
			{
				if (l.access == false)//验证失败
					window.location.href='../';
			},
			error: function(er){}
		});
	}
	else//不存在cookie，跳转回登陆页面
	{
		window.location.href='../';
	}
});