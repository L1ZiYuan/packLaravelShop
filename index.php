<?php
/**
 * 测试composer包创建controller是否可访问
 */
require './vendor/autoload.php';

use Pack\LaravelShops\Http\Controller\QjunitController;

$a  = new QjunitController();
var_dump($a->index());