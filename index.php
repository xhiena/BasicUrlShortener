<?php
/*********************************************************************
    index.php

    Basic basic basic index page with a little help
    
    TODO: make a css and give some style

    xhiena <xhiena@gmail.com>
    http://www.xhiena.net
    
**********************************************************************/

    require("include/top.php");
    ?><html><head><title>BUS - Basic URL Shortener</title></head>
    <body>
    <h1>BUS - Basic URL Shortener - Example page</h1>
    <h2>Using a form:</h2>
    example code:
        <div class="example">
        <?php
        $form="
        <form action=\"add.php\" method=\"get\">
            url:<input type=\"text\" name=\"u\"/>
            response format: <select name=\"r\">
                        <option>html</option>
                        <option>plain</option>
                        <option>xml</option>
                        <option>json</option>
                    </select>
            <input type=\"submit\" value=\"enviar\"/>
        </form>
        ";
         highlight_string($form);
         ?>
        </div>
        
        <?php echo $form;?>
    
    <h2>Using a direct link:</h2>
    The url has to be urlencoded
    Use: add.php?u=<?php echo urlencode("http://xhiena.net");?>&amp;r=RESPONSE_FORMAT"
    <a href="add.php?u=<?php echo urlencode("http://xhiena.net");?>&amp;r=html">Add xhiena.net</a>
    
    
    </body></html>