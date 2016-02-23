<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

class UsuarioDao {
	
	public $conn = null;
	
	// construtor (recebe um objeto de conexão com o banco de dados)
	function UsuarioDao(PDO $conn) {
		$this->conn = $conn;
	}
	
	function insere(Usuario $usuario) {
		try{
			// preparo a query de inserçao - Prepare Statement
			$stmt = $this->conn->prepare("INSERT INTO tb_usuario (nome_usu, login_usu, senha_usu) VALUES (?, ?, ?)");
			$stmt->bindValue(1, $usuario->getNome() );
			$stmt->bindValue(2, $usuario->getLogin() );
			$stmt->bindValue(3, $usuario->getSenha() );
		
			$this->conn->beginTransaction();
			$stmt->execute(); // executo a query preparada
			$this->conn->commit();
			$stmt->close();
			
			// fecho a conexão
			//$this->conn = null;
			// caso ocorra um erro, retorna o erro;
		}catch ( PDOException $e ){
			echo "Erro: ".$e->getMessage(); 
		}
	}
	
	function altera() {
		
	}
	
	function deleta() {
		
	}
	
	function lista($query=null) {
		try{
			$stmt = $this->conn->query("SELECT * FROM usuario");
			
			//$this->conn->close();
			// desconecta
			//$this->conn = null;
			
			// retorna o resultado da query
			// return $stmt;
			
			while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
					
				echo "Nome: ". $rs->nome_usu . " - Login: " . $rs->login_usu . "<br>";
			}
			
			
		}catch ( PDOException $ex ){  
			echo "Erro: ".$ex->getMessage();
		}
	}
	
	function seleciona() {
		
	}
	
}