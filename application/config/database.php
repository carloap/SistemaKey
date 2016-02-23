<?php if ( ! defined('APPPATH')) exit('No direct script access allowed.');
/**
 * Arquivo de configuração de banco de dados.
 * Neste arquivo, são informados os dados de conexão com os bancos de dados
 *
 * @package          Thevelopment
 * @author           Carlos Alberto
 * @copyright        Copyright (c) 2013 - 2014, Thevelopment (http://thevelopment.com.br/)
 * @license          http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @since            Version 1.0
 * @filesource
 */

// Variavel que define o grupo de CONEXÃO PADRÃO para ser utilizado nas models DAO
$db['active_group'] = 'mysql';


// Variaveis de conexão com o banco de dados
$db['mysql'] = array(
		'dbdrive'  => 'mysql',	
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'sistemakey',
		'persist'  => false
);
