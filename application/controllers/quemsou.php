<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

Class Quemsou {

    function __construct() {}

    function index() {
        $meta['titulo'] = 'Carlos Alberto - Quem sou';
        
        
        view('base_html/_header', $meta);
        view('base_html/_cabecalho');
        view('quemsou');
        view('base_html/_footer');
    }

    public function foi() {
        echo "o controller carregou até aqui";
    }

    function voltou() {
        echo "o controller esta voltando";
    }

}
