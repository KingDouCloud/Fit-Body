<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8">		
		<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="../css/footer.css" type="text/css" />
		<link rel="stylesheet" href="../css/index.css" type="text/css" />
		<link rel="stylesheet" href="../css/doc.css" type="text/css" />
		<script src="../js/jquery-1.8.1.js"></script>
		<script src="../js/jquery.md5.js"></script>
		<script src="../js/bootstrap-modal.js"></script><!--这个实现弹出对话框的功能-->
		<script src="../js/bootstrap-transition.js"></script><!--这个实现弹出对话框的渐变消失功能-->
		<script src="../js/footer_header.js"></script>
		<script src="../js/user_info.js"></script>
		<script src="../js/authority_check.js"></script>
		<script src="../js/page_mine_item.js"></script>
    <title>Fit Body</title>
	</head>
	<body>
		<?php include("../sub_unit/header.php");?>
	
	
	<div class="container mpcontain" id="main">
	
	<ul class="breadcrumb">
        <li><a href="mine_fitbody.php">首页</a> <span class="divider">/</span></li>
        <li class="active">监测项目管理</li>
      </ul>
	
		<div class="my_item_header">
			<span class="my_item_title">监测项目管理</span>
			<div style="float:right">
				<div class="btn btn-success" id="btn_item_add">
					<i class="icon-plus-sign "></i> 添加新监测项目
				</div>
				<!--<div class="btn btn-small btn-info" href="mine_items.php">
					<i class="icon-cog icon-white"></i> 管理监测项目
				</div>-->
			</div>
		</div>
		
		<table class="table table-striped table-bordered table-condensed">
	        <thead>
          <tr>
            <th>#</th>
            <th>项目名称</th>
            <th>单位</th>
            <th>添加时间</th>
            <th>最新目标</th>
            <th>历次目标</th>
            <th>设定新目标</th>
            <th>修改</th>
            <th>删除</th>
          </tr>
        </thead>
        <tbody id="tb_items">
        </tbody>
      </table>

		
		
<!--弹出数据记录窗体-->
<div id="pop_add_item"  class="modal hide fade" style="display: none;">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3 id="pop_header">添加监测项目</h3>
  </div>
  <div class="modal-body">
    
	<div class="input-prepend" style="margin-left: 15%;">
		<span class="add-on">项目名称：</span>
		<input class="span2" size="16" type="text" id="pop_item_name" ></input>
		<span class="label label-important" id="pop_item_name_tip" style="display:none">需要输入数据</span>
	</div>
	<div class="input-prepend" style="margin-left: 15%;">
		<span class="add-on">单&nbsp位：</span>
		<input class="span2" size="16" type="text" id="pop_item_unit" ></input>
		<span class="label label-important" id="pop_item_unit_tip" style="display:none">需要输入数据</span>
	</div>
	<div class="input-prepend" style="margin-left: 15%;">
		<span class="add-on">目&nbsp标：</span>
		<input class="span2" size="16" type="text" id="pop_item_goal" ></input>
		<span class="label label-info" id="pop_item_goal_tip" style="display:inline">来日方长，可以以后再写</span>
	</div>
	<p style="margin-left: 15%;">备注(可不填写)：</p>
	<textarea class="input-xlarge" id="pop_item_content" style="margin-left: 15%; height: 130px; width: 70%;"></textarea>
	<span class="label label-success" id="pop_item_result_tip" style="margin-left: 35%; display:none"><font size="2.5">数据保存成功</font></span>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" id="record_close_btn">关闭</a>
    <a href="#" class="btn btn-primary" id="item_add_save_btn">保存</a>
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