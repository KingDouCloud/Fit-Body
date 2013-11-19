<?php
include("../cl/CL_Authority.php");
$authority = new Authority();
echo json_encode($authority->func_check_authority($_POST["id"] , $_POST["psw"] , $_POST["authority"],1));
?>