<?php
/**
 * User: lyt123
 * Date: 2016/5/12
 * Time: 10:20
 */
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=lyt123.xls");

require_once 'EmpService1.class.php';

$empService=new EmpService();
$res=$empService->empPrint();
echo "<table border='5px' cellspacing='2px'  width='1000px'>";
echo "<tr><td colspan='5'>雇员信息列表 </td></tr>";
echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><</tr>";

for($i=0;$i<count($res);$i++){
    $row=$res[$i];
    echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td></tr>";
}
echo "</table>";
