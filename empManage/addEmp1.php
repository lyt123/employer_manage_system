<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<img src="./images/1.GIF" title="test" alt="haha"/>
<hr/>
<h1>添加雇员</h1>
<form action="empProcess1.php" method="post">
<table>
<tr><td>名字</td><td><input type="text" name="name"/></td></tr>
<tr><td>级别</td><td><input type="text" name="grade"/></td></tr>
<tr><td>电邮</td><td><input type="text" name="email"/></td></tr>
<tr><td>薪水</td><td><input type="text" name="salary"/></td></tr>
<tr><td>收支</td><td><input type="text" name="balance"/></td></tr>
<input type="hidden" name="frontent" value="yes" />
<tr>
<td><img src="aa.jpg" title="hah" alt="heh"></td>
<td><input type="submit" value="添加用户" /></td>
<td><input type="reset"  value="重新填写" /></td>
</tr>
</table>
</form>
<a href="empManage1.php">返回管理页面</a>
</html>
