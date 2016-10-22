function ajax(url, fnSucc, fnFaild)
{
    //1.创建Ajax对象
    if(window.XMLHttpRequest)
    {
        var oAjax=new XMLHttpRequest();
    }
    else
    {
        var oAjax=new ActiveXObject("Microsoft.XMLHTTP");
    }

    //2.连接服务器（打开和服务器的连接）
    oAjax.open('GET', url, true);


    //3.发送
    oAjax.send();

    //4.接收
    oAjax.onreadystatechange=function ()
    {
        if(oAjax.readyState==4)
        {
            if(oAjax.status==200)
            {
                //alert('成功了：'+oAjax.responseText);
                fnSucc(oAjax.responseText);
            }
            else
            {
                //alert('失败了');
                if(fnFaild)
                {
                    fnFaild(oAjax.status);
                }
            }
        }
    };
}

window.onload=function(){
    user_input=document.getElementById('user_input');
    user_input.onblur=function(){
        user_input=document.getElementById('user_input');
        user_input_value=user_input.value;
        ajax('userProcess.php?user_input_value='+user_input_value,function(result){
            result = JSON.parse(result);
            if(result.status == 20000)
                document.getElementById('existCon').innerHTML=result.response;
        }, function (errno) {
            document.getElementById('existCon').innerHTML='读取失败:'+errno;
        });
    };
};
