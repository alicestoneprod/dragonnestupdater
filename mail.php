<?php
require("mail/class.phpmailer.php"); //下载的文件必须放在该文件所在目录
require("mail/class.smtp.php"); //下载的文件必须放在该文件所在目录
$mail = new PHPMailer(true); //建立邮件发送类
$mail->IsSMTP(); // SMTP方式
$mail->IsHTML(true); //HTML格式
$mail->AddAddress("lzgdn_cs@foxmail.com", "玩家");//收件人地址,格式AddAddress("收件人email","收件人名字")
$mail->Mailer     = "SMTP";
$mail->Host       = "smtp.qq.com"; // 服务器
$mail->Port       = 25;
$mail->SMTPSecure = 'tls';
$mail->CharSet    = 'UTF-8';
$mail->SMTPAuth   = true; // 启用SMTP验证功能
$mail->Username   = "lzgdn_cs@foxmail.com"; // 邮箱账号
$mail->Password   = "metckacikxwndcif"; // 密码
$mail->From       = "lzgdn_cs@foxmail.com"; //发件人地址
$mail->FromName   = "管理员";//发件人名字
$mail->WordWrap   = 80; // 设置每行字符串的长度
$mail->Subject    = "龙只顾密码"; //邮件标题
$mail->Body       = "您的帐号xxxx已激活，密码是惺惺惜惺惺x，请尽快修改"; //邮件内容
$mail->AltBody    = ""; //non-HTML附加信息，可以省略

if(!$mail->Send())
{
echo "邮件发送失败. <p>";
echo "错误原因: " . $mail->ErrorInfo;
exit;
}

echo "邮件发送成功，请注意查收";
?>