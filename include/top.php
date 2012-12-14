<?php
/*********************************************************************
    top.php

    The includes and requires for the application
    
    This file MUST be included in all pages

    xhiena <xhiena@gmail.com>
    http://www.xhiena.net
    
**********************************************************************/
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once("config.php");
    require_once("lang/".APP_LANG.".php");
    require_once("connection.php");
    require_once("functions.php");
    require_once("link.class.php");
    require_once("validate.class.php");
?>