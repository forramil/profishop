<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'settings.php'; 
$config['protocol'] = 'smtp';
$config['smtp_host'] = $smtp_host;
$config['smtp_port'] = $smtp_port;
$config['smtp_user'] = $smtp_user;
$config['smtp_pass'] = $smtp_pass;
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';

?>