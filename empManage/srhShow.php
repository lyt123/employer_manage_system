<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<?php
//该页面要显示准备修改的用户的信息.
require_once 'EmpService1.class.php';
$id=$_POST['srhId'];

//通过id来得到该用户的其它信息.
//查询数据库 ,条sqlHelper

$empService1=new EmpService();
$emp1=$empService1->getEmpById($id);

//显示
?>
<h1>查询到信息如下：</h1><br />

<table>
    <tr><td>id号</td><td><input readonly="readonly"  type="text" name="id" value="<?php echo $emp1->getId(); ?>" /></td></tr>
    <tr><td>名字</td><td><input type="text" name="name" value="<?php echo $emp1->getName(); ?>" /></td></tr>
    <tr><td>级别</td><td><input type="text" name="grade" value="<?php echo $emp1->getGrade(); ?>"/></td></tr>
    <tr><td>电邮</td><td><input type="text" name="email" value="<?php echo $emp1->getEmail(); ?>"/></td></tr>
    <tr><td>薪水</td><td><input type="text" name="salary" value="<?php echo $emp1->getSalary(); ?>"/></td></tr>
</table>
<a href="srhEmp1.php">返回查询页面</a>
</html>

