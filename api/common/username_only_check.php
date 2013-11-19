<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
echo json_encode($userinfo->func_check_username_only($_POST["username"]));
?>