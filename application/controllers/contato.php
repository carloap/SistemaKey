<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

Class Contato {

    function __construct() {}

    function index() {
        $header['titulo'] = 'Carlos Alberto - Contato';
        
        view('base_html/_header', $header);
        view('base_html/_cabecalho');
        view('contato');
        view('base_html/_footer');
    }

    public function foi() {
        echo "o controller carregou até aqui";
    }

    function voltou() {
        echo "o controller esta voltando";
    }

}
