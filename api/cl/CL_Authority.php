<?php
  session_start();
  ob_start();
  
class Authority
{
	private $userid;
	private $md5psw;
	private $authority;
	//private $debug_localhost = "app_fitbody.";//本地调试时使用
	private $debug_localhost = "";//上传到sae时使用
    
	private function db_select($userid)
	{
		require("../../db/connect.php");
		$str = "select * from tb_login where cl_userid='".$userid."'";
		$sqlclass = mysql_query($str,$conn);
		if($sqlclass)
			$result = mysql_fetch_array($sqlclass);
		else
			return $str;
		require("../../db/connect_close.php");
		return $result;
	}
	
	//修改登錄表tb_login中指定userid的密碼
	private function db_update($userid,$md5psw)
	{
		require("../../db/connect.php");
		$str = "update ".$this->debug_localhost."tb_login set cl_psw='".$md5psw."' where cl_userid='".$userid."'";
		$sqlclass = mysql_query($str,$conn);
		require("../../db/connect_close.php");
	}
	//在登錄表tb_login中插入新用戶
	private function db_insert($userid,$psw,$authority)
	{
		require("../../db/connect.php");
		$str = "insert into ".$this->debug_localhost."tb_login value('".$userid."','".$psw."','".$authority."')";
		$sqlclass = mysql_query($str,$conn);
		require("../../db/connect_close.php");
	}
	
	
	//记录用户的登录时间
	private function func_record_time_login($user_id)
	{	
		$time = date("Y-m-d H:i:s");
		require("../../db/connect.php");
		$str = "UPDATE ".$this->debug_localhost."tb_login SET cl_last_time_login = '".$time."' WHERE cl_userid = '".$user_id."';";
		$sqlclass = mysql_query($str,$conn);
		require("../../db/connect_close.php");		
	}
	
	//记录用户的最新活动时间
	private function func_record_time_active($user_id)
	{	
		$time = date("Y-m-d H:i:s");
		require("../../db/connect.php");
		$str = "UPDATE ".$this->debug_localhost."tb_userinfo SET cl_last_time_active = '".$time."' WHERE cl_userid = '".$user_id."';";
		$sqlclass = mysql_query($str,$conn);
		require("../../db/connect_close.php");		
	}
	
	//登錄操作，返回數組：userid,psw,authority,result。
	//result：0-登陸成功；1-密碼錯誤；2-無此用戶
	public function func_login($username,$md5psw,$keepcookie)
	{		
		//查詢這個用戶的記錄		
		require("../../db/connect.php");
		$str = "select ".$this->debug_localhost."tb_login.cl_userid, ".$this->debug_localhost."tb_login.cl_psw, ".$this->debug_localhost."tb_login.cl_authority ";
		$str .= "from ".$this->debug_localhost."tb_login,".$this->debug_localhost."tb_userinfo ";
		$str .= "where ".$this->debug_localhost."tb_login.cl_userid=";
		$str .= "(select cl_userid from ".$this->debug_localhost."tb_userinfo where cl_username = '".$username."')";
		$sqlclass = mysql_query($str,$conn);
		if($sqlclass)
			$result = mysql_fetch_array($sqlclass);
		require("../../db/connect_close.php");		
		$userid;
		
 		if($result[0])//如果查找出來的結果不為空
		{
			if($result[1]==$md5psw)//密碼匹配上了
			{
				$this->userid = $result[0];
				$userid = $this->userid;
				$this->md5psw = $result[1];
				$this->authority = $result[2];
				$this->func_record_time_login($result[0]);//记录上一次登录时间
				
				if($keepcookie == 1)//保存登錄狀態,設置一年的cookie有效期
				{
					setcookie("userid",$userid,time()+60*60*24*365,"/");
					setcookie("username",$username,time()+60*60*24*365,"/");
					setcookie("password",$md5psw,time()+60*60*24*365,"/");
					setcookie("authority",$this->authority,time()+60*60*24*365,"/");
				}
				else//不保存登錄狀態,設置半個小時的cookie有效期
				{
					setcookie("userid",$userid,time()+60*30,"/");
					setcookie("username",$username,time()+60*30,"/");
					setcookie("password",$md5psw,time()+60*30,"/");
					setcookie("authority",$this->authority,time()+60*30,"/");
				}
				$returnargs = 0;
			}
			else//密碼錯誤
			{
				$returnargs = 1;
			}
		}
		else //用戶名錯誤
		{
			$returnargs = 2;
		}
		$array["id"] = $this->userid;
		$array["psw"] = $this->md5psw;
		$array["authority"] = $this->authority;
		$array["result"] = $returnargs;
		//$arrayp"sqlclass"] = $sqlclass;
		//$array["results"] = $result[1];
		//$array["psw"] = $md5psw;
		//$array["sql"] = $str;
		return $array;			
	}
	//登出操作，返回值：info=Logout success
	public function func_logout()
	{
		//清空cookie
		setcookie("userid","",time()-60,"/");
		setcookie("username","",time()-60,"/");
		setcookie("password","",time()-60,"/");
		setcookie("authority","",time()-60,"/");
		$array["info"] = "Logout success";
		return $array;
		//清session、cookie等
	}
	//檢測此用戶是否有權限，驗證通過返回access=true，驗證失敗直接清除cookie并返回access=false
	public function func_check_authority($userid , $md5psw , $authority, $authority_shouldbe)
	{		
		//查詢這個用戶的記錄		
		require("../../db/connect.php");
		$str = "select ".$this->debug_localhost."tb_login.cl_userid,".$this->debug_localhost."tb_login.cl_psw,".$this->debug_localhost."tb_login.cl_authority ";
		$str .= "from ".$this->debug_localhost."tb_login ";
		$str .= "where ".$this->debug_localhost."tb_login.cl_userid='".$userid."'";
		$sqlclass = mysql_query($str,$conn);
		if($sqlclass)
			$result = mysql_fetch_array($sqlclass);
		require("../../db/connect_close.php");	
		
		$flag = 0;//1有權限,0無權限
 		if($result[0])//如果查找出來的結果不為空
		{
			if($result[1] == $md5psw && $authority == $result[2] && $authority == $authority_shouldbe)//密碼匹配上了,並且權限對上了
			{
				$this->func_record_time_active($userid);//记录上一次权限验证时间
				$flag = 1;
			}
			else//密碼錯誤或者cookie裏面存的權限不對
				$flag = 0;
		}
		else //用戶名錯誤
			$flag = 0;
			
		if($flag == 1)
		{
			$array["access"] = "true";
			return $array;	
		}
		else
		{
			//清空cookie
			setcookie("userid","",time()-60,"/");
			setcookie("username","",time()-60,"/");
			setcookie("password","",time()-60,"/");
			setcookie("authority","",time()-60,"/");
			$array["access"] = "false";
			return $array;	
		}
	}
	//檢測此用戶密碼是否正確，驗證通過返回true，驗證失敗直接清除cookie并返回false
	public function func_check_psw($userid , $md5psw )
	{		
		//查詢這個用戶的記錄		
		require("../../db/connect.php");
		$str = "select ".$this->debug_localhost."tb_login.cl_userid,".$this->debug_localhost."tb_login.cl_psw ";
		$str .= "from ".$this->debug_localhost."tb_login ";
		$str .= "where ".$this->debug_localhost."tb_login.cl_userid='".$userid."'";
		$sqlclass = mysql_query($str,$conn);
		if($sqlclass)
			$result = mysql_fetch_array($sqlclass);
		require("../../db/connect_close.php");	
		
		$flag = 0;//1有權限,0無權限
 		if($result[0])//如果查找出來的結果不為空
		{
			if($result[1] == $md5psw )//密碼匹配上了
			{
				$flag = 1;
			}
			else//密碼錯誤或者cookie裏面存的權限不對
				$flag = 0;
		}
		else //用戶名錯誤
			$flag = 0;
			
		if($flag == 1)
		{
			return true;	
		}
		else
		{
			//清空cookie
			setcookie("userid","",time()-60,"/");
			setcookie("username","",time()-60,"/");
			setcookie("password","",time()-60,"/");
			setcookie("authority","",time()-60,"/");
			//return $str."<br>".$result[1]."<br>".$md5psw;
			return false;	
		}
	}
	//修改密碼,返回值success=true成功；false失敗
	public function func_changepsw($userid , $md5psw_old, $md5psw_new)
	{
		$result = $this->db_select($userid);//查詢這個用戶的記錄
		$flag = 1;
 		if($result[0])//如果查找出來的結果不為空
		{
			//return $result[1]."<br>".$md5psw_old."<br>".$md5psw_new;
			if($result[1] == $md5psw_old )//密碼匹配上了
			{
				$this->db_update($userid,$md5psw_new);//修改密碼
				$flag = 1;
			}
			else//密碼錯誤
				$flag = 0;
		}
		else //用戶名錯誤
			$flag = 0;
			
		if($flag == 1)//修改成功
		{
			$array["success"] = "true";
			return $array;	
		}
		else
		{
			$array["success"] = "false";
			return $array;	
		}
	}

	
	public function func_register($userid,$md5psw,$authority,$username,$sex,$birthday)
	{
	}
	
	public function func_register_confirm($userid,$code)
	{
	}
}
?>