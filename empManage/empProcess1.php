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
            echo '删除成功';
            exit();
        } else {
            //失败!
            echo '删除失败';
            exit();
        }
    } else if ($flag == "addemp") {
        $name = $_POST['name'];
        $grade = $_POST['grade'];
        $email = $_POST['email'];
        $salary = $_POST['salary'];
        $balance = $_POST['balance'];
        //完成添加->数据库.
        $res = $empService->addEmp($name, $grade, $email, $salary, $balance);
        if ($res == 1) {
            echo '成功<br/>1秒后跳转回主界面';
            header("Refresh:1,url=http://localhost/emp/empManage/empManage1.php");
            exit();
        } else {
            //失败!
            echo '插入失败';
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
    } else if ($flag == "addIdea") {

        $title = $_POST['title'];
        $con = $_POST['con'];
        $UBB = $_POST['UBB'];
        $res = $empService->storeIdea($title, $con, $UBB);

        if ($res == 1) {
            echo '成功<br/>1秒后跳转回主界面';
            header("Refresh:1,url=http://localhost/emp/empManage/empManage1.php");//这里要用http开头的地址才可以
        }
    }else if($flag=='sendMail') {
       /* require_once "email.class.php";
        //******************** 配置信息 ********************************
        $smtpserver = "smtp.qq.com";//SMTP服务器
        $smtpserverport = 25;//SMTP服务器端口
        $smtpusermail = "1067081452@qq.com";//SMTP服务器的用户邮箱
        $smtpemailto = $_POST['toemail'];//发送给谁
        $smtpuser = "1067081452";//SMTP服务器的用户帐号(不用写后缀)
        $smtppass = "vppuxfvvzxskbehf";//SMTP服务器的用户密码
        $mailtitle = $_POST['title'];//邮件主题
        $mailcontent = "<h1>" . $_POST['content'] . "</h1>";//邮件内容
        $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
        $smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = true;//是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
        if ($state == "") {
            echo "对不起，邮件发送失败！请检查邮箱填写是否有误。";
            echo "<a href='sendMail.php'>点此返回</a>";
            exit();
        } else {
            echo "恭喜！邮件发送成功！！";
            echo "<a href='sendMail.php'>点此返回</a>";
        }*/
       /* $to = '3310113264@qq.com';
        $subject = "this is title";
        $body = "this is body";
        date_default_timezone_set("America/Detroit");//设定时区东八区

        $mail             = new PHPMailer(); //new一个PHPMailer对象出来
        $body             = @eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
        $mail->CharSet ="UTF-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP(); // 设定使用SMTP服务
        $mail->SMTPDebug  = 1;                     // 启用SMTP调试功能
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
//        $mail->SMTPSecure = "ssl";//"ssl";      // 安全协议,163用ssl,hotmail gmail用tls.
        $mail->Host       = "smtp.163.com";      // SMTP 服务器
        $mail->Port       = 25;//25,465,587;                   // SMTP服务器的端口号
        $mail->Username   = "ajudbfef@163.com";  // SMTP服务器用户名
        $mail->Password   = "1067081452";            // SMTP服务器密码

        $mail->SetFrom('adudbfef@163.com', 'lyt');//发送邮件的邮箱和用户名
        $mail->AddReplyTo("myMail@hotmail.com","Zhixiong");//没啥用
        $mail->Subject    = $subject;  //邮件题目
        $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        $mail->MsgHTML($body);  //邮件内容
        $address = $to;     //收件人地址
        $mail->AddAddress($address, "Dear User");

        //$mail->AddAttachment("images/phpmailer.gif");      // attachment
        //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
        if(!$mail->Send()) {
            var_dump( "Mailer Error: " . $mail->ErrorInfo); //调用错误提示.
        } else {
            ;//echo "Message sent successfully！";//你不想在页面中出现这句吧.
        }*/
        $to_email = $_POST['toemail'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        require_once('class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->Port = 25;                                    // TCP port to connect to

        $mail->setFrom('lyt@192.168.1.152', 'lyt');
        $mail->addAddress($to_email, '林宇堂');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
////$mail->addReplyTo('info@example.c/*om', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
        /*
        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); */   // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $title;
        $mail->Body = $content;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }
    }
}
?>

