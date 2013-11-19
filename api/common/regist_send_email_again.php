<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
echo json_encode($userinfo->func_send_register_email_again($_POST["username"], $_POST["email"]));
?>