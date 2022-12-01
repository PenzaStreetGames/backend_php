<?php
//require "redis/RedisSessionHandler.php";
//$redis = new Redis();
//if ($redis->connect('redis', 6379) && $redis->select(0)) {
//    $handler = new RedisSessionHandler($redis);
//    session_set_save_handler($handler);
//}

session_start();