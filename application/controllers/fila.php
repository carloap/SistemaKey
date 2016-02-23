<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

Class Fila {

    function __construct() {}
    
    function monitor() {
    	echo str_pad(null,1); // ecoa uma string vazia para testar a conexão
    	flush(); // força o envio para o cliente da string vazia
    	
    	// cria instância de FilaDao
    	$filaDao = model('FilaDao');
    	$lastmodif    = isset($_GET['timestamp']) ? $_GET['timestamp'] : 0; // obtém o timestamp da url
    	$currentmodif = strtotime($filaDao->ultimaDataAtualizada()); // obtém o timestamp do último registro atualizado
    	
    	// loop
    	while ($currentmodif <= $lastmodif) {
    		usleep(10000); // sleep 10ms to unload the CPU
    		if( time() >= ( 10 + $_SERVER['REQUEST_TIME'] ) || connection_aborted() ) {
    			// die( json_encode( array() ) ); // para o script e envia uma resposta vazia
    			$resp = array();
    			$resp['timestamp'] = $currentmodif;
    			die( json_encode($resp) );
    		}
    		$currentmodif = strtotime($filaDao->ultimaDataAtualizada()); // obtém um novo timestamp do último registro atualizado
    	}
    	
    	// prepara para enviar a lista de registros e o timestamp para exibir e re-começar o ciclo
    	$resp = array();
    	$resp['result'] = $filaDao->lista();
    	$resp['timestamp'] = $currentmodif;
    	
    	die( json_encode($resp) );
    }
    

}
