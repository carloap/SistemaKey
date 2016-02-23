<?php

/*
 * --------------------------------------------------------------- 
 * AMBIENTE DA APLICAÇÃO 
 * ---------------------------------------------------------------
 * O ambiente da aplicação, representado pela constante 
 * 'ENVIRONMENT' define se o relatório de erros do PHP pode 
 * ou não, ser exibido pelo usuário. 
 * 
 * os valores disponíveis são:
 * -> desenvolvimento
 * -> producao
 * 
 * e cada um respectivamente, mostra e omite todos os erros gerados pelo php. 
 */
define('ENVIRONMENT', 'development');


/*
 * ---------------------------------------------------------------
 * RELATÓRIO DE ERROS
 * ---------------------------------------------------------------
 */
if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(E_ALL); // Mostrar erros
            break;
        case 'production':
            error_reporting(0); // Omitir erros
            break;
        default:
            exit('O ambiente da aplicação não foi definido corretamente.');
    }
}


/*
 * ---------------------------------------------------------------
 * DIRETÓRIO DE APLICAÇÃO
 * ---------------------------------------------------------------
 * Esta variável deve conter o nome do diretório de "aplicação".
 * O diretório pode ser movido para qualquer lugar, nesse caso,
 * certifique-se de colocar o caminho completo.
 */
$application_folder = 'application';


/*
 * --------------------------------------------------------------
 * CONTROLLER PRINCIPAL
 * --------------------------------------------------------------
 * É a tela principal que será chamada via controller.
 * Pode ser definido nas configurações do arquivo routes.php.
 * -NÃO IMPLEMENTADO-
 * 
 */



// # ------------------------------------------------------------#
// # ------------------------------------------------------------------#
// # FIM DAS CONFIGURAÇÕES. NÃO MODIFIQUE ABAIXO DESTA LINHA!
// # ------------------------------------------------------------------#
// # ------------------------------------------------------------#


/*
 * --------------------------------------------------------------
 * Rastrear o caminho para o sistema
 * --------------------------------------------------------------
 */
// O nome DESTE arquivo
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Caminho para o front controller (acessando por este arquivo)
define('FCPATH', str_replace(SELF, '', __FILE__));

// Define a url Base
$url_base = str_replace('index.php','',$_SERVER['SCRIPT_NAME']);
define('BASEURL', $url_base);

// Definindo uma constante para o diretório "application"
if (is_dir($application_folder)) {
    define('APPPATH', $application_folder . '/');
} else {
    exit("O diretório de aplicação não parece estar definido corretamente. Verifique o arquivo: " . SELF );
}


/*
 * --------------------------------------------------------------------
 * CARREGAR BOOTSTRAP [rotina auto-sustentável que procede sem ajuda externa]
 * --------------------------------------------------------------------
 */
require_once APPPATH . 'core/Main.php';

/* End of file index.php */
/* Location: ./index.php */