<?php
        require("include/top.php");
        $r=isset($_GET["r"])?($_GET['r']):("html");
        switch ($r){
            default:
            case "html":
                 echo TXT_ADDED.": ".BASE_LINK_URL."".$_GET['code'];
                break;
            case "xml":
                echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<response>\n    <data>".BASE_LINK_URL."".$_GET['code']."</data>\n</response>";
                break;
            case "json":
                echo "{data : \"".BASE_LINK_URL."".$_GET['code']."\"}";
                break;
            case "txt":
                echo BASE_LINK_URL.$_GET['code'];
                break;
        }
   
?>