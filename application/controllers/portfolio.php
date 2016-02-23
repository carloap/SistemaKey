<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

Class Portfolio {

    function __construct() {}

    function index() {
        $meta['titulo'] = 'Carlos Alberto - Portfólio';
        
        
        view('base_html/_header', $meta);
        view('base_html/_cabecalho');
        view('portfolio');
        view('base_html/_footer');
    }

    public function foi() {
        echo "o controller carregou até aqui";
    }

    function voltou() {
        echo "o controller esta voltando";
    }

}
