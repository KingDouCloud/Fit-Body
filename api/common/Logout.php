<?php
include("../cl/CL_Authority.php");
$authority = new Authority();
echo json_encode($authority->func_logout());
header("Location: ../../");
//确保重定向后，后续代码不会被执行
exit;
?>