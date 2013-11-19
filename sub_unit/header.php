<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="/">Fit Body</a>					
			<ul class="nav" id="teacheronly">
				<!--<li class="menu active"><a href="http://msbit.sinaapp.com/tchmp/">论文指导</a></li>
				<li class="menu" id="syn_menu"><a href="http://msbit.sinaapp.com/syn/">论文盲审</a></li> -->
			</ul>
			<ul class="nav pull-right">
				<!--<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="nav_userifo">用户信息 
					<b class="caret"></b></a>
				 
					<ul class="dropdown-menu">
						<li><a href="#">另一个动作</a></li>
						<li class="divider"></li>
						<li><a data-toggle="modal" href="#myModal"  data-keyboard="false" data-backdrop="false" >
							修改个人信息
							</a>
						</li>
						<?php //include("pop_info.php");?>
						<li><a href="#">修改信息及密码</a></li>
						<li><a href="../api/common/Logout.php">退出登录</a></li>
                    </ul>-->
						
					<li>						
						<a id="btn_info_set" style="cursor:pointer">
						<i class="icon-user"></i>
						修改个人信息
						</a>
					</li>
					<li class="menu">
						<a href="../api/common/Logout.php">
						<i class="icon-off"></i>
						退出登录
						</a>
					</li>
				 
				</li>
          </ul>
		</div>
	</div>
</div>
		
	
<!--弹出个人信息框-->
<div id="set_info" class="modal hide fade" style="display: block;">
	<div class="modal-header">
		<a class="close" id="info_close" data-dismiss="modal">×</a>
		<h3>基本信息设置</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="pop_siname">用户名</label>
					<div class="controls">
						<input type="text" class="input-xlarge disabled" id="pop_username" value="用户名">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="pop_sisex">性别</label>
					<div class="controls">
						<input type="text" class="input-xlarge disabled" id="pop_sex" value="性别" disabled="disabled">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="pop_sibirthday">生日</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="pop_birthday" disabled="disabled">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="pop_siemail">电子邮箱</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="pop_email">
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<a class="btn" id="info_close_btn" data-dismiss="modal">关闭</a>
		<a class="btn primary" id="pop_userinfo_save">修改基本信息</a>
	</div>
	
	<div class="modal-header">
		<h3>密码修改</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="pop_psw_old">原密码</label>
					<div class="controls">
						<input type="password" class="input-xlarge disabled" id="pop_psw_old" value="">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="pop_psw_new">新密码</label>
					<div class="controls">
						<input type="password" class="input-xlarge disabled" id="pop_psw_new" value="">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="pop_psw_confirm">新密码确认</label>
					<div class="controls">
						<input type="password"  class="input-xlarge" id="pop_psw_confirm" value="">
					</div>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<a class="btn" id="info_close_btn" data-dismiss="modal">关闭</a>
		<a class="btn primary" id="pop_psw_save">修改密码</a>
	</div>	
</div>

	
	<script type="text/javascript">
//弹出记录数据面板
	$("#btn_info_set").live("click",function(ctl)
	{
		$("#set_info").modal()
	});
	</script>