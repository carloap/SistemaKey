<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

Class Servicos {

    function __construct() {}

    function index() {
        $meta['titulo'] = 'Carlos Alberto - Serviços';
        
        
        view('base_html/_header', $meta);
        view('base_html/_cabecalho');
        view('servicos');
        view('base_html/_footer');
    }

    public function foi() {
    	view('base_html/_header');
    	//view('base_html/_cabecalho');
        echo "o controller carregou até aqui\n\t".PHP_EOL;
        echo "<br>";
	    
        
        
        //$pdo = loadClass('PDOConnectionFactory', 'database');
        //$pdo->setConnection($dados);
        // 1
        $usuario = model('Usuario');
        
        $usuario->setNome('Joaquim fodão');
        $usuario->setLogin('joq77xx');
        $usuario->setSenha('ajsdhkjashdkjasdhqwe213123123');
        
		$usuarioDao = model('UsuarioDao');
		print_r ($usuarioDao->lista()); echo "<br>";
		
		
		
		// 2
		$usuarioDao2 = model('UsuarioDao');
		print_r ($usuarioDao2->lista()); echo "<br>";
		
		
		// 3
		$usuarioDao3 = model('FilaDao');
		print_r ($usuarioDao3->lista()); echo "<br>";
		
		
		
		print_r ($usuarioDao3);
		
		//exit();
		
		//$usuarioDao->insere($usuario);
		//print_r ($usuarioDao->lista()); echo "<br>";

		//$usuarioDaob = model('UsuarioDao');
		//print_r ($usuarioDaob->lista()); echo "<br>";
		
        
        // debug
        echo "<pre>";
        print_r ( get_declared_classes() );
        echo "</pre>";
        
        
		/*
		// listagem
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			
			echo "Nome: ". $rs->nome_usu . " - Login: " . $rs->login_usu . "<br>";
		}
		*/
		
        view('base_html/_footer');
		
    }

    function voltou() {
        echo "o controller esta voltando";
    }

}
