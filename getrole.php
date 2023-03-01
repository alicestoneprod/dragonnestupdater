<?php
session_start();
$AccountID=$_SESSION['AccountID'];
$str_len1 = strlen($AccountID);
if($str_len1<=0){
echo "unlog";
exit();}
?>
<?php
$myServer = "127.0.0.1,32152";
$myUser = "DragonNest";
$myPass = "skQmsgozj!*sha";

@mssql_connect( $myServer, $myUser, $myPass ) or die("<div style='color:#f00;font-family:黑体;'>无法连接SQL Server</div>");

$sql="select CharacterID,CharacterName collate Chinese_PRC_CI_AS from dnworld.dbo.Characters where AccountID=$AccountID and deleteflag=0";
$result=mssql_query(iconv('utf-8','gbk//ignore',$sql));
while($row = mssql_fetch_array($result)){
$row[1]=iconv('gbk','utf-8',$row[1]);
$row['CharacterName']=$row[1];
$array[] = $row;
}
$json = json_encode($array);
echo $json;
?>