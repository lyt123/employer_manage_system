<?php

session_start();
$checkCode="";
for($i=0;$i<4;$i++){
	$checkCode.=dechex(rand(1,15));
}
//生成验证码存储于session中，后面的代码只是在增加干扰
$_SESSION["myCheckCode"] =$checkCode;

    $img=imagecreatetruecolor(140,30);
    $bgcolor=imagecolorallocate($img, 0,0,0);  //RGB黑色标识符
	imagefill($img,0,0,$bgcolor);

    $white=imagecolorallocate($img, 255,255,255); //RGB白色标识符
    $blue=imagecolorallocate($img, 0,0,255); //RGB白色标识符
    $red=imagecolorallocate($img, 255,0,0); //RGB白色标识符
    $green=imagecolorallocate($img, 200,0,0); //RGB灰色标识符
    //开始作图
    //imagefill($im,0,0,$gray);


//加入干扰象素
    for($i=0;$i<20;$i++){
		imageline($img,rand(0,110),rand(0,30),rand(0,110),rand(0,30),imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255)));
        //$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
        //imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
    }
	imagestring($img,rand(60,80),rand(2,80),rand(2,10), $checkCode, $white);

	Header("Content-type: image/png");
    //输出验证图片
    imagepng($img);
    imagedestroy($img);

/*//通知浏览器将要输出PNG图片 
    
    //准备好随机数发生器种子  
    srand((double)microtime()*1000000); 
    //准备图片的相关参数   
    $im = imagecreate(62,20); 
    $black = ImageColorAllocate($im, 0,0,0);  //RGB黑色标识符 
    $white = ImageColorAllocate($im, 255,255,255); //RGB白色标识符 
    $gray = ImageColorAllocate($im, 200,200,200); //RGB灰色标识符 
    //开始作图     
    imagefill($im,0,0,$gray); 


    while(($randval=rand()%100000)<10000);{ 
		
        $_SESSION["login_check_num"] = $randval; 
        //将四位整数验证码绘入图片  
        imagestring($im, 5, 10, 3, $randval, $black); 
    } 
    //加入干扰象素    
    for($i=0;$i<200;$i++){ 
        $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255)); 
        imagesetpixel($im, rand()%70 , rand()%30 , $randcolor); 
    } 
	Header("Content-type: image/PNG"); 
    //输出验证图片 
    ImagePNG($im); 
    //销毁图像标识符 
    //ImageDestroy($im); 
*/
?>