<?php
/*********************************************************************
    added.php

    This page shows the full shortcoded url of an added link

    xhiena <xhiena@gmail.com>
    http://www.xhiena.net
    
**********************************************************************/
    require("include/top.php");
    $f=isset($_GET["r"])?($_GET['r']):("html");
    try{
        $addedlink=Link::withShortCode($_GET['code']);
        echo $addedlink->getLink($f);
    }
    catch(Exception $e){
         echo $e->getMessage();
    }
   
?>