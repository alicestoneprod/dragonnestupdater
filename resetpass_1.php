<?php
$myServer = "127.0.0.1,32152";
$myUser = "DragonNest";
$myPass = "skQmsgozj!*sha";
$DBaccount = "DNMembership_80EX";

$name = $_POST['username'];
$newpass = $_POST['newpassword'];
$mail = $_POST['mail'];

$str_len1 = strlen($name);
$str_len2 = strlen($mail);
$str_len3 = strlen($newpass);

$s=null;
$d=null;
$s = @mssql_connect( $myServer, $myUser, $myPass ) or die("<div style='color:#f00;font-family:黑体;'>无法连接SQL Server</div>");
$d = @mssql_select_db($DBaccount, $s) or die ("<div style='color:#f00;font-family:黑体;'>无法打开数据库</div>");

if ($str_len1 <= 0){
echo "<div style='color:#f00;font-family:黑体;'> 用户名为空 </div>";
exit();}

if ($str_len2 <= 0){
echo "<div style='color:#f00;font-family:黑体;'> 密码为空 </div>";
exit();}

if ($str_len3 <= 0){
echo "<div style='color:#f00;font-family:黑体;'> 密码为空 </div>";
exit();}

if (!preg_match("#^[a-z0-9]+$#i", $name)){
echo "<div style='color:#f00;font-family:黑体;'> 用户名为字母和数字 </div>";
exit();}

if (!preg_match("#^[a-z0-9_]+@[a-z0-9_]+\.[a-z0-9_]+$#i", $mail)){
echo "<div style='color:#f00;font-family:黑体;'> 邮箱不符合要求 </div>";
exit();}

if (preg_match("#[='\"]|true|false+#i", $newpass)){
echo "<div style='color:#f00;font-family:黑体;'> 密码不符合要求 </div>";
exit();}

if ($str_len1 > 20){
echo "<div style='color:#f00;font-family:黑体;'> 太长 </div>";
exit();}

$result = mssql_query("exec dn_resetpass'$name','$mail','$newpass'");
$info=mssql_fetch_array($result);
$ChangeResult=$info[ChangeResult];

mssql_close();

if($ChangeResult==1){
echo "<div style='color:#090;font-family:黑体;'> 成功！</div>";
exit();}

if($ChangeResult==2){
echo "<div style='color:#f00;font-family:黑体;'> 用户名或邮箱错误 </div>";
exit();}

echo "<div style='color:#f00;font-family:黑体;'> 不明错误 </div>";
?>