<?php
$myServer = "127.0.0.1,32152";
$myUser = "tom";
$myPass = "tom";
$DBaccount = "dnmembership_80EX";

$name = $_POST['username'];
$pass = $_POST['password'];
$mail = $_POST['mail'];

$str_len1 = strlen($name);
$str_len2 = strlen($pass);

$s=null;
$d=null;
$s = @mssql_connect( $myServer, $myUser, $myPass ) or die("<div style='color:#f00;font-family:黑体;'>无法连接SQL Server</div>");
$d = @mssql_select_db($DBaccount, $s) or die ("<div style='color:#f00;font-family:黑体;'>无法打开数据库</div>");

if ($str_len1 < 6){
echo "<div style='color:#f00;font-family:黑体;'>帐号不能少于6位数，且不要包含特殊符号</div>";
exit();}

if ($str_len2 < 6){
echo "<div style='color:#f00;font-family:黑体;'>密码不能少于6位数，且不要包含特殊符号</div>";
exit();}

if (!preg_match("#^[a-z0-9]+$#i", $name)){
echo "<div style='color:#f00;font-family:黑体;'>帐号为字母和数字</div>";
exit();}

if (preg_match("#[='\"]|true|false+#i", $pass)){
echo "<div style='color:#f00;font-family:黑体;'>密码不符合要求</div>";
exit();}

if (!preg_match("#[_a-z0-9]{1,20}@[_a-z0-9]{1,20}\.[_a-z0-9]{1,4}#i", $mail)){
echo "<div style='color:#f00;font-family:黑体;'>邮箱不符合要求</div>";
exit();}

if ($str_len1 > 20){
echo "太长";
exit();}
//checkuserexist
$checkuser = mssql_query("SELECT AccountName FROM Accounts WHERE AccountName='$name'");
$name_exist = mssql_num_rows($checkuser);
if($name_exist > 0){
echo "<div style='color:#f00;font-family:黑体;'>帐号已被注册</div>";
exit();}
//checkmailexist
$checkuser = mssql_query("SELECT AccountName FROM Accounts WHERE mail='$mail'");
$name_exist = mssql_num_rows($checkuser);
if($name_exist > 0){
echo "<div style='color:#f00;font-family:黑体;'>邮箱已被其它账号绑定<br/>请更换其它邮箱</div>";
exit();}
//checkIP
/* $client = $_SERVER["REMOTE_ADDR"];
$checkuser = mssql_query("SELECT Account FROM ip.dbo.ip WHERE ip=N'$client' and DateDiff(hh,time,getDate())<24");
$name_exist = mssql_num_rows($checkuser);
if($name_exist > 0){
echo "<div style='color:#f00;font-family:黑体;'>您好：每次注册间隔为24小时！</div>";
exit();} */
mssql_query("SET ANSI_NULLS ON");
mssql_query("SET QUOTED_IDENTIFIER ON");
mssql_query("SET CONCAT_NULL_YIELDS_NULL ON");
mssql_query("SET ANSI_WARNINGS ON");
mssql_query("SET ANSI_PADDING ON");

$sql = "exec DNMembership_80EX.dbo.__NX__CreateAccount '$name','$pass','$mail'";
mssql_query($sql);
$sql = 'USE [DNMembership_80EX]
DECLARE @return_value int
EXEC dbo.P_AddCashIncome 
@nvcAccountName = \''.$name.'\',
@inyCashIncomeCode = 0, 
@inyPGCode = 0, 
@nvcPGKey = 0, 
@intCashAmount = 99999999';
mssql_query($sql);
//echo $_SERVER["REMOTE_ADDR"];
/* mssql_query("insert into [IP].[dbo].[IP] values(N'$name',N'".$_SERVER["REMOTE_ADDR"]."',getdate())"); */
mssql_close();

echo "<div style='color:#f00;font-family:黑体;'>注册成功!<br/>欢迎加入本服!</div>";
?>