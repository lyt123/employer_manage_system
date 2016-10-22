<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<?php
	//该页面要显示准备修改的用户的信息.
	require_once 'EmpService1.class.php';
	$id=$_GET['id'];
	
	//通过id来得到该用户的其它信息.
	//查询数据库 ,条sqlHelper
	
	$empService=new EmpService();
	//$arr=$empService->getEmpById($id);
	$emp=$empService->getEmpById($id);
	
	//显示
?>
<h1>修改雇员</h1>
<form action="empProcess1.php" method="post">
<table>
<tr><td>id号</td><td><input readonly="readonly"  type="text" name="id" value="<?php echo $emp->getId(); ?>" /></td></tr>
<tr><td>名字</td><td><input type="text" name="name" value="<?php echo $emp->getName(); ?>" /></td></tr>
<tr><td>级别</td><td><input type="text" name="grade" value="<?php echo $emp->getGrade(); ?>"/></td></tr>
<tr><td>电邮</td><td><input type="text" name="email" value="<?php echo $emp->getEmail(); ?>"/></td></tr>
<tr><td>薪水</td><td><input type="text" name="salary" value="<?php echo $emp->getSalary(); ?>"/></td></tr>
<input type="hidden" name="flag" value="updateemp" />
<tr>
<td><input type="submit" value="修改用户" /></td>
<td><input type="reset"  value="重新填写" /></td>
</tr>
</table>
</form>
</html>
<?php
echo '<a href="empManage1.php">返回主页面</a>';
?>