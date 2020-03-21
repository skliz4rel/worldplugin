<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*Add at the begining of the file*/
//Please note that you can  use this constant when your app is on azure. It would use the environment variables to
//get the connection information for azure. This is when you are using Mysql-inapp in azure 
//NOte that Mysql-inapp is not good for production.
//If you are hosting this on any other server kindly refer to constant1.inc
//It is very easy and straight forward

$connectstr_dbhost = '';
$connectstr_dbname = '';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';

foreach ($_SERVER as $key => $value) {
    if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
        continue;
    }
    
    $connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
    $connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
    $connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
    $connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}


define("DNS","mysql:host=".$connectstr_dbhost.";dbname=".$connectstr_dbname.";charset=utf8");

define("DATABASE", $connectstr_dbname);

define("USERNAME", $connectstr_dbusername);

define("PASSWORD", $connectstr_dbpassword);

define("PORT",49836);

?>
