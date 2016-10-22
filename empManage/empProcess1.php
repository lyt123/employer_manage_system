
<?php

require_once 'EmpService1.class.php';
//接收用户要删除的用户id
//创建了EmpService对象实例
$empService = new EmpService();

//先看看用户要分页还是删除某个雇员
if (!empty($_REQUEST['flag'])) {
    $flag = $_REQUEST['flag'];
    //如果$flag="del", 说明用户要执行删除请求
    if ($flag == "del") {
        //这是我们知道要删除用户
        $id = $_REQUEST['id'];
        //echo "你希望删除的用户id=$id";
        if ($empService->delEmpById($id) == 1) {
            //成功!
            header("Location: ok.php");
            exit();
        } else {
            //失败!
            header("Location: error.php");
            exit();
        }
    } else if ($flag == "addemp") {
        $name = $_POST['name'];
        $grade = $_POST['grade'];
        $email = $_POST['email'];
        $salary = $_POST['salary'];
        //完成添加->数据库.
        $res = $empService->addEmp($name, $grade, $email, $salary);
        if ($res == 1) {
            header("Location: ok.php");
            exit();
        } else {
            //失败!
            header("Location: error.php");
            exit();
        }
    }//处理修改请求
    else if ($flag == "updateemp") {
        //说明用户希望执行修改雇员
        //接收数据
        $id = $_POST['id'];
        $name = $_POST['name'];
        $grade = $_POST['grade'];
        $email = $_POST['email'];
        $salary = $_POST['salary'];
        //完成修改->数据库.
        $res = $empService->updateEmp($id, $name, $grade, $email, $salary);
        if ($res == 1) {
            echo "nice";
            exit();
        } else {
            //失败!
            echo 'fail';
            exit();
        }
    }
    else if($flag == "addIdea"){
        $title=$_POST['title'];
        $con=$_POST['con'];
        $res=$empService->storeIdea($title,$con);
        if($res==1)
        {
            echo '成功<br/>三秒后跳转回主界面';
            header("Refresh:3,url=http://localhost/myThings/empManage/empManage1.php");//这里要用http开头的地址才可以
        }
    }

    } /*else if ($flag == 'srhEmp') {
			$srhId = $_POST['srhId'];
			$res = $empService->srhEmp($srhId);
			if($res)
			{
				header("Location:srhShow.php");
			}*/
?>