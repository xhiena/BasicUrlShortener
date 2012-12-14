<?php
/*********************************************************************
    functions.php

    Here are the functions for general use
    
    Updated: the validation functions are now in the validate class

    xhiena <xhiena@gmail.com>
    http://www.xhiena.net
    
**********************************************************************/
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
?>