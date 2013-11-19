<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8">		
		<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="../css/footer.css" type="text/css" />
		<link rel="stylesheet" href="../css/index.css" type="text/css" />
		<link rel="stylesheet" href="../css/doc.css" type="text/css" />
		<link rel="stylesheet" href="../css/datetimepicker.css" media="screen">
		<script src="../js/jquery-1.8.1.js"></script>
		<script src="../js/jquery.md5.js"></script>
		<script src="../js/footer_header.js"></script>
		<script src="../js/authority_check.js"></script>
		<script src="../js/bootstrap-dropdown.js"></script><!--这个实现导航条下拉菜单功能-->
		<script src="../js/bootstrap-modal.js"></script><!--这个实现弹出对话框的功能-->
		<script src="../js/bootstrap-transition.js"></script><!--这个实现弹出对话框的渐变消失功能-->
		<script src="../js/bootstrap-tab.js"></script><!--这个实现標籤頁-->
		<script src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script><!--这个日曆控件-->
		<script src="../js/bootstrap-datetimepicker.CH_S.js" charset="UTF-8"></script>
		<script src="../js/user_info.js"></script>
		<script src="../js/page_mine_fitbody.js"></script>
    <title>Fit Body</title>
	</head>
	<body>
		<?php include("../sub_unit/header.php");?>
	
	
	<div class="container mpcontain" id="main">
	
	
		<div class="my_item_header">
			<span class="my_item_title">我的监测项目</span>
			<div style="float:right">		
				<a class="btn btn-primary" id="btn_record_pop" >
					<i class="icon-edit"></i> 记录今日数据
				</a>				
				<!--<a class="btn btn-success" id="">
					<i class="icon-plus-sign "></i> 添加新监测项目
				</a>-->
				<a class="btn btn-small btn-info" href="mine_items.php">
					<i class="icon-cog icon-white"></i> 管理监测项目
				</a>
			</div>
		</div>
				
				
				
				
				
		
<!--弹出数据记录窗体-->
<div id="pop_record"  class="modal hide fade" style="display: none;">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>记录今日数据</h3>
  </div>
  <div class="modal-body">
    
	<div class="input-prepend"style="margin-left: 15%;">
		<span class="add-on">项目：</span>
		<select class="span2"  id="record_items" >
			<option></option>
		</select>
	</div>
	<div class="input-prepend input-append" style="margin-left: 15%;">
		<span class="add-on">记录数据：</span>
			<input class="span2" id="record_count" size="16" type="text">
		<span class="add-on" id="item_unit">单位</span>
		<span class="label label-important" id="record_need_data" style="display:none">需要输入数据</span>
	</div>
	<p style="margin-left: 15%;">说点什么吧(可不填写)：</p>
	<textarea class="input-xlarge" id="record_content" style="margin-left: 15%; height: 130px; width: 70%;"></textarea>
	<span class="label label-success" id="record_sucess" style="margin-left: 35%; display:none"><font size="2.5">数据保存成功</font></span>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" id="record_close_btn">关闭</a>
    <a href="#" class="btn btn-primary" id="record_save_btn">保存</a>
  </div>
</div>
		

		
		<div class="my_item_view_option">
				<span style="float:right" class="input-append date form_datetime" id="time_end">
					<input size="10" type="text" id="txt_time_end">
					<span class="add-on"><i class="icon-th"></i></span>
				</span>	
				<span style="float:right">截止时间：</span>
				<span style="float:right" class="input-append date form_datetime" id="time_start">
					<input size="10" type="text" id="txt_time_start">
					<span class="add-on"><i class="icon-th"></i></span>
				</span>
				<span style="float:right">起始时间：</span>
				</br>
		</div>
		<br>
		
		
	<div id="chart_container" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
		
			
			
		
		<hr class="soften">
		<div class="mpfooter">
		<?
            date_default_timezone_set('PRC');
			echo date('Y-m-d H:i:s',time());
		 ?>
		 </div>
		 
	</div>
	

	</body>
	
	
	<script type="text/javascript">
    </script>
	
<script src="../js/HighCharts/highcharts.js"></script>
<script src="../js/HighCharts/exporting.js"></script>

</html>