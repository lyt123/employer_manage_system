<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<?php
require_once "common.php";
checkValidate();//验证是否已登录，防止非法登录
getLastTime();//获取上次登录时间

if(!empty($_GET['name']))
{
    echo "欢迎 ".$_GET['name']." </br>登录成功!";
}
echo "<br/><a href='login1.php'>返回重新登录</a>";
?>
<h1>主界面</h1>
<a href='empList1.php'>管理用户</a><br/>
<a href='addEmp1.php'>添加用户</a><br/>
<a href='srhEmp1.php'>查询用户</a><br/>
<a href='FCKeditor/writeIdea.php'>编写idea</a><br/>
<a href="sendMail.php">发送邮件</a><br/>
<a href='login1.php'>退出系统</a><br/>
<br><br><br>
<a style="font-size: 40px; color: #2aabd2;" href="bt.html">boostrap特效展示</a>
</html>
