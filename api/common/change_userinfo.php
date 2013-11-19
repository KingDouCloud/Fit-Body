<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
echo json_encode($userinfo->func_set_info($_POST["userid"],$_POST["username"],$_POST["email"]));
?>