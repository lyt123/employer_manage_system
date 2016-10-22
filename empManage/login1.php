<?php
require_once 'common.php';
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <script type="text/javascript" src="ajax.js"></script>
    <link rel="stylesheet" href="../bootstrap-3.3.5/css/bootstrap.min.css">
    <script src="../jquery-2.2.4.js"></script>
    <script src="../bootstrap-3.3.5/js/bootstrap.min.js"></script>
</head>
<h1>管理员登录系统</h1>
<form action="loginProcess1.php" method="post">
    <table>
        <tr><td>用户id</td><td><input id="user_input" type="text" name="id" value="<?php echo getCookieVal('id')?>" /></td><td><div id="existCon"></div></td></tr>
        <tr><td>密　&nbsp;码</td><td><input type="password" name="password"/></td></tr>
        <tr><td>验证码</td><td><input type="text" name="checkcode" /></td></tr>
        <tr><td><img src="checkCode.php" onclick="this.src='checkCode.php?aa='+Math.random()" /></td></tr>
        <tr><td colspan="2">是否保存用户id<input type="checkbox" value="yes" name="keep"/></td></tr>
        <tr>
            <td><input type="submit" class="btn btn-default" value="用户登录"/></td>
            <td><input type="reset" class="btn btn-default"  value="重新填写"/></td>
        </tr>
    </table>
</form>
<?php
//接收errno
if(!empty($_GET['errno'])) {
    $errno = $_GET['errno'];
    if ($errno == 1) {
        echo "<br/>你的用户名或者密码错误";
    } else if ($errno == 2)
    {
        echo "你的验证码有误";
    } elseif($errno == 3)
    {
        echo "请登录";
    }
}
?>
</html>
