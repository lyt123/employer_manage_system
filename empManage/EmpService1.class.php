<?php

require_once 'SQLHelper1.class.php';
require_once 'Emp1.class.php';

class EmpService
{
    function getFenyePage($fenyePage)
    {
        $sql1 = "select * from emp  limit "
            . ($fenyePage->pageNow - 1) * $fenyePage->pageSize . "," . $fenyePage->pageSize;//获取将要展示的规定条数的记录
        $sql2 = "select count(id) from emp";//获取总id数
        $sqlHelper = new SqlHelper();
        $sqlHelper->execute_dql_fenye($sql1, $sql2, $fenyePage);
        //$sqlHelper->close_connect();
    }

    function delEmpById($id)
    {/*
        $sql = "delete from emp where id=$id";
        //创建SqlHelper对象实例
        $sqlHelper = new SqlHelper();
        //0, 1 ,2
        return $sqlHelper->execute_dml($sql);
*/

        try {
            $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $stmt = $db->prepare("DELETE FROM emp WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function updateEmp($id, $name, $grade, $email, $salary)
    {
      /*  $sql = "update emp set name='$name' , grade=$grade ,email='$email',salary=$salary where id=$id";
        $sqlHelper = new SqlHelper();
        $res = $sqlHelper->execute_dml($sql);
        //$sqlHelper->close_connect();
        return $res;*/
        try {
            $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $stmt = $db->prepare("UPDATE emp SET name = ?,grade = ?,email = ?,salary = ? WHERE id = ?");
            $stmt->execute(array($name, $grade, $email, $salary, $id));
            return $stmt->rowCount();
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function getEmpById($id)
    {

//        try {
            $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $stmt = $db->prepare("SELECT * FROM emp WHERE id=:id");
            $stmt->execute(array(':id' => $id));
            $arr = $stmt->fetch(PDO::FETCH_ASSOC);

            $emp = new Emp();
            $emp->setId($arr['id']);
            $emp->setName($arr['name']);
            $emp->setGrade($arr['grade']);
            $emp->setEmail($arr['email']);
            $emp->setSalary($arr['salary']);

            return $emp;
//        } catch(PDOException $e) {
//            $code = $e->getCode();
//            $message = $e->getMessage();
//            echo "error code is {$code}, error message is {$message}, the above is the wrong things.";
//            exit();
//        }
        /*

        $sql = "select * from emp where id=$id";
        $sqlHelper = new SqlHelper();
        $arr = $sqlHelper->execute_dql2($sql);//获得该id的雇员的信息
        // $sqlHelper->close_connect();;
        //二次封装.$arr->Emp对象实例[演示..]
        //创建 Emp对象实例
        $emp = new Emp();
        $emp->setId($arr[0]['id']);
        $emp->setName($arr[0]['name']);
        $emp->setGrade($arr[0]['grade']);
        $emp->setEmail($arr[0]['email']);
        $emp->setSalary($arr[0]['salary']);
        return $emp;*/
    }

    function addEmp($name, $grade, $email, $salary, $balance)
    {
 /*       $sql1 = "insert into emp (name,grade,email,salary) values('$name',$grade,'$email',$salary)";
        $sql2 = "insert into account balance value $balance";
        //同sqlHelper完成添加
        try {
            $sqlHelper = new SqlHelper();
            $res = $sqlHelper->execute_dml($sql1);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        //$sqlHelper->close_connect();
        return $res;
 */

        try {
            $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $db->beginTransaction();

            $stmt_idea = $db->prepare("INSERT INTO emp (name,grade,email,salary) VALUES (:name,:grade,:email,:salary)");
            $stmt_idea->execute(array(':name' => $name, ':grade' => $grade, ':email' => $email, ':salary' => $salary));

            $stmt_account = $db->prepare("INSERT INTO account (balance) VALUES (:balance)");
            $stmt_account->bindValue(':balance', $balance, PDO::PARAM_INT);
            $stmt_account->execute();

            if($stmt_idea->rowCount() && $stmt_account->rowCount()) {
                $db->commit();
                return 1;
            }
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function writeIdea()
    {
        include('FCKeditor/fckeditor.php');

        $sBasePath = $_SERVER['PHP_SELF'];//echo $_SERVER;
        $sBasePath = dirname($sBasePath) . '/';//获取除文件名后剩下的路径名=/myThings/empManage/FCKeditor/
        $ed = new FCKeditor('con');
        $ed->BasePath = $sBasePath;
        $ed->ToolbarSet = 'Small';//有多种风格，default显示比较全，可在fckconfig.js中配置
        return $ed;
    }

    function storeIdea($title,$con,$UBB)
    {
        $title=urlencode($title);//这里通过post提交的input中的title要经过编码后才能存到数据库中，可能是浏览器和数据库的编码不同所致
        $con=urlencode($con);
        $UBB=urlencode($UBB);
//        $sql = "insert into idea (idea_title,idea_content,idea_UBB) values ('$title','$con','$UBB')";//这里存储的内容格式为<p>content</p>
        //同sqlHelper完成添加
        try {
            $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $stmt = $db->prepare("INSERT INTO idea (idea_title,idea_content,idea_UBB) VALUES (:idea_title,:idea_content,:idea_UBB)");
            $stmt->execute(array(':idea_title' => $title, ':idea_content' => $con, ':idea_UBB' => $UBB));
            return $stmt->rowCount();
        } catch(PDOException $e) {
            die($e->getMessage());
        }
//        $res = $sqlHelper->execute_dml($sql);
//        return $res;
    }

    function getIdea()
    {
        $sql = "select * from idea";
        $sqlHelper = new SqlHelper();
        $res = $sqlHelper->execute_dql2($sql);
        //echo $res[0]['idea_title'];
        //exit();
        return $res;
    }

    function srhKey($key){
       /* $key[0]=urlencode($key[0]);//数据库中存的是编码后的idea_content，因此须将$key同样编码后再去查找
        $key[1]=urlencode($key[1]);//多关键字搜索可以把like拼接起来
        $sql="select * from idea where idea_content like '%$key[0]%' or idea_content like '%$key[1]%'";

        $sqlHelper = new SqlHelper();
        $res=$sqlHelper->execute_dql2($sql);
        var_dump($res);exit();
        return $res;*/

        $key[0]=urlencode($key[0]);//数据库中存的是编码后的idea_content，因此须将$key同样编码后再去查找
        $key[1]=urlencode($key[1]);//多关键字搜索可以把like拼接起来
        try {
            $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $stmt = $db->prepare("SELECT * FROM idea WHERE idea_content LIKE ? or idea_content LIKE ?");
            $stmt->bindValue(1, "%$key[0]%", PDO::PARAM_STR);
            $stmt->bindValue(2, "%$key[1]%", PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    function empPrint(){
        $sql="select * from emp";

        $sqlHelper = new SqlHelper();
        $res=$sqlHelper->execute_dql2($sql);
        return $res;
    }

}
/*






    //根据id好获取一个雇员的信息


    //添加一个方法



    //一个函数可以获取共有多少页
    function getPageCount($pageSize){

        //需要查询$rowCount
        $sql="select count(id) from emp";
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dql($sql);

        //这样就可以计算$pageCount
        if($row=mysql_fetch_row($res)){
            $pageCount=ceil($row[0]/$pageSize);
        }
        //释放资源关闭连接
        mysql_free_result($res);
        //关闭连接
        $sqlHelper->close_connect();
        return $pageCount;
    }

    //一个函数可以获取应当显示的雇员信息
    function getEmpListByPage($pageNow,$pageSize){

        $sql="select * from emp limit ".($pageNow-1)*$pageSize.",$pageSize";


        $sqlHelper=new SqlHelper();
        //这里的$res就是一个二维数组
        $res=$sqlHelper->execute_dql2($sql);

        //释放资源和关闭连接
        //关闭连接
        $sqlHelper->close_connect();

        return $res;

    }

    */