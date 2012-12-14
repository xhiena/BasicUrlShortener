<?php
/*********************************************************************
    link.class.php

    The most important class! Don't play with fire please.

    xhiena <xhiena@gmail.com>
    http://www.xhiena.net
    
**********************************************************************/

class Link{
    private $id;
    private $url;
    private $shortcode;
    private $visits;
    
    
    //loaders
    public function __construct(){}
    
    /*  The constructor is empty because I need to load a link by any of his fields (id, shortcode or url)
        Using the Factory Pattern (the with* functions) I can make a "multiconstructor"  
    */
    public static function withID( $id ) {
    	$link_instance = new self();
    	$link_instance->loadByID( $id );
    	return $link_instance;
    }
    public static function withShortCode( $shortcode ) {
    	$link_instance = new self();
    	$link_instance->loadByShortCode( $shortcode );
    	return $link_instance;
    }
    public static function withUrl( $url ) {
    	$link_instance = new self();
    	$link_instance->loadByUrl( $shortcode );
    	return $link_instance;
    }
    
    function loadByID($id){
       $this->loadByField($id);
    }
    
    function loadByShortCode($shortcode){
        $this->loadByField($shortcode,"shortcode","s");
    }
      
    function loadByUrl($url){
        $this->loadByField($url,"url","s");
    }
    
    //Getters
    
    function getID(){
        return $this->id;
    }
    function getUrl(){
        return $this->url;
    }
    function getShortCode(){
        return $this->shortcode;
    }
    function getVisits(){
        return $this->visits;
    }
    
    /** 
     * The real loader
     * 
     * It makes the query to load 1 item
     * 
     * expects:
     *      $value: value to search to load the item data
     *      $field: mysql table field where search (default: id)
     *      $type: type of the $value (i: int, d: double,s: string,b: blob). It's for the query bindParam
     */
    private function loadByField($value,$field="id",$type="i"){
        global $db;
        $sql="select id,url,shortcode,visits from BUS_link where ".$field." = ? Limit 1";
        $stmt=$db->prepare($sql);
        $stmt->bindParam($type,$value);
        $result=$stmt->execute();
        if ($result!=false):
            $row = $result->fetch_object();
             if ($row):
                $this->id=$row->id;
                $this->url=$row->url;
                $this->shortcode=$row->shortcode;
                $this->visits=$row->visits;
                return true;
             endif;
        endif;
        $stmt->close(); 
        return false;
    }
    
    /**
     * Add and return a link to the database
     */
     
     static function create($url){
        global $db;
        $url=urldecode($_GET['u']);
        //check if the url is wellformed
        if (!validate::url($url)){
            throw new Exception(TXT_ERROR_URL_FORMAT);
        }
        $code=generateCode();
        $sql="insert into BUS_link values ('','?','?','0')";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("ss",$url,$code);
        if($stmt->execute($sql)):
            return self::loadByUrl($url);
        else:
            return false;
        endif;
     }
    
    /**
     * returns the shorted url
     * 
     * $format= html|xml|json|txt
     */
    public function getLink($format="html"){
        switch ($format){
            default:
            case "html":
                 echo TXT_ADDED.": ".BASE_LINK_URL."".$this->shortcode;
                break;
            case "xml":
                echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<response>\n    <data>".BASE_LINK_URL."".$this->shortcode."</data>\n</response>";
                break;
            case "json":
                echo "{data : \"".BASE_LINK_URL."".$this->shortcode."\"}";
                break;
            case "txt":
                echo BASE_LINK_URL.$this->shortcode;
                break;
        }
    }
    
}