<?php
/*********************************************************************
    go.php

    This page redirects to the long url

    Expects:
        in $_GET["u"] the shortcode
    
    
    xhiena <xhiena@gmail.com>
    http://www.xhiena.net
    
**********************************************************************/
    require("include/top.php");
    $requested_link=Link::withShortCode($_GET['u']);
    $requested_link->addVisit();
    header("HTTP/1.1 301 Moved Permanently");
    header("location: ".$requested_link->getLink("plain"));
?>