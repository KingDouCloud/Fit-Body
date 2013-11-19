
$(document).ready(function(){

	$("#reg_birthday").val("1990-03-19");
	$("#reg_username").focus();
	/*$(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
		startView: 2,
		minView: 2,
        todayBtn: true,
		todayHighlight: true,
		language: 'CH_S',
        pickerPosition: "bottom-left"
    });*/
	

	//注册
	$("#reg_btn_register").live("click",function(ctl)
	{
		$("#reg_btn_register").html("正在努力……");
		document.getElementById('reg_btn_register').disabled = true;
		
		var username = $("#reg_username").val();
		var sexstr = $("#reg_sex").val();
		var email = $("#reg_email").val();
		var birthday = $("#reg_birthday").val();
		var psw = $("#reg_psw").val();
		var psw_md5 = $.md5(psw);
		var psw_conf = $("#reg_psw_conf").val();
		var psw_conf_md5 = $.md5(psw_conf);
		
		var all_needed = true;
		if(username == "")
		{
			all_needed = false;
			document.getElementById("reg_grp_username").className = "control-group error";
		}
		else
			document.getElementById("reg_grp_username").className = "control-group";
		if(sexstr == "")
		{
			all_needed = false;
			document.getElementById("reg_grp_sex").className = "control-group error";
		}
		else
			document.getElementById("reg_grp_sex").className = "control-group";
		if(email == "")
		{
			all_needed = false;
			document.getElementById("reg_grp_email").className = "control-group error";
		}
		else
			document.getElementById("reg_grp_email").className = "control-group";
		if(birthday == "")
		{
			all_needed = false;
			document.getElementById("reg_grp_birthday").className = "control-group error";
		}
		else
			document.getElementById("reg_grp_birthday").className = "control-group";
		if(psw == "")
		{
			all_needed = false;
			document.getElementById("reg_grp_psw").className = "control-group error";
		}
		else
			document.getElementById("reg_grp_psw").className = "control-group";
		if(psw_conf == "")
		{
			all_needed = false;
			document.getElementById("reg_grp_psw_conf").className = "control-group error";
		}
		else
			document.getElementById("reg_grp_psw_conf").className = "control-group";
			
		if(all_needed == false)
		{
			alert("红色标记项目为必填");
			return;
		}
		if(psw != psw_conf)
		{
			document.getElementById("reg_grp_psw").className = "control-group warning";
			document.getElementById("reg_grp_psw_conf").className = "control-group warning";
			alert("两次输入的密码必须一致");
			return;
		}
		
		var sex = 2;
		if(sexstr == "男")
			sex = 1;
		var postdata = {
			"username":username,
			"sex":sex,
			"email":email,
			"birthday":birthday,
			"psw":psw_md5
		};
		$("#reg_btn_register").html("注册");
		document.getElementById('reg_btn_register').disabled = false;
		$("#reg_btn_register").html("正在努力……");
		document.getElementById('reg_btn_register').disabled = true;
		$.ajax({
			url: 'api/common/register.php',
			type: 'POST',
			data: postdata,
			dataType: 'json',
			timeout: 10000,
			success: function(data)//成功獲取用戶已經存儲的數據
			{
				//alert(data.result);
				if(data.result == "failed")
				{
					alert("由于种种原因注册失败，请把注册页面截图发到514070192@qq.com邮箱。");
				}
				else
				{
					window.location.href="register_success.php?username="+username+'&email='+email;		
				}
				if(data.result == "success")
				{
					alert("注册成功，页面将跳转");
					window.location.href="register_success.php?username="+username+'&email='+email;					
				}
				$("#reg_btn_register").html("注册");
				document.getElementById('reg_btn_register').disabled = false;
			}
		});
		
		
	});
	
	//跳转登陆页面
	$("#reg_btn_login").live("click",function(ctl)
	{
		window.location.href="index.php";
	});
	
	//用户名输入完毕，检测用户名是否被占用
	$("#reg_username").live("blur",function(ctl)
	{
		if($("#reg_username").val() != "")
		{
			var postData = {
				"username": $("#reg_username").val()
			};
			$.ajax({
				url: 'api/common/username_only_check.php',
				type: 'POST',
				data: postData,
				dataType: 'json',
				timeout: 10000,
				success: function(data)//成功獲取用戶已經存儲的數據
				{
					document.getElementById("rg_tip_username").style.display="inline";		
					if(data.only == true)
					{
						document.getElementById("rg_tip_username").style.color = "green";
						document.getElementById("rg_tip_username").innerHTML = '<i class="icon-ok"></i>该用户名可用';
						
					}
					else
					{
						document.getElementById("rg_tip_username").style.color = "red";		
						document.getElementById("rg_tip_username").innerHTML = '<i class="icon-remove"></i>该用户名已被注册';
					}
				}
			});
		}
	});

	$("#reg_psw").live("blur",function(ctl)
	{
		fun_psw_check();
	});
	function fun_psw_check()
	{
		var psw = $("#reg_psw").val();
		var psw_conf = $("#reg_psw_conf").val();
		if(psw != "" && psw_conf != "")
		{
			document.getElementById("rg_tip_psw_conf").style.display="inline";	
			if(psw != psw_conf)
			{
				document.getElementById("rg_tip_psw_conf").style.color = "red";		
				document.getElementById("rg_tip_psw_conf").innerHTML = '<i class="icon-remove"></i>两次输入不一致';
			}
			else
			{
				document.getElementById("rg_tip_psw_conf").style.color = "green";		
				document.getElementById("rg_tip_psw_conf").innerHTML = '<i class="icon-ok"></i>正确';
			}
		}
	}
	$("#reg_psw_conf").live("blur",function(ctl)
	{
		fun_psw_check();
	});
	
	//邮箱输入完毕，检测邮箱是否被占用
	$("#reg_email").live("blur",function(ctl)
	{
		var email = $("#reg_email").val();
		if(email != "")
		{
			var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
			if(!myreg.test(email))
			{
				document.getElementById("rg_tip_email").style.display="inline";
				document.getElementById("rg_tip_email").style.color = "red";
				document.getElementById("rg_tip_email").innerHTML = '<i class="icon-remove"></i>邮箱格式不正确';		
			}
			else
			{
				document.getElementById("rg_tip_email").style.display="none";
				var postData = {
					"email": $("#reg_email").val()
				};
				$.ajax({
					url: 'api/common/email_only_check.php',
					type: 'POST',
					data: postData,
					dataType: 'json',
					timeout: 10000,
					success: function(data)//成功獲取用戶已經存儲的數據
					{
						document.getElementById("rg_tip_email").style.display="inline";		
						if(data.only == true)
						{
							document.getElementById("rg_tip_email").style.color = "green";
							document.getElementById("rg_tip_email").innerHTML = '<i class="icon-ok"></i>该邮箱可用';
							
						}
						else
						{
							document.getElementById("rg_tip_email").style.color = "red";		
							document.getElementById("rg_tip_email").innerHTML = '<i class="icon-remove"></i>该邮箱已被注册';
						}
					}
				});
			}
		}
	});
});