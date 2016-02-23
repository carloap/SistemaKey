<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

/** 
 * Class to handle URI
 */

Class Router {

    private $config;
    private $uri;
    private $class = '';
    private $method = 'index';
    private $directory = '';
    private $segments = array();
    private $jumpSegment = 2;

    public function __construct() {
        $this->config = loadClass('Config', 'core');
        $this->uri = loadClass('URI', 'core');
    }

    // Getters e Setters
    public function setClass($class) {
        $this->class = $class;
    }
    public function setMethod($method) {
        $this->method = $method;
    }
    public function setDirectory($dir) {
        $this->directory = $dir;
    }

    public function getClass() {
        return $this->class;
    }
    public function getMethod() {
        return $this->method;
    }
    public function getDirectory() {
        return $this->directory;
    }
    public function getSegments() {
        return $this->segments;
    }
    public function getJumpSegment() {
        return $this->jumpSegment;
    }
    
    
    /** 
     * Set the route mapping
     * This function determines what should be charged based on the requested URI
     * Well as pre-defined routes in the configuration file... YES!!
     */
    public function setRoute() {
        // Initializes the segmentation of the current URL
        $uri_x = explode("/", $this->uri->detect_uri());
        
        $pos = 0;
        foreach($uri_x as $x) {
            if(is_dir(APPPATH.'controllers/'.$this->getDirectory().$x)){ // is a directory
                $this->setDirectory(trim($this->getDirectory() . $x.'/'));
                $pos++;
                continue;
            } 
            if(is_file(APPPATH.'controllers/'.$this->getDirectory().$x.'.php')){ // is a file and also a class
                $this->setClass(trim($x));
                $pos++;
                continue;
            }
        }
        $this->setMethod(isset($uri_x[$pos]) ? $uri_x[$pos] : 'index'); // Sets the current method, otherwise sets 'index' as default
        $this->jumpSegment = $pos+1; // Defines a pointer of an array, in this case the array 'segments' 
        $this->segments = $uri_x; // The array containing the URI
    }

}