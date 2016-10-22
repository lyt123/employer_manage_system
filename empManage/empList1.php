<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>雇员信息列表</title>
    <script type="text/javascript">
        function confirmDele(val) {
            return window.confirm("是否要删除id=" + val + "的用户");
        }
    </script>
</head>
<?php
require_once 'EmpService1.class.php';
require_once 'FenyePage1.class.php';

$empService = new EmpService();
$fenyePage = new FenyePage();

$fenyePage->pageNow = 1;
$fenyePage->pageSize = 6;
$fenyePage->gotoUrl = "empList1.php";

if (!empty($_GET['pageNow'])) {
        $fenyePage->pageNow = $_GET['pageNow'];
}
$empService->getFenyePage($fenyePage);

echo "<table border='1px' cellspacing='0px'  width='700px'>";
echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";

for ($i = 0; $i < count($fenyePage->res_array); $i++) {
    $row = $fenyePage->res_array[$i];
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td>" .
        "<td><a onclick='return confirmDele({$row['id']})' href='empProcess1.php?flag=del&id={$row['id']}'>删除用户</a></td><td><a href='updateEmpUI1.php?id={$row['id']}'>修改用户</a></td></tr>";
}
echo "<h1>雇员信息列表 </h1>";
echo "</table>";
echo $fenyePage->navigate;//整个导航条都出来了
?>
<form action="empList1.php">
    跳转到:<input type="text" name="pageNow"/>
    <input type="submit" value="GO">
</form>
</html><br/>
<a href="empPrint.php">打印本页面</a>;<br/>
<a href="empManage1.php">返回主页面</a>;
