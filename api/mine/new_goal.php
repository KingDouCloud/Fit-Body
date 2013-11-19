<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
echo json_encode($userinfo->func_new_goal($_POST["user_id"],$_POST["item_id"],$_POST["goal"],$_POST["content"]));
?>