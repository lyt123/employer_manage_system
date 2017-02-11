<?php
require_once 'AdminService1.class.php';
$id = $_POST['id'];
$password = $_POST['password'];
$keep = $_POST['keep'];
$checkCode = $_POST['checkcode'];
session_start();

//判断二维码是否正确，暂时关闭
//if($checkCode!=$_SESSION['myCheckCode'])
//{
//    header("Location:login1.php?errno=2");
//    exit();
//}

if (empty($_POST['keep'])) {
    if (!empty($_COOKIE['id'])) {
        setcookie("id", $id, time() - 100);
    }
} else {
    setcookie("id", $id, time() + 7 * 2 * 24 * 3600);
}
$adminService = new AdminService();
$name = $adminService->chekcAdimn($id, $password);
if ($name != "")
{
    session_start();
    $_SESSION['loginUser'] = $name;//非法进入empManage1.php时验证
    header("Location: empManage1.php?name=$name");
    exit();
} else {
    header("Location: login1.php?errno=1");
    exit();
}
?>

