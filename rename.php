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

$CharacterID = $_POST['cid'];
$name = $_POST['newname'];

$str_len1 = strlen($name);
if ($str_len1 > 30){
echo "<div style='color:#f00;font-family:黑体;'> 太长 </div>";
exit();}

if (preg_match("#[='\"]|true|false#i", $name)){
echo "<div style='color:#f00;font-family:黑体;'> 名字不符合要求 </div>";
exit();}

if (preg_match("#[='\"]|true|false+#i", $CharacterID)){
echo "<div style='color:#f00;font-family:黑体;'> 想搞破坏? </div>";
exit();}

@mssql_connect( $myServer, $myUser, $myPass ) or die("<div style='color:#f00;font-family:黑体;'>无法连接SQL Server</div>");

mssql_query("set ANSI_NULLS ON");
mssql_query("set QUOTED_IDENTIFIER ON");
mssql_query("set CONCAT_NULL_YIELDS_NULL ON");
mssql_query("set ANSI_WARNINGS ON");
mssql_query("set ANSI_PADDING ON");
//查
$sql="select CharacterID from dnworld.dbo.Characters where CharacterName='$name' and DeleteFlag=0";
$result=mssql_query(iconv('utf-8','gbk//ignore',$sql));
$exist = mssql_num_rows($result);
if($exist > 0){
echo "<div  style='color:#f00;font-family:黑体;'> 名字已存在 </div>"; 
exit();}
//改
$sql="update dnworld.dbo.Characters set CharacterName='$name' where CharacterID=$CharacterID and DeleteFlag=0";
$sql=iconv("UTF-8","gbk//IGNORE",$sql) ;
mssql_query($sql);
//查
$sql="select CharacterName collate Chinese_PRC_CI_AS from dnworld.dbo.Characters where CharacterID=$CharacterID and DeleteFlag=0";
$result=mssql_query(iconv('utf-8','gbk//ignore',$sql));
$info=mssql_fetch_array($result);
$CharacterName=$info[0];//-------------------------!!
echo "已改名为：" . iconv('gbk','utf-8//ignore',$CharacterName);

mssql_close();
?>