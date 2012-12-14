<?php
function addUrl($url){
    global $db;
    if (!checkUrl($url)){
        throw new Exception(TXT_ERROR_URL_FORMAT);
    }
    $code=getCode();
    $sql="insert into link values ('','$url','$code','0')";
    if($db->query($sql)){
        return $code;
    }
    else{
           echo $db->error;
        return false;
    }
}

function checkUrl($url){
    //return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    return true;
}
function getCode(){
    $cadena_base="abcdefghijklmnopkrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_-";
    $i=0;
    $c="";
    while ($i<6){
        $c.=$cadena_base[rand(0,strlen($cadena_base)-1)];
        $i++;
    }
    if (getUrl($c)!=false){
        return getCode();
    }
    else return $c;
}
function getUrl($code){
    global $db;
    $sql="select url from link where shortcode like '$code'";
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
     $sql="Update link set visited=visited+1 where shortcode like '$code'";
    $result=$db->query($sql);
    return $result;
}
?>