
	var c_userid; 
	var c_username;
	var c_psw;
	var c_authority;
	var current_item_id = 3;//当前选中的itemid
	var array_items;//用户的监测项目数组
	
$(document).ready(function(){
    
	 $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
		startView: 2,
		minView: 2,
        todayBtn: true,
		todayHighlight: true,
		language: 'CH_S',
        pickerPosition: "bottom-left"
    });
	
	
	//設置起始和截止時間
	{
		var myDate = new Date();
		var date1 = "";
		yy = myDate.getFullYear();
		mm = myDate.getMonth();
		dd = myDate.getDate();
		date1 += yy;    //获取完整的年份(4位,1970-????)
		date1 += "-"+(mm+1);       //获取当前月份(0-11,0代表1月)
		date1 += "-"+dd;        //获取当前日(1-31)
		date2 = date2str(yy, mm, dd, 30);
		$("#txt_time_end").val(date1);
		$("#txt_time_start").val(date2);
	}
	
	//计算给定日期前的N天
	function date2str(yy, mm, dd, n) {
		var s, d, t, t2;
		t = Date.UTC(yy, mm, dd);
		t2 = n * 1000 * 3600 * 24;
		t -= t2;
		d = new Date(t);
		s = d.getUTCFullYear() + "-";
		s += ("00"+(d.getUTCMonth()+1)).slice(-2) + "-";
		s += ("00"+d.getUTCDate()).slice(-2);
		return s;
	}

	

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
			var html_items = "";		
			for(var i=0;i<data.length;i++)//遍歷每一個item，生成tab头
			{
				html_items += "<option>"+data[i].itemname+"</option>";
				if(i==0)
					$("#item_unit").html(data[i].unit);
			}
			
			
			$("#record_items").html(html_items);
		},
		error: function(er){}
	});
	
	//弹出记录数据面板
	$("#btn_record_pop").live("click",function(ctl)
	{
		$("#pop_record").modal();
	});	
	//改变添加记录弹窗里面的选中项
	$("#record_items").change(function()
	{
		var obj = document.getElementById("record_items");
		var index = obj.selectedIndex;
		$("#item_unit").html(array_items[index].unit);
	});
	//记录当前数据
	$("#record_save_btn").live("click",function()
	{
		var obj = document.getElementById("record_items");
		var index = obj.selectedIndex;
		var user_id = c_userid;
		var psw = c_psw;
		var item_id = array_items[index].itemid;
		var count = $("#record_count").val().trim();
		var content = $("#record_content").val().trim();
		if(isNaN(count))//数据不是数字
		{
			document.getElementById("record_need_data").style.display="inline" ;
			$("#record_need_data").html("必须是数字");
		}
		else
		{
			if(count == "")//记录数据不能为空
			{
				document.getElementById("record_need_data").style.display="inline" ;
				$("#record_need_data").html("需要输入数据");
			}
			else
			{
				document.getElementById("record_need_data").style.display="none" ;
				var postData = 
				{
					"user_id":user_id,
					"psw":psw,
					"item_id":item_id,
					"count":count,
					"content":content
				};
				$.ajax({
						url: '../api/mine/record.php',
						type: 'POST',
						data: postData,
						dataType: 'json',
						timeout: 10000,
						success: function(l)//成功獲取用戶已經存儲的數據
						{
							if(l.result == true)//保存数据成功
							{
								$("#record_count").val("");
								$("#record_content").val("");	
								document.getElementById("record_sucess").style.display="inline" ;
								add_series();//刷新图表
								setTimeout(function()
								{								
									$('#pop_record').modal('hide');
									document.getElementById("record_sucess").style.display="none" ;
								}, 1000);
							}
							if(l.result == false)//保存数据失败
								alert("数据录入失败："+l.excetion);
							//$(item_panel_id).html("");
						}
				});
			}
		}
	});
	
	
	add_series();
	
	function add_series()
	{
		var postData = {
			"user_id": c_userid,
			"start_time":0,
			"end_time":0
		};
		$.ajax({
			url: '../api/mine/get_record_all.php',
			type: 'POST',
			data: postData,
			dataType: 'json',
			timeout: 10000,
			success: function(data1)//成功獲取用戶已經存儲的數據
			{
				var chart = $('#chart_container').highcharts();
				var test = Date.UTC(2013, 6, 16);
				for(i=0;i<data1.length;i++)
				{
					chart.addSeries({
						data: data1[i].data,
						//xAxis: {categories:data1[i].time},
						name: data1[i].itemname
					});
				}

			},
			error: function(er){}
		});
	};
	
	
	
	$(function () {
		
        $('#chart_container').highcharts({
		
		chart: {
                type: 'spline'
            },
            title: {
                text: c_username+'的圖表'
            },
            subtitle: {
                text: 'Graphic powered by: Highcharts.com'
            },
			legend: {
                align: 'center',
                verticalAlign: 'top',
                y: 37,
                floating: false,
                borderWidth: 1
            },
			xAxis: {
				title: {
					text :"时间",
				},
				type: 'datetime',
				labels: {
					rotation: 300,
					y:40
				},
				dateTimeLabelFormats: {
					//second: '%H:%M:%S',
					//day: '%e. %b',
					//month: '%e. %b',
					//day: '%Y-%b-%e %H:%M:%S'
					day: '%Y.%b.%e'
                    //year: '%b'
				}
			},
            yAxis: {
				type: 'logarithmic',
				minorTickInterval: 'auto',
                title: {
                    text: ''
                },
                labels: {
                    formatter: function() {
                        return this.value +''
                    }
                }
            },
            tooltip: {
				xDateFormat: '%Y.%m.%d  %H:%M:%S',//显示时间格式
                crosshairs: true,//显示垂直线
                shared: true,//所有曲线公用一个提示框				
				valuePrefix: '$',//数据显示前缀
				valueSuffix: ' 千克'//数据显示后缀
            },
            plotOptions: {
				series: {
					dataLabels: {
						enabled: true//是否在数据点显示数据
					}
				},
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
       /* series: [{
            data: [
                [Date.UTC(2010, 0, 1), 29.9],
                [Date.UTC(2010, 0, 2), 71.5],
                [Date.UTC(2010, 0, 3), 106.4],
                [Date.UTC(2010, 0, 6), 129.2],
                [Date.UTC(2010, 0, 7), 144.0],
                [Date.UTC(2010, 0, 8), 176.0]
             ]
        }]*/

		});
    });
	
	
	
});