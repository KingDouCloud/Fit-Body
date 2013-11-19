
	var c_userid; 
	var c_username;
	var c_psw;
	var c_authority;
	var array_items;//用户的监测项目数组
	var selected_item;
	var pop_model;//pop弹窗当前的模式
	
$(document).ready(function(){

	//檢測是不是已經有cookie了，如果有了就檢測存的cookie對不對，對的話直接跳轉
	var strCookie=document.cookie; 
	//将多cookie切割为多个名/值对 
	var arrCookie=strCookie.split("; "); 
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
	}
	else//没有cookie了，退出到登陆页面
		window.location.href='../';
		
		
	func_refresh_items();
	//获取并显示用户选择的项目
	function func_refresh_items()
	{
		//获取用户选择的项目
		var postData = {
			"id": c_userid
		};
		$.ajax({
			url: '../api/mine/get_mine_items.php',
			type: 'POST',
			data: postData,
			dataType: 'json',
			timeout: 10000,
			success: function(data)//成功獲取用戶已經存儲的數據
			{
				array_items = data;//先存到全局变量里
				var html = "";	
				
				for(var i=0;i<data.length;i++)
				{
					html += "<tr>";
					html += "<td>"+(i+1)+"</td>";
					html += "<td>"+data[i].itemname+"</td>";
					html += "<td>"+data[i].unit+"</td>";
					html += "<td>"+data[i].goal[data[i].goal.length-1].time+"</td>";
					html += "<td>"+data[i].goal[data[i].goal.length-1].goalcount+"</td>";
					html += "<td>"+1+"</td>";
					html += "<td><div class=\"btn btn-info btn_items_newgoal\" id=\"btn_items_newgoal_"+data[i].itemid+"\"><i class=\"icon-flag icon-white\"></i></div></td>";
					html += "<td><div class=\"btn btn-warning btn_items_update\" id=\"btn_items_update_"+data[i].itemid+"\"><i class=\"icon-pencil icon-white\"></i></div></td>";
					html += "<td><div class=\"btn btn-danger btn_items_delete\" id=\"btn_items_delete_"+data[i].itemid+"\"><i class=\"icon-remove icon-white\"></i></div></td>";
					html += "</tr>";
					
				}
				
				$("#tb_items").html(html);
			},
			error: function(er){}
		});
	}
		
	//设定项目新目标
	$(".btn_items_newgoal").live("click",function(ctl)
	{
		var obj = ctl.currentTarget;
		id = obj.id;
		idss = id.split("_");
		itemid = idss[idss.length-1];
		selected_item = itemid;
		index = -1;
		for(var i=0;i<array_items.length;i++)
			if(array_items[i].itemid==itemid)
				index = i;
		pop_model="newgoal";//设定弹窗模式是新目标
		$("#pop_header").html("设定新目标");
		$("#pop_item_name").val(array_items[index].itemname);
		$("#pop_item_unit").val(array_items[index].unit);
		document.getElementById("pop_item_name").disabled=true;
		document.getElementById("pop_item_unit").disabled=true;
		document.getElementById("pop_item_name_tip").style.display="none" ;
		document.getElementById("pop_item_unit_tip").style.display="none" ;
		document.getElementById("pop_item_goal_tip").style.display="none" ;
		document.getElementById("pop_item_result_tip").style.display="none" ;
		$("#pop_add_item").modal();
	});
	//修改项目
	$(".btn_items_update").live("click",function(ctl)
	{
		var obj = ctl.currentTarget;
		id = obj.id;
		idss = id.split("_");
		itemid = idss[idss.length-1];
		pop_model="update";//设定弹窗模式是修改项目
		alert("別點了，點了也沒用，這個功能沒做");
	});
	//根據項目id獲取項目名稱
	function func_get_itemname_by_id( id)
	{
		for(var i=0;i<array_items.length;i++)
		{
			if(array_items[i].itemid == id)
			{
				return array_items[i].itemname;
			}
		}
	}
	//删除项目
	$(".btn_items_delete").live("click",function(ctl)
	{	
		var obj = ctl.currentTarget;
		id = obj.id;
		idss = id.split("_");
		itemid = idss[idss.length-1];
		var itemname = func_get_itemname_by_id(itemid);
		
		var res = window.confirm('确认删除项目："'+itemname+'" ?')
		if (res) 
		{ 
			var postData = {
				"user_id": c_userid,
				"item_id":itemid
			};
			$.ajax({
				url: '../api/mine/delete_item.php',
				type: 'POST',
				data: postData,
				dataType: 'json',
				timeout: 10000,
				success: function(data)//成功獲取用戶已經存儲的數據
				{
					if(data.result==true)//删除成功
					{
						func_refresh_items();//刷新用户选择的项目	
					}
				}
			});
		}
	});
	
	//添加新项目
	$("#btn_item_add").live("click",function(ctl)
	{
		$("#pop_header").html("添加新监测项目");
		pop_model="newitem";//设定弹窗模式是新项目
		$("#pop_add_item").modal();
	});
	
	//保存添加的項目
	$("#item_add_save_btn").live("click",function(ctl)
	{
		$item_name = $("#pop_item_name").val().trim();
		$item_unit = $("#pop_item_unit").val().trim();
		$goal = $("#pop_item_goal").val().trim();
		$content = $("#pop_item_content").val().trim();
		
		var flag = true;
		document.getElementById("pop_item_name_tip").style.display="none" ;
		document.getElementById("pop_item_unit_tip").style.display="none" ;
		if($item_name=="")
		{
			document.getElementById("pop_item_name_tip").style.display="inline" ;
			$("#pop_item_name_tip").html("需要输入数据");
			flag = false;
		}
		if($item_unit=="")
		{
			document.getElementById("pop_item_unit_tip").style.display="inline" ;
			$("#pop_item_unit_tip").html("需要输入数据");
			flag = false;
		}
		
		if(flag==true)//必須所有的項目都填寫了
		{
			var postData = {
				"user_id": c_userid,
				"item_name":$item_name,
				"item_unit":$item_unit,
				"goal":$goal,
				"content":$content
			};
			$.ajax({
				url: '../api/mine/add_item.php',
				type: 'POST',
				data: postData,
				dataType: 'json',
				timeout: 10000,
				success: function(data)
				{
					if(data.result == true)//添加成功
					{					
						$("#pop_item_name").val("");
						$("#pop_item_unit").val("");	
						$("#pop_item_goal").val("");	
						$("#pop_item_content").val("");	
						document.getElementById("pop_item_add_sucess").style.display="inline" ;
						setTimeout(function()
						{								
							$('#pop_add_item').modal('hide');
							document.getElementById("pop_item_add_sucess").style.display="none" ;
						}, 1000);
						func_refresh_items();//刷新用户选择的项目					
					}
				}
			});
		}
	});
	
});