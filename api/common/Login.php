<?php
include("../cl/CL_Authority.php");
$authority = new Authority();
echo json_encode($authority->func_login($_POST["username"],$_POST["psw"],$_POST["rem"]));
?>