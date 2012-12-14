<?php
/*********************************************************************
    config-sample.php

    An example of the config
    
    You have to create include/config.php and copy this content, editing with your settings
    
    xhiena <xhiena@gmail.com>
    http://www.xhiena.net
    
**********************************************************************/

//database connection
define("DB_SERVER","localhost");
define("DB_USER","user");
define("DB_PASS","pass");
define("DB_NAME","name");

//default language of the app - name of the language file in include/lang
define("APP_LANG","en-gb");

//base url - the shorted url will be BASIC_LINK_URL+SHORTCODE
define("BASE_LINK_URL","http://go.xhiena.net/");
?>