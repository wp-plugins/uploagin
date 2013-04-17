<?php
/**
 * Plugin Name: Uploagin
 * Plugin URI: http://www.sujinc.com/lab/uploagin/
 * Description: 
 * Version: 1.0
 * Author: Sujin 수진 Choi 최
 * Author URI: http://www.sujinc.com/
 * License: GPLv2 or later
 * Text Domain: uploagin
 */

# 직접 접근을 막는다요
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) die ('Please do not load this page directly. Thanks!');

require_once('fw_sujin_puglin.php');
require_once('functions.php');

/*
if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && eregi("^[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}$",$_SERVER['HTTP_X_FORWARDED_FOR'])){
$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
$ip = getenv("REMOTE_ADDR");
}
return $ip;
*/