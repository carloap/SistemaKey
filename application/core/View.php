<?php if (!defined('APPPATH')) exit('No direct script access allowed');

require 'exceptions/InvalidViewException.php';

Class View {

	public function __construct() {
	
	}
	
	public function load($view, $vars=array()) {
		// Translate multidimensional variables to unidimensional (like in Codeigniter)
		if(is_array($vars)&&!empty($vars)) {
			foreach($vars as $key=>$val) {
				${$key} = $val; // this way is correct
			}
		}
		if( ! is_file(APPPATH . 'views/' . $view . '.php') ) {
			//exit('O arquivo de view parece ser inválido.');
			throw new InvalidViewException('O arquivo de view parece ser inválido: '.$view);
		}
		ob_start(); // start buffer
		include APPPATH . 'views/' . $view . '.php'; // include the viewer file - allows for multiple views with the same name
		$buffer = ob_get_contents();
		ob_end_clean(); // Empties the buffer and closes it - No output is sent
		return $buffer;
	}

}
