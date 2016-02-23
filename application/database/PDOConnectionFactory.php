<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

class PDOConnectionFactory{
	// recebe a conexão
	public $connection 	= null;
	
	// define o tipo de banco de dados
	public $dbType 	= "";

	// parâmetros de conexão
	public $host 	= "";
	public $user 	= "";
	public $senha 	= "";
	public $db		= "";

	// define a persistência da conexão
	public $persistent = false;

	// construtor
	public function PDOConnectionFactory( $persistent=false ){
		// verifico a persistência da conexao
		if( $persistent != false){ $this->persistent = true; }
		$this->load(); // carrega dados de conexão com o banco
	}
	
	private function load(){
		require APPPATH.'config/database.php'; // carrega variaveis de conexão do arquivo database.php
		$this->dbType 	  = $db[$db['active_group']]['dbdrive'];
		$this->host 	  = $db[$db['active_group']]['hostname'];
		$this->user	 	  = $db[$db['active_group']]['username'];
		$this->senha 	  = $db[$db['active_group']]['password'];
		$this->db 		  = $db[$db['active_group']]['database'];
		$this->persistent = ( isset($db[$db['active_group']]['persist']) ? $db[$db['active_group']]['persist'] : false );
		return;
	}
	
	// define uma nova conexão manualmente
	public function setConnection($db_array = array()){
		$this->dbType 	  = $db_array['dbdrive'];
		$this->host 	  = $db_array['hostname'];
		$this->user 	  = $db_array['username'];
		$this->senha 	  = $db_array['password'];
		$this->db 		  = $db_array['database'];
		$this->persistent = ( isset($db_array['persist']) ? $db_array['persist'] : false );
		return;
	}
	
	// pega uma nova conexão com base nos dados
	public function getConnection(){
		try { // tenta realizar a conexão
			$this->connection = new PDO($this->dbType.":host=".$this->host.";dbname=".$this->db, $this->user, $this->senha,
					array( PDO::ATTR_PERSISTENT => $this->persistent ) );
			return $this->connection; // realizado com sucesso, retorna conexão
		} catch ( PDOException $ex ) { 
			echo "Erro ao conectar-se com o banco de dados: ".$ex->getMessage(); // caso ocorra um erro, retorna o erro
		}
	}
	
	// desconecta
	public function close(){
		if( $this->connection != null )
			$this->connection = null;
	}

}