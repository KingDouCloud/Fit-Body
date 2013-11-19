<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
echo json_encode($userinfo->func_get_mine_items($_POST["id"]));
?>