<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
echo json_encode($userinfo->func_delete_item($_POST["user_id"],$_POST["item_id"]));
?>