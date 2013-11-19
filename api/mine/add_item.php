<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
echo json_encode($userinfo->func_add_item($_POST["user_id"],$_POST["item_name"],$_POST["item_unit"],$_POST["goal"],$_POST["content"]));
?>