<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

/**
 * Set the app configurations here
 */

require 'exceptions/LoadConfigFileException.php';
require 'exceptions/MalFormattedConfigFileException.php';

Class Config {

	private $config_file = 'config/config.php';
	private $config = array();

	function __construct() {
		try{
			$this->load_config();
		} catch (LoadConfigFileException $e) {
			die($e->getMessage());
		} catch (MalFormattedConfigFileException $e) {
			die($e->getMessage());
		}
	}

	function getConfig() {
		return $this->config;
	}
	
	function getDefaultController() {
		return $this->config['defaul_controller'];
	}

	function load_config() {
		// Sets the location of the configuration file
		$this->config_file = APPPATH.$this->config_file;

		if ( file_exists($this->config_file) ) {
			require($this->config_file);
			if ( !is_array($config) ) {
				throw new MalFormattedConfigFileException('The configuration file is badly formatted!');
			}
		} else {
			throw new LoadConfigFileException('The configuration file was not found!');
		}
		
		// defines the new data configurations
		$this->config=$config;
		return;
	}

}
