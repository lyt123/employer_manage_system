<?php
    function getLastTime(){
        if(!empty($_COOKIE['lastVisit'])){
            echo "你上次登陆时间是".$_COOKIE['lastVisit'];
            setcookie("lastVisit",date("Y-m-d  H:i:s"),time()+24*3600*30);
        }else{
            echo "你是第一次登陆";
            setcookie("lastVisit",date("Y-m-d  H:i:s"),time()+24*3600*30);
        }
    }
    function getCookieVal($key){

        if(empty($_COOKIE[$key])){
            return "";
        }else{
            return $_COOKIE[$key];
        }

    }
    function checkValidate()
    {
        session_start();
        if(empty($_SESSION['loginUser']))
        {
            header("Location:login1.php?errno=3");
        }
    }
?>