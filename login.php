<?php session_start(); ?>
<?php
$myServer = "127.0.0.1,32152";
$myUser = "DragonNest";
$myPass = "skQmsgozj!*sha";
$DBDNMembership = "DNMembership_80EX";

$name = $_POST['username'];
$pass = $_POST['password'];

$str_len1 = strlen($name);
$str_len2 = strlen($pass);

if ($str_len1 <= 0){
echo "<div style='color:#f00;font-family:黑体;'> 用户名为空 </div>";
exit();}

if ($str_len2 <= 0){
echo "<div style='color:#f00;font-family:黑体;'> 密码为空 </div>";
exit();}

if (!preg_match("#^[a-z0-9]+$#i", $name)){
echo "<div style='color:#f00;font-family:黑体;'> 用户名为字母和数字 </div>";
exit();}

if ($str_len1 > 20){
echo "<div style='color:#f00;font-family:黑体;'> 太长 </div>";
exit();}

$s = @mssql_connect( $myServer, $myUser, $myPass ) or die ("<div style='color:#f00;font-family:黑体;'>无法连接数据库</div>");
@mssql_select_db($DBDNMembership, $s) or die ("<div style='color:#f00;font-family:黑体;'>无法打开数据库</div>");

//checkuser
$result = mssql_query("exec DN_Login2 N'$name',N'$pass'");
$info=mssql_fetch_array($result);
$LoginResult=$info[LoginResult];/////////LoginResult

if ($LoginResult==1){

	$result = mssql_query("SELECT AccountID FROM Accounts WHERE AccountName='$name'");
	
	$exist = mssql_num_rows($result);
	if($exist <= 0){
	echo "<div  style='color:#f00;font-family:黑体;'> 请先创建角色 </div>"; 
	exit();}
	
	$info=mssql_fetch_array($result);
	$AccountID=$info[AccountID];/////////AccountID
	mssql_close();
	
	$_SESSION['AccountID']=$AccountID;
	echo "$AccountID";
exit();}

if ($LoginResult==5){
echo "<div style='color:#f00;font-family:黑体;'> 用户名或密码错误 </div>";
exit();}

echo "<div style='color:#f00;font-family:黑体;'> 不明错误 </div>";
?>