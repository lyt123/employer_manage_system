
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/8
 * Time: 9:38
 */
require_once 'EmpService1.class.php';

$empService = new EmpService();
$res = $empService->getIdea();
echo "<table border='1px' cellspacing='0px'  width='700px'>";
echo "<tr><th>id</th><th>title</th><th>content</th></tr>";

for ($i = 0; $i < count($res); $i++) {
    $row = $res[$i];
    echo "<tr><td>{$row['idea_id']}</td><td>{$row['idea_title']}</td><td>{$row['idea_content']}</td></tr>";
}
echo "</table>";
