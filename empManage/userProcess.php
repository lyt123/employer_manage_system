<?php
/**
 * User: lyt123
 * Date: 2016/5/12
 * Time: 15:29
 */
require_once 'AdminService1.class.php';
$user_input_value=$_GET['user_input_value'];


$adminService=new AdminService();
$res=$adminService->userExist($user_input_value);//参数不能加引号，否则出错
//header('Content-Type:application/json; charset=utf-8');
if ($res) {

    if(!is_array($res)){
        echo json_encode([
            'status' => 20000,
            'response' => ''
        ]);
    }
        if (is_array($res)) {
            echo json_encode([
                'status' => 20000,
                'response' => 'nicenice'
            ]);
        }
} else {
    echo json_encode([
        'status' => 20000,
        'response' => '不存在'
    ]);
}