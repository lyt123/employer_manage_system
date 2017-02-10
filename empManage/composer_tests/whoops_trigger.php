<?php
/* User:lyt123; Date:2017/2/10; QQ:1067081452 */
require '../vendor/autoload.php';

$whoops = new \Whoops\Run();
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

