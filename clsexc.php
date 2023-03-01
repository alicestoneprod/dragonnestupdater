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
$DBdnworld = "DNWorld";

$CharacterID = $_POST['cid'];
$clear = $_POST['clear'];

if (!preg_match("#^\d+$#i", $CharacterID)){
echo "<div style='color:#f00;font-family:黑体;'> 角色错误 </div>";
exit();}



$s=@mssql_connect( $myServer, $myUser, $myPass ) or die("<div style='color:#f00;font-family:黑体;'>无法连接SQL Server</div>");
@mssql_select_db($DBdnworld, $s) or die ("<div style='color:#f00;font-family:黑体;'>无法打开数据库</div>");

mssql_query("set ANSI_NULLS ON");
mssql_query("set QUOTED_IDENTIFIER ON");
mssql_query("set CONCAT_NULL_YIELDS_NULL ON");
mssql_query("set ANSI_WARNINGS ON");
mssql_query("set ANSI_PADDING ON");

$checkuser = mssql_query("SELECT AccountName FROM Characters WHERE CharacterID=$CharacterID and AccountID=$AccountID");
$name_exist = mssql_num_rows($checkuser);

if($name_exist <= 0){
echo "<div style='color:#f00;font-family:黑体;'> 想搞破坏? </div>";
exit();}

mssql_query("delete from DNWorld.dbo.Trade where CharacterID=$CharacterID");

echo "cleaned";

mssql_close();
?>