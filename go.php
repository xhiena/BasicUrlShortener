<?php
    require("include/top.php");
    $u_sql=$db->real_escape_string($_GET['u']);
    $u=getUrl($u_sql);
    if ($u){
        addVisit($u_sql);
        header("location: ".$u);
    }
    
    
?>