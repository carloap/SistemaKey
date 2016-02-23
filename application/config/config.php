<?php if ( ! defined('APPPATH')) exit('No direct script access allowed.');
/**
 * Arquivo de definição de configuração do sistema.
 * Neste arquivo, são informados caracteristicas e comportamentos do sistema.
 *
 * @package          Thevelopment
 * @author           Carlos Alberto
 * @copyright        Copyright (c) 2013 - 2014, Thevelopment (http://thevelopment.com.br/)
 * @license          http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @since            Version 1.0
 * @filesource
 */


/**
 * Determina qual Controller será inicializada automaticamente se nada for definido.
 * Isto vai chamar uma controller como padrão.
 */
$config['defaul_controller'] = 'index';


/**
 * Ativar/Desativar noscript
 * exigir que o navegador use o javascript
 */
$config['noscript'] = TRUE;


/**
 * Ativar/Desativar AppCache para armazenar conteudo para uso off-line, utilizando um arquivo manifesto (em HTML5)
 */
$config['appcache'] = TRUE;


/**
 * Ativar/Desativar sessão para determinadas áreas do sistema
 * auth => url para redirecionamento, quando a sessão não estiver disponível
 * name => nome da sessão
 * require => array contendo as controllers permitidas, ou vazio se for obrigatório ter uma sessão para todo o sistema
 */
$config['sess_cfg']['enable'] = TRUE;

$config['sess_cfg']['auth'][0] = "sistema/login";
$config['sess_cfg']['name'][0] = "auth_sis";
$config['sess_cfg']['require'][0] = array(); // array vazia representa todas as controllers

$config['sess_cfg']['auth'][1] = "backend/login";
$config['sess_cfg']['name'][1] = "back_sis";
$config['sess_cfg']['require'][1] = array('backend','cadastro'); // controllers



/**
 * Ativar/Desativar criptografia interna de dados [não-implementado]
 * defina um hash para criptografia dos dados
 */
$config['sec_enable'] = TRUE;
$config['sec_hash_key'] = 'gbz49dsat78t7987tsx0df1j6kjfqhoy';


/**
 * Ativar/Desativar a segurança CSRF - [Cross Site Request Forgery]
 * Isto ativa um cookie contendo um token, este token é verificado nos formulários submitados.
 * Se você está aceitando dados de usuário (ex: Ajax, formulário de contato, newsletter...), é recomendado ativar isto para segurança.
 */
$config['csrf_protection'] = FALSE; // Ativar ou Desativar
$config['csrf_field'] = 'csrf_test_name'; // nome do campo
$config['csrf_name'] = 'csrf_cookie_name'; // nome da sessão
$config['csrf_expire'] = 7200; // tempo da sessão
$config['csrf_regenerate'] = TRUE; // Regenerar a sessão
$config['csrf_allow_uris'] = array(); // URIs permitidas para executar a segurança // vazio representa todas
