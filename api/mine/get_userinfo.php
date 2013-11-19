<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
//echo $_POST["id"];
echo json_encode($userinfo->func_get_info($_POST["id"]));
?>