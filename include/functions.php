<?php
/**
 * Generates a 6-character code composed of uppercase, lowercase, numbers, - and _
 * 
 * This method can generate 119877472 non repeted codes of 6 characters
 */
function generateCode(){
    $base="abcdefghijklmnopkrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-";
    $i=0;
    $c="";
    while (($c!="")&&(!validate::existCode($c))){
        $c="";
        while ($i<6){
            $c.=$base[rand(0,strlen($cadena_base)-1)];
            $i++;
        }
    }
    return $c;
}
function getUrl($code){
    global $db;
    $sql="select url from BUS_link where shortcode like '$code'";
    $result=$db->query($sql);
    if ($result!=false){
        $row = $result->fetch_object();
         if ($row){
           return $row->url;
         }
         else{
             return false;
         }
    }
    else{
        return false;
    }
    
}

function addVisit($code){
    global $db;
     $sql="Update BUS_link set visited=visited+1 where shortcode like '$code'";
    $result=$db->query($sql);
    return $result;
}
?>