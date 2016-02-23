<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

Class Index {

    /* Esta é a Controller Principal!
     * 
     * O nome "index" é definido como a controller padrão, como se fosse a página inicial
     * Para trocar o nome da controller padrão, troque o valor da variável "$defaul_controller", no arquivo "Config.php"
     * O nome deverá ser de uma Controller existente!
     * 
     * OBS: Os outros métodos dessa classe só serão visiveis se na URL, o "index" estiver presente
     */
    
    
    function __construct() {
        // Não coloque nada aqui de HTML (exceto se for código PHP)
    }

    public function index() {
        // Somente esta função será visível
        
        $meta['titulo'] = 'Carlos Alberto - Início';
        
        
        view('base_html/_header', $meta);
        view('base_html/_cabecalho');
        view('principal');
        view('base_html/_footer');
    }

    // NA TEORIA ISSO NÂO FUNCIONARA NO INDEX
    private function foi() {
        echo "le controllersito aqui!!";
    }

    // NA TEORIA ISSO NÂO FUNCIONARA NO INDEX
    private function voltou() {
        echo "le controllersito voltando aqui denovo! xD";
    }

}
