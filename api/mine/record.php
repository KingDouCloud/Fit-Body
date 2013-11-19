<?php
include("../cl/CL_Userinfo.php");
include("../cl/CL_Authority.php");
$userinfo = new User_info();
$authority = new Authority();
$user_id = $_POST["user_id"];
$psw = $_POST["psw"];
$time = date("Y-m-d H:i:s");

$array["result"] = "true";
if($authority->func_check_psw($user_id,$psw) == true)//先驗證密碼對不對
{
	$array["result"] = $userinfo->func_record($user_id ,$_POST["item_id"], $time ,$_POST["count"],$_POST["content"]);
}
else
{
	$array["result"] = false;
	$array["excetion"] = "wrong password in cookie";
}
echo json_encode($array);
?>