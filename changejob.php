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
$job = $_POST['job'];

$str_len1 = strlen($job);
if ($str_len1 > 1){
echo "<div style='color:#f00;font-family:黑体;'> 请选择职业 </div>";
exit();}

if (preg_match("#[='\"]|true|false+#i", $CharacterID)){
echo "<div style='color:#f00;font-family:黑体;'> 想搞破坏? </div>";
exit();}

@mssql_connect( $myServer, $myUser, $myPass ) or die("<div style='color:#f00;font-family:黑体;'>无法连接数据库</div>");

mssql_query("set ANSI_NULLS ON");
mssql_query("set QUOTED_IDENTIFIER ON");
mssql_query("set CONCAT_NULL_YIELDS_NULL ON");
mssql_query("set ANSI_WARNINGS ON");
mssql_query("set ANSI_PADDING ON");

$sql="update dnworld.dbo.CharacterStatus set JobCode='$job' where CharacterID=$CharacterID";
mssql_query($sql);
$sql2="update dnworld.dbo.Characters set CharacterClassCode='$job' where CharacterID=$CharacterID";
mssql_query($sql2);
$sql3="delete from dnworld.dbo.JobChangeLogs where CharacterID=$CharacterID";
mssql_query($sql3);
$sql4="delete from DNWorld.dbo.Skills where CharacterID=$CharacterID";
mssql_query($sql4);
$sql5="insert into dnworld.dbo.JobChangeLogs (CharacterID,JobCode,LogDate) values (N'$CharacterID',N'$job',GETDATE())";
mssql_query($sql5);
$sql6="delete from DNWorld.dbo.MaterializedItems where OwnerCharacterID=$CharacterID and ItemID in (295001,295002,295003,295101,295102,295103,295201,295202,295203,295301,295302,295303,295401,295402,295403,295501,295502,295503,295601,295602,295603,295701,295702,295703,295801,295802,295803,296001,296002,296003,296004,296006,295604,296101,296102,296103,296104,296106,296201,296202,296203,296204,296206,296301,296302,296303,296304,296306,296401,296402,296403,296404,296406,296501,296502,296503,296504,296506,296601,296602,296603,296604,296606,296701,296702,296703,296704,296706,296801,296802,296803,296804,296806,296805,296806,296807,296808,296809)";
mssql_query($sql6);

$result = mssql_query("SELECT max(ItemSerial) as ItemSerial FROM DNWorld.dbo.MaterializedItems");
$info=mssql_fetch_array($result);
$ItemSerial=$info["ItemSerial"];

if ($job == 1){
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+1,295001,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,0)");
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+2,296001,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,1)");
} elseif  ($job == 2){
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+1,295101,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,0)");
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+2,296101,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,1)");
} elseif  ($job == 3){
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+1,295201,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,0)");
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+2,296201,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,1)");
} elseif  ($job == 4){
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+1,295301,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,0)");
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+2,296301,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,1)");
} elseif  ($job == 5){
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+1,295401,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,0)");
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+2,296401,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,1)");
} elseif  ($job == 6){
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+1,295501,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,0)");
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+2,296501,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,1)");
} elseif  ($job == 7){
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+1,295601,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,0)");
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+2,296601,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,1)");
} elseif  ($job == 8){
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+1,295701,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,0)");
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+2,296701,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,1)");
} elseif  ($job == 9){
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+1,295801,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,0)");
mssql_query("INSERT INTO DNWorld.dbo.MaterializedItems(ItemSerial,ItemID,ItemRemainCount,PayMethodCode,SenderCharacterID,ItemMaterializeCode,ItemMaterializeFKey,ItemDurability,RandomSeed,CoolTime,ItemLevel,ItemPotential,SoulBoundFlag,SealCount,ItemOption,ItemMaterializeDate,OwnerCharacterID,ItemLocationCode,ItemLocationIndex) VALUES ($ItemSerial+2,296801,1,0,0,17,0,0,0,0,0,0,0,0,0,SYSDATETIME(),$CharacterID,1,1)");
}

echo "<div style='color:#090;font-family:黑体;'> 转职成功！</div>";

mssql_close();
?>