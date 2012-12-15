<?php
/*********************************************************************
    add.php

    This page creates the shortcode link
    
    parameters:
        in $_GET["u"] a urlencoded url
        in $_GET["r"] the output format (html, plain, xml, json)

    xhiena <xhiena@gmail.com>
    http://www.xhiena.net
    
**********************************************************************/
    require("include/top.php");
    try{
        $new_link=Link::create($_GET["u"]);
        $f=isset($_GET["r"])?($_GET["r"]):("");
        $u=$new_link->getShortCode();
        header("location: /added/".$f."/".$u);
    }
    catch(Exception $e){
         echo $e->getMessage();
    }
?>