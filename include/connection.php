<?php
/*********************************************************************
    connection.php

    Makes the connection with the database

    xhiena <xhiena@gmail.com>
    http://www.xhiena.net
    
**********************************************************************/

$db=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME); 
if ($db->connect_errno) {
    die(TXT_DB_ERROR."<br />".$db->connect_error);
}
?>