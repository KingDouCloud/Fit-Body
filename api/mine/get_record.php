<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
echo json_encode($userinfo->func_get_record($_POST["user_id"],$_POST["item_id"],$_POST["start_time"],$_POST["end_time"]));
?>