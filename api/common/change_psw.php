<?php
include("../cl/CL_Authority.php");
$authority = new Authority();
echo json_encode($authority->func_changepsw($_POST["id"] , $_POST["psw_old"] , $_POST["psw_new"]));
?>