<?php
/*********************************************************************
    validate.class.php

    the class with the validadions.

    xhiena <xhiena@gmail.com>
    http://www.xhiena.net
    
**********************************************************************/

class validate{
    /** 
     * validates if a url is semantically correct
     * The regular expresion to validate a url is from http://phpcentral.com/208-url-validation-in-php.html
    */
    static function url($url){
        // SCHEME
        $urlregex = "^(https?|ftp)\:\/\/";
        // USER AND PASS (optional)
        $urlregex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";
        // HOSTNAME OR IP
        //$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*"; // http://x = allowed (ex. http://localhost, http://routerlogin)
        //$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)+"; // http://x.x = minimum
        $urlregex .= "([a-z0-9+\$_-]+\.)*[a-z0-9+\$_-]{2,3}"; // http://x.xx(x) = minimum
        //use only one of the above
    
        // PORT (optional)
        $urlregex .= "(\:[0-9]{2,5})?";
        // PATH (optional)
        $urlregex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";
        // GET Query (optional)
        $urlregex .= "(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?";
        // ANCHOR (optional)
        $urlregex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
        
        //add the delimiters for preg_match
        $urlregex="/".$urlregex."/i";
        return preg_match($urlregex, $url);
    }
    static function existCode($code){
        global $db;
        $sql="select id from BUS_link where shortcode like ?";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("s",$code);
        $result=$stmt->execute();
        if (false!=$result) return true;
        return false;
    }
    
}    

?>