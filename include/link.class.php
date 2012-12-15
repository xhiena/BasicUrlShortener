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
    
    /*  
        The constructor is empty because I need to load a link by any of his fields (id, shortcode or url)
        Using the Factory Pattern (the with* functions) I can make a "multiconstructor"  
    */
    
    /** loader by ID */
    public static function withID( $id ) {
    	$link_instance = new self();
    	$link_instance->loadByID( $id );
    	return $link_instance;
    }
    
    /** loader by shortcode */ 
    public static function withShortCode( $shortcode ) {
    	$link_instance = new self();
    	$link_instance->loadByShortCode( $shortcode );
    	return $link_instance;
    }
    
    /** loader by url */
    public static function withUrl( $url ) {
    	$link_instance = new self();
    	$link_instance->loadByUrl( $url );
    	return $link_instance;
    }
    
    protected function loadByID($id){
       $this->loadByField($id);
    }
    
    protected function loadByShortCode($shortcode){
        $this->loadByField($shortcode,"shortcode","s");
    }
      
    protected function loadByUrl($url){
        $this->loadByField($url,"url","s");
    }
    
    //Getters
    
    /** returns the id */
    function getID(){
        return $this->id;
    }
    
    /** returns the url */
    function getUrl(){
        return $this->url;
    }
    
    /** returns the shortcode */
    function getShortCode(){
        return $this->shortcode;
    }
    
    /** returns the visits */
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
    protected function loadByField($value,$field="id",$type="i"){
        global $db;
        $sql="select id,url,shortcode,visits from BUS_link where ".$field." = ? Limit 1";
        $stmt=$db->prepare($sql);
        $stmt->bind_param($type,$value);
        $result=$stmt->execute();
        $stmt->store_result();
        if (($result!=false) && ($stmt->num_rows==1)):
            $stmt->bind_result($this->id, $this->url,$this->shortcode,$this->visits);
            $stmt->fetch();
            return true;
        else:
            throw new Exception(TXT_ERROR_NOT_FOUND);
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
        //check if exist the url
        if (validate::existUrl($url)){
            //if a url exists don't create a new link
            //this can be done because this script is for personal use
            //in case of various users use the aplication
            //is needed to create new link if the user don't have it
            //in this case we need to modify the existUrl function.
            return self::withUrl($url);
        }
        $code=generateCode();
        $sql="insert into BUS_link (url, shortcode,visits) values (?,?,?)";
        $stmt=$db->prepare($sql);
        $visits=0;
        $stmt->bind_param("ssi",$url,$code,$visits);
        if($stmt->execute()):
            $stmt->close(); 
            return self::withUrl($url);
        else:
            echo "error".$db->error;
            $stmt->close(); 
            throw new Exception(TXT_ERROR_CREATE);
        endif;
     }
    
    /**
     * returns the shorted url
     * 
     * $format= html|xml|json|plain
     * 
     */
    public function getLink($format="html"){
        $return_value="";
        switch ($format){
            default:
            case "html":
                 $return_value= "<p>".TXT_ADDED.": ".BASE_LINK_URL."".$this->shortcode."</p>";
                break;
            case "xml":
                $return_value= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<response>\n    <data>".BASE_LINK_URL."".$this->shortcode."</data>\n</response>";
                break;
            case "json":
                $return_value= "{data : \"".BASE_LINK_URL."".$this->shortcode."\"}";
                break;
            case "plain":
                $return_value= BASE_LINK_URL.$this->shortcode;
                break;
        }
    }
    
    /**
     * Adds a visit to the link
     */
     public function addVisit(){
         global $db;
         $this->visits++;
         $sql="Update BUS_link set visits=? where id = ?";
         $stmt=$db->prepare($sql);
         $stmt->bind_param("i",$this->visits);
         $ok=$stmt->execute($sql);
         $stmt->close(); 
         return $ok;
     }
}