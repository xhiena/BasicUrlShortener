<?php
    require("include/top.php");
    $u_sql=urldecode($_GET['u']);
    $formatos_return=Array("html","xml","json","txt");
    $r=isset($_GET["r"])?($_GET['r']):($formatos_return[0]);
    $r=(in_array($r,$formatos_return))?($r):($formatos_return[0]);
    $u=addUrl($u_sql);
    if ($u){
        header("location: /added/".$r."/".$u);
    }
?>