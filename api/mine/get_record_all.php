<?php
include("../cl/CL_Userinfo.php");
$userinfo = new User_info();
$array = $userinfo->func_get_record_all($_POST["user_id"],$_POST["start_time"],$_POST["end_time"]);
//$array = $userinfo->func_get_record_all(1,0,0);
//echo "Day,Visits,Unique Visitors\n";
//echo ",".$array[0]["itemname"]."\n";

$array1;
$array1["itemname"] = "體重";
//echo "[";
for($i = 0;$i<count($array[0]["data"]);$i++)
{
	$array1["data"][$i] = (double)$array[0]["data"][$i]["count"];
	$date = substr($array[0]["data"][$i]["time"],6,1)."/".substr($array[0]["data"][$i]["time"],8,2)."/".substr($array[0]["data"][$i]["time"],0,4);
	//echo "[".$i.",".$array[0]["data"][$i]["count"]."]";
	//if($i != count($array[0]["data"])-1)
	//	echo ",";
}
//echo "]";
//echo json_encode($array);

for($i=0;$i<count($array);$i++)
{
	$array_r[$i]["itemname"] = $array[$i]["itemname"];
	$array_r[$i]["itemunit"] = $array[$i]["itemunit"]; 
	for($j=0;$j<count($array[$i]["data"]);$j++)
	{
		$count = (double)$array[$i]["data"][$j]["count"];
		
		$time = (int)substr($array[$i]["data"][$j]["time"],0,10);
		$year = (int)substr($array[$i]["data"][$j]["time"],0,4);
		$month = (int)substr($array[$i]["data"][$j]["time"],5,2);
		$day = (int)substr($array[$i]["data"][$j]["time"],8,2);
		$hour = (int)substr($array[$i]["data"][$j]["time"],11,2);
		$min = (int)substr($array[$i]["data"][$j]["time"],14,2);
		$second = (int)substr($array[$i]["data"][$j]["time"],17,2);
		$hour += 8;//因為下面轉換為時間戳之後是格林威治時間的，所以轉換為東八區
		
		$t= mktime($hour,$min,$second,$month,$day,$year)*1000;//時間戳php是10位，js是14位，轉換一下
		//$t= mktime(0,0,0,$month,$day,$year);
		
		//$t = gmdate("M d Y H:i:s",$t);
		
		$array_r[$i]["data"][$j] = array($t,$count);
		
		//$array_r[$i]["data"][$j] = array($time,$count);
	}
}
echo json_encode($array_r);
?>