<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

/** 
 * Class to read and validate URI
 */

Class URI {

    public function detect_uri() {
        if (!isset($_SERVER['REQUEST_URI']) OR ! isset($_SERVER['SCRIPT_NAME'])) {
            return '';
        }
        // Initializes the current uri
        $uri = $_SERVER['REQUEST_URI'];
        
        
        if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
            $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
        } elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0) {
            $uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
        }
        
        // Checks if ends with a bar
        $uri_check = substr($uri, -1);
        if ($uri_check == "/") {
            $uri = substr($uri, 0, -1); // then, removes that bar
        }

        // Validates the uri
        return $this->_filter_uri($uri);
    }

    public function _filter_uri($uri) {
        $uri = urldecode($uri);
        
        $pos = strpos($uri, '?');
        if($pos!==false) { // se houver ocorrencia de "?", pegue apenas o que houver antes disso (aviso: php 5.3.0)
        	$uri = strstr($uri, '?', true);
        }
        
        $ftr_uri = strtr(trim($uri, '/'), array('//' => '/', '..' => ''));
        
        // Convert programmatic characters to entities
        $bad	= array('$',		"'",		'"',		'(',		')',		'%28',		'%29',		'<',		'>');
		$good	= array('&#36;',	'&#39;',	'&#34;',	'&#40;',	'&#41;',	'&#40;',	'&#41;',	'&#60;', 	'&#62;');
        
        return str_replace($bad, $good, $ftr_uri);
    }

}