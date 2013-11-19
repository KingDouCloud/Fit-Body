<?php
class Test
{
	//根据学生id查找
	public function test()
	{
		require("db/connect.php");
		$str = "select cl_psw from fitbody.tb_login where cl_userid=1";
		$sqlclass = mysql_query($str,$conn);
		$infoclass = mysql_fetch_array($sqlclass);
		require("db/connect_close.php");
		return $infoclass;
	}
}

$t = new Test();
$result = $t->test();
	echo($result[0]."<br>");

$t = new Test();
$result = $t->test();
	echo($result[0]."<br>");

$t = new Test();
$result = $t->test();
	echo($result[0]."<br>");
?>