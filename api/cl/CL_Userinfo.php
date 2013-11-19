<?php
  //session_start();
  ob_start();
  
class User_info
{	
	//private $debug_localhost = "app_fitbody.";//本地调试时使用
	private $debug_localhost = "";//上传到sae时使用
	
	
	//查詢登錄表tb_login中指定userid的所有字段
	private function db_select($userid)
	{
		require("../../db/connect.php");
		$str = "select cl_username,cl_sex,cl_birthday,cl_email from ".$this->debug_localhost."tb_userinfo where cl_userid='".$userid."'";
		$sqlclass = mysql_query($str,$conn);
		if($sqlclass)
			$result = mysql_fetch_array($sqlclass);
		else
			return $str;
		require("../../db/connect_close.php");
		return $result;
	}
	
	//登錄操作，返回userid,psw,authority,result。
	//result：0-登陸成功；1-密碼錯誤；2-無此用戶
	public function func_get_info($userid)
	{		
		$result = $this->db_select($userid);//查詢這個用戶的信息
		
 		if($result[0])//如果查找出來的結果不為空
		{
			$username = $result[0];
			$sex = $result[1];
			$birthday = $result[2];
			$email = $result[3];
			$array["username"] = $username;
			$array["sex"] = $sex;
			$array["birthday"] = $birthday;
			$array["email"] = $email;
			//$array["all"] = $result;
			return $array;	
		}		
	}
	
	//修改用户名和email
	public function func_set_info($userid,$username,$email)
	{
		require("../../db/connect.php");
		$str = "update ".$this->debug_localhost."tb_userinfo set cl_username='".$username."', cl_email='".$email."' where cl_userid='".$userid."'";
		//return $str;
		$sqlclass = mysql_query($str,$conn);
		if($sqlclass)
			$array["success"]=true;
		else
			$array["success"]=false;
		require("../../db/connect_close.php");
		return $array;		
	}
	
	public function func_get_mine_items($userid)
	{
		require("../../db/connect.php");
		//先獲取這個用戶所有的itemid和itemname
		$str = "select ";
		$str .= "".$this->debug_localhost."tb_useritems.cl_itemid,";
		$str .= "".$this->debug_localhost."tb_items.cl_itemname,";
		$str .= "".$this->debug_localhost."tb_items.cl_itemunit,";
		$str .= "cl_time,";
		$str .= "cl_goal_count,";
		$str .= "cl_content";  
		$str .= " from ".$this->debug_localhost."tb_useritems, ".$this->debug_localhost."tb_items ";
		$str .= " where cl_userid = '".$userid."'";
		$str .= " and ".$this->debug_localhost."tb_useritems.cl_itemid = ".$this->debug_localhost."tb_items.cl_itemid";
		$str .= " order by cl_time";

		//return $str;
		$sqlclass = mysql_query($str,$conn);
		if($sqlclass)
		{
			while($row = mysql_fetch_row($sqlclass))
			{
				$index = -1;
				$itemid = $row[0];
				$itemname = $row[1];
				$unit = $row[2];
				$time = $row[3];
				$goalcount = $row[4];
				$content = $row[5];
				//先检测这个itemid项目在数组里面是不是已经存在了
				for($j=0;$j<count($array);$j++)
				{
					if($array[$j]["itemid"] == $itemid)//找到了数组里面已存在
					{
						$index = $j;
						break;
					}
				}
				if($index != -1)//不等于-1说明这个item已经存在了
				{
					$temparray = $array[$index]["goal"];
					$count1 = count($temparray);
					$array[$index]["itemid"] = $itemid;
					$array[$index]["itemname"] = $itemname;
					$array[$index]["unit"] = $unit;
					$array[$index]["goal"][$count1]["time"] = $time;
					$array[$index]["goal"][$count1]["goalcount"] = $goalcount;
					$array[$index]["goal"][$count1]["content"] = $content;
					
				}
				else//这个item还不存在
				{
					$index = count($array);
					$array[$index]["itemid"] = $itemid;
					$array[$index]["itemname"] = $itemname;
					$array[$index]["unit"] = $unit;
					$array[$index]["goal"][0]["time"] = $time;
					$array[$index]["goal"][0]["goalcount"] = $goalcount;
					$array[$index]["goal"][0]["content"] = $content;
				}
			}
		}
		else
		{
			$array["result"] = "false";
		}
		require("../../db/connect_close.php");	
		return $array;			
	}
	
	//獲取指定用戶的指定item在指定時間段裏面
	public function func_get_record($userid,$itemid,$start_time,$end_time)
	{
		require("../../db/connect.php");
		
		//獲取數據記錄
		$str = "USE `fitbody`;";
		$str .= "select cl_time,cl_count,cl_content ";
		$str .= "from ".$this->debug_localhost."tb_record ";
		$str .= "where cl_userid = '".$userid."'";
		$str .= "and cl_itemid = '".$itemid."' ";
		if($start_time !=0 && $end_time != 0)
			$str .= "and cl_time between'".$start_time."' and '".$end_time."'";
		$str .= "order by cl_time";		
		$sqlclass = mysql_query($str,$conn);
		$i = 0;
		while($row = mysql_fetch_row($sqlclass))
		{
			$array["record"][$i]["time"] = $row[0];
			$array["record"][$i]["count"] = $row[1];
			$array["record"][$i]["content"] = $row[2];
			$i++;
		}
		
			//獲取數據記錄
		/*$str = "USE `fitbody`;";
		$str .= "select cl_time,cl_count,cl_group ";
		$str .= "from tb_record ";
		$str .= "where cl_userid = '".$userid."'";
		$str .= "and cl_itemid = '".$itemid."' ";
		if($start_time !=0 && $end_time != 0)
			$str .= "and cl_time between'".$start_time."' and '".$end_time."'";
		$str .= "order by cl_time";		
		$sqlclass = mysql_query($str,$conn);
		$i = 0;
		while($row = mysql_fetch_row($sqlclass))
		{
			$array["record"][$i]["time"] = $row[0];
			$array["record"][$i]["count"] = $row[1];
			$array["record"][$i]["content"] = $row[2];
			$i++;
		}*/
			
		require("../../db/connect_close.php");
		return $array;
		
	}
	
		
	//獲取指定用戶的指定item在指定時間段裏面
	public function func_get_record_all($userid,$start_time,$end_time)
	{
		require("../../db/connect.php");
		
		//獲取數據記錄
		$str = "select ";
		$str .= "".$this->debug_localhost."tb_items.cl_itemname,";
		$str .= "".$this->debug_localhost."tb_items.cl_itemunit,";
		$str .= "".$this->debug_localhost."tb_record.cl_itemid, ";
		$str .= "".$this->debug_localhost."tb_record.cl_time, ";
		$str .= "".$this->debug_localhost."tb_record.cl_count, ";
		$str .= "".$this->debug_localhost."tb_record.cl_content ";
		$str .= "from ".$this->debug_localhost."tb_record,".$this->debug_localhost."tb_items ";
		$str .= "where cl_userid = '".$userid."' ";
		$str .= "and ".$this->debug_localhost."tb_record.cl_itemid = ".$this->debug_localhost."tb_items.cl_itemid ";
		if($start_time != 0 && $end_time != 0)
			$str .= "and cl_time between'".$start_time."' and '".$end_time."'";
		$str .= "order by cl_time";		
		$sqlclass = mysql_query($str,$conn);
		
		if($sqlclass)
		{
			
			while($row = mysql_fetch_row($sqlclass))
			{
				$itemname = $row[0];
				$itemunit = $row[1];
				$itemid = $row[2];
				
				$time = $row[3];
				$count = $row[4];
				$content = $row[5];
				$index_ex = -1;
				for($i=0; $i<count($array); $i++)//先判斷是不是已經有這個記錄了
				{
					if($array[$i]["itemid"]==$itemid)//找到了
					{
						$index_ex = $i;
						break;
					}
				}
				if($index_ex== -1)//這個item還沒出現過
				{
					$j = count($array);
					$array[$j]["itemname"] = $itemname;
					$array[$j]["itemunit"] = $itemunit;
					$array[$j]["itemid"] = $itemid;
					$array[$j]["data"][0]["time"] = $time;
					$array[$j]["data"][0]["count"] = $count;
					$array[$j]["data"][0]["content"] = $content;
				}
				else//這個item已經出現了
				{
					$j = count($array[$index_ex]["data"]);
					$array[$index_ex]["data"][$j]["time"] = $time;
					$array[$index_ex]["data"][$j]["count"] = $count;
					$array[$index_ex]["data"][$j]["content"] = $content;				
				}
			}
			
		}
		else
		{
			//$array["sql"] = $str;
		}
		require("../../db/connect_close.php");
		return $array;
		
	}
	
	//記錄數據，無返回結果
	public function func_record($userid,$itemid,$time,$count,$content)
	{
		require("../../db/connect.php");
		$str = "insert into ".$this->debug_localhost."tb_record ";
		$str .= "value('".$userid."','".$itemid."','".$time."','".$count."','".$content."')";
		$sqlclass = mysql_query($str,$conn);
		require("../../db/connect_close.php");
		return $sqlclass;
		//return $str;
	}
	
	//添加監測項目
	public function func_add_item($userid,$item_name,$item_unit,$goal,$content)
	{
		require("../../db/connect.php");
		$str = "select cl_itemid ";
		$str .= "from ".$this->debug_localhost."tb_items ";
		$str .= "where ";
		$str .= "cl_itemname = '".$item_name."' ";
		$str .= "and cl_itemunit = '".$item_unit."' ";
		$sqlclass = mysql_query($str,$conn);
		$itemid = null;//項目id
		//$array["sql1"] = $str;
		if($sqlclass)
		{
			$row = mysql_fetch_row($sqlclass);
			$itemid = $row[0];
		}
		
		if($itemid != null)//找到記錄
		{
			//$array["find"] = $itemid;
		}
		else//沒有找到記錄,需要新建立一個item
		{
			//先找到數據庫裏面最大的itemid
			$str = "select max(cl_itemid) ";
			$str .= "from ".$this->debug_localhost."tb_items ";
			$sqlclass = mysql_query($str,$conn);
			if($sqlclass)
			{
				$row = mysql_fetch_row($sqlclass);
				$itemid = $row[0]+1;
				//$array["new"] = $itemid;
			}
			else//數據查找失敗
			{
				$array["result"] = false;
				return $array;
			}
			
			//插入一個新的item			
			$str = "insert into ".$this->debug_localhost."tb_items ";
			$str .= "values('".$itemid."','".$item_name."','".$item_unit."')";
			$sqlclass = mysql_query($str,$conn);
			//$array["new_sql"] = $str;
			if(!$sqlclass)//數據插入失敗
			{
				$array["result"] = false;
				return $array;
			}
		}
		
		//再在用戶項目表里插入記錄
		$time = date("Y-m-d H:i:s");
		if($goal ==""||$goal==null)
		{
			$str = "insert into ".$this->debug_localhost."tb_useritems (cl_userid,cl_itemid,cl_time,cl_content) ";
			$str .= "values('".$userid."','".$itemid."','".$time."','".$content."')";
		}
		else
		{
			$str = "insert into ".$this->debug_localhost."tb_useritems ";
			$str .= "values('".$userid."','".$itemid."','".$time."','".$goal."','".$content."')";
		}
		$sqlclass = mysql_query($str,$conn);
		//$array["insert_sql"] = $str;
		if($sqlclass)
		{
			$array["result"] = true;
			return $array;
		}
		else
		{
			$array["result"] = false;
			return $array;
		}
			
		require("../../db/connect_close.php");		
	}

	//删除用户的项目
	public function func_delete_item($userid,$itemid)
	{
		require("../../db/connect.php");
		//先看看有没有别的用户共用这个item
		$str = "select cl_userid from ".$this->debug_localhost."tb_useritems where cl_itemid='".$itemid."' and cl_userid !='".$userid."'";
		$sqlclass = mysql_query($str,$conn);
		$flag = false;
		if($sqlclass)
		{
			$result = mysql_fetch_array($sqlclass);
			if(!$result[0])//没有搜索结果
				$flag = false;
			else//有别的用户使用着这个项目
				$flag = true;
		}
		
		//删除用户记录
		$str = "delete from ".$this->debug_localhost."tb_useritems where cl_itemid='".$itemid."' and cl_userid ='".$userid."'";
		$sqlclass = mysql_query($str,$conn);
		$str = "delete from ".$this->debug_localhost."tb_record where cl_itemid='".$itemid."' and cl_userid ='".$userid."'";
		$sqlclass = mysql_query($str,$conn);
		if($flag == false)//没有别的用户使用着这个项目
		{
			//删除项目信息
			$str = "delete from ".$this->debug_localhost."tb_items where cl_itemid='".$itemid."'";
			$sqlclass = mysql_query($str,$conn);
		}
		
		$array["result"] = true;
		require("../../db/connect_close.php");
		return $array;				
	}
	
	//设定新目标
	public function func_new_goal($userid,$itemid,$newgoal,$content)
	{
		require("../../db/connect.php");
		$time = date("Y-m-d H:i:s");
		$str = "insert into ".$this->debug_localhost."tb_useritems ";
		$str .= "values('".$userid."','".$itemid."','".$time."','".$newgoal."','".$content."')";	
		$sqlclass = mysql_query($str,$conn);
		if($sqlclass)
			$array["result"] = true;
		else
			$array["result"] = false;
		require("../../db/connect_close.php");
		return $array;
	}
	
	//检验用户名唯一性,提供用户id
	public function func_check_username_only_with_id($username,$userid)
	{
		require("../../db/connect.php");
		$str = "select * from ".$this->debug_localhost."tb_userinfo where cl_username='".$username."' and cl_userid!='".$userid."'";
		$sqlclass = mysql_query($str,$conn);
		$result = mysql_fetch_array($sqlclass);
		if(!$result[0])//没有搜索结果，不重名
			$array["only"] = true;
		else
			$array["only"] = false;
		require("../../db/connect_close.php");
		return $array;		
	}
	
	//检验用户名唯一性
	public function func_check_username_only($username)
	{
		require("../../db/connect.php");
		$str = "select * from ".$this->debug_localhost."tb_userinfo where cl_username='".$username."'";
		$sqlclass = mysql_query($str,$conn);
		$result = mysql_fetch_array($sqlclass);
		if(!$result[0])//没有搜索结果，不重名
			$array["only"] = true;
		else
			$array["only"] = false;
		require("../../db/connect_close.php");
		return $array;		
	}
	
	
	//检验邮箱唯一性
	public function func_check_email_only($email)
	{
		require("../../db/connect.php");
		$str = "select * from ".$this->debug_localhost."tb_userinfo where cl_email='".$email."'";
		$sqlclass = mysql_query($str,$conn);
		$result = mysql_fetch_array($sqlclass);
		if(!$result[0])//没有搜索结果，不重名
			$array["only"] = true;
		else
			$array["only"] = false;
		require("../../db/connect_close.php");
		return $array;		
	}
	
	//用户注册一系列操作
	public function func_register($username, $sex, $email, $birthday, $psw)
	{
		$debug="";		
		require("../../db/connect.php");
		$array["result"] = "failed";//先标记失败
		
		$str = "select max(cl_userid) from ".$this->debug_localhost."tb_login";
		$sqlclass = mysql_query($str,$conn);
		if($sqlclass)
		{
			$row = mysql_fetch_row($sqlclass);
			$maxid = $row[0]+1;
		}
		else//數據查找失敗
		{
			$array["result"] = "failed";
			return $array;
		}	
		
		$register_time = date("Y-m-d H:i:s");
		$code = $username."myfitbody".$register_time."yanglinjin";
		$code = md5($code);
		$code = substr($code,0,15);//截取前15个字符
		/*$str = "select cl_code from ".$this->debug_localhost."tb_register_confirm where cl_code = '".$code."';";
		$sqlclass = mysql_query($str,$conn);
		$count = mysql_num_rows($sqlclass);
		$N = 10;
		while($count == 0)//如果已经有相同的code了,再重新算一个code
		{
			$N--;
			if($N<=0)//防止死循环
				break;
			$code = md5($code);
			$code = substr($code,0,15);//截取前15个字符
			$str = "select cl_code from ".$this->debug_localhost."tb_register_confirm where cl_code = '".$code."';";
			$sqlclass = mysql_query($str,$conn);
			$count = mysql_num_rows($sqlclass);
		}*/
		
		//$debug .= "id:".$maxid."  code:".$code;
		
		
		//顺序不能换
		$str = "INSERT INTO ".$this->debug_localhost."tb_userinfo (cl_userid, cl_username, cl_email, cl_sex, cl_birthday, cl_register_time, cl_commit) ";
		$str .= " VALUES ('".$maxid."','".$username."','".$email."','".$sex."','".$birthday."','".$register_time."','0');";
		$sqlclass = mysql_query($str,$conn);
		if(!$sqlclass)
		{
			$array["result"] = "failed";
			return $array;
		}
		$str = "INSERT INTO ".$this->debug_localhost."tb_login (cl_userid,cl_psw,cl_authority) VALUES ('".$maxid."','".$psw."',1);";
		$sqlclass = mysql_query($str,$conn);
		if(!$sqlclass)
		{
			$array["result"] = "failed";
			return $array;
		}
		$str = "INSERT INTO ".$this->debug_localhost."tb_register_confirm (cl_userid, cl_code, cl_register_time) VALUES ('".$maxid."','".$code."','".$register_time."');";
		$sqlclass = mysql_query($str,$conn);
		if(!$sqlclass)
		{
			$array["result"] = "failed";
			return $array;
		}
		require("../../db/connect_close.php");
		$array["result"] = "success";
	
		$title = "fitbody 账号注册激活邮件";
		$content = '谢谢您在fitbody http://fitbody.sinaapp.com/ 注册，请点击下面的链接激活您的账号（账号注册后三十天内激活有效）';
		$content .= ' http://fitbody.sinaapp.com/register_confirm.php?userid='.$maxid.'&code='.$code;
		echo $this->func_send_email($email, $title, $content);
			
		return $array;		
	}
	
	//发送邮件
	private function func_send_email($email, $title, $content)
	{
		$mail = new SaeMail();
		//$mail->setAttach( array( 'my_photo' => '照片的二进制数据' ) );//附件
		$ret = $mail->quickSend( $email , $title , $content , 'yanglinjin229@sina.com' , '299792458' );
		//发送失败时输出错误码和错误信息
		if ($ret === false)
			 var_dump($mail->errno(), $mail->errmsg());		
	}
	
	public function func_send_register_email_again($username, $email)
	{
		$res = -3;
		require("../../db/connect.php");
		$str = "SELECT ".$this->debug_localhost."tb_userinfo.cl_userid, ".$this->debug_localhost."tb_userinfo.cl_username, ".$this->debug_localhost."tb_userinfo.cl_commit ";
		$str .= "FROM ".$this->debug_localhost."tb_userinfo ";
		$str .= "WHERE ".$this->debug_localhost."tb_userinfo.cl_email = '".$email."'; ";
		$sqlclass = mysql_query($str,$conn);
		require("../../db/connect_close.php");
		//echo $str."\r\n";
		if($sqlclass)
		{
			$row = mysql_fetch_row($sqlclass);
			$_userid = $row[0];
			$_username = $row[1];
			$_commit = $row[2];
			//echo $_userid.$_username.$_commit.$username;
			if($_userid == "" && $_username == "" && $_commit == "")
				$res = -2;
			else
			{
				if($username == $_username)
				{
					if($_commit == 1)
					{
						$res = 0;//已经激活了
					}
					else
					{
						//获取激活码
						require("../../db/connect.php");
						$str = "SELECT ".$this->debug_localhost."tb_register_confirm.cl_code ";
						$str .= "FROM ".$this->debug_localhost."tb_register_confirm ";
						$str .= "WHERE ".$this->debug_localhost."tb_register_confirm.cl_userid = ".$_userid." ";
						$sqlclass = mysql_query($str,$conn);
						require("../../db/connect_close.php");	
						if($sqlclass)
						{
							$row = mysql_fetch_row($sqlclass);
							$code = $row[0];
							
							//发送邮件
							$title = "fitbody 账号注册激活邮件";
							$content = '谢谢您在fitbody http://fitbody.sinaapp.com/ 注册，请点击下面的链接激活您的账号（账号注册后三十天内激活有效）';
							$content .= ' http://fitbody.sinaapp.com/register_confirm.php?userid='.$_userid.'&code='.$code;
							$this->func_send_email($email, $title, $content);
							
							//延时注册激活时间
							$time = date("Y-m-d H:i:s");
							require("../../db/connect.php");
							$str = " UPDATE ".$this->debug_localhost."tb_register_confirm ";
							$str .= " SET ".$this->debug_localhost."tb_register_confirm.cl_register_time = ".$time." ";
							$str .= " WHERE ".$this->debug_localhost."tb_register_confirm.cl_userid = ".$_userid." ";
							$sqlclass = mysql_query($str,$conn);
							require("../../db/connect_close.php");	
							
						}
						$res = 1;//还没激活，发送邮件
					}
				}
				else
				{
					$res = -1;//用户名和邮箱不匹配
				}
			}
		}
		else
		{
			$res = -2;//这个邮箱没有被注册过
		}
		return $res;
	}
	
	//激活账号
	public function func_active_user($userid, $code)
	{
		require("db/connect.php");
		$str = "SELECT cl_code,cl_register_time FROM ".$this->debug_localhost."tb_register_confirm WHERE cl_userid='".$userid."'";
		$sqlclass = mysql_query($str,$conn);
		if($sqlclass)
		{			
			$row = mysql_fetch_row($sqlclass);
			$_code = $row[0];
			$_register_time = $row[1];
			if($_code == "" && $_register_time == "")
			{
				require("db/connect_close.php");
				return "no this userid";
			}
			else
			{
				$passtime = time()-strtotime($_register_time);
				if($passtime/(24*60*60)>30)//已经超过了注册后三十天,删除注册信息
				{
					$str = "DELETE FROM ".$this->debug_localhost."tb_register_confirm WHERE cl_userid = '".$userid."';";
					$sqlclass = mysql_query($str,$conn);
					$str = "DELETE FROM ".$this->debug_localhost."tb_login WHERE cl_userid = '".$userid."';";
					$sqlclass = mysql_query($str,$conn);
					$str = "DELETE FROM ".$this->debug_localhost."tb_userinfo WHERE cl_userid = '".$userid."';";
					$sqlclass = mysql_query($str,$conn);
					require("db/connect_close.php");
					return "time out";
				}
				else
					if($_code == $code)//激活码验证成功
					{
						//$str = "DELETE FROM ".$this->debug_localhost."tb_register_confirm WHERE cl_userid = '".$userid."';";
						//$sqlclass = mysql_query($str,$conn);	
						$str = "UPDATE ".$this->debug_localhost."tb_userinfo SET cl_commit = 1 WHERE cl_userid = '".$userid."'";
						$sqlclass = mysql_query($str,$conn);
						require("db/connect_close.php");
						return "success";
					}
					else//激活码不对
					{
						require("db/connect_close.php");
						return "wrong code";
					}
			}
		}
		else
		{
			require("db/connect_close.php");
			return "no this userid";
		}
		
	}
}
?>