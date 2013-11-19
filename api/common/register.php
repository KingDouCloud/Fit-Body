<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
$res = $userinfo->func_register($_POST["username"],$_POST["sex"],$_POST["email"],$_POST["birthday"],$_POST["psw"]);
//echo $res;
echo json_encode($res);
?>