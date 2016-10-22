
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
echo "<tr><th>id</th><th>title</th><th>content</th><th>UBB</th></tr>";

for ($i = 0; $i < count($res); $i++) {
    $row = $res[$i];
    $title=urldecode($row['idea_title']);
    $content=urldecode($row['idea_content']);
    $UBB=urldecode($row['idea_UBB']);
    $UBB=preg_replace("/\[url\](.*)\[\/url\]/","<a href=\\1>\\1</a>",$UBB);//将UBB代码[url]转化为超链接
    $UBB=preg_replace("/\[b\](.*)\[\/b\]/","<b>\\1</b>",$UBB);
    echo "<tr><td>{$row['idea_id']}</td><td>{$title}</td><td>{$content}</td><td>{$UBB}</td></tr>";
    //UBB的作用在于小型留言板中可以嵌入加粗、变超链接等效果，直接将其形成的文本保存到数据库中，较为方便，但在这里，直接在输出之时
    //给内容加上<a></a>标签更为简洁
}
echo "</table>";
?>
<br/>
<br/>
请输入两个关键字，用空格隔开：
<form action="showSrhKey.php" method="post">
    <input type="text" name="srhKey" /><br/><br/>
    <input type="submit" value="搜索content" />
</form>
