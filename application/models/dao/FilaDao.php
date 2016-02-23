<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

class FilaDao {
	
	public $conn = null;
	
	// construtor (recebe um objeto de conexão com o banco de dados)
	function FilaDao(PDO $conn) {
		$this->conn = $conn;
	}
	
	function insere(Fila $fila) {
		try{
			$stmt = $this->conn->prepare("INSERT INTO senha (idUsuario, idCliente, idPrioridade, senha_sen, sigla_sen, posicao_sen, guiche_sen, status_sen, datacad_sen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bindValue(1, $fila->getIdUsuario() );
			$stmt->bindValue(2, $fila->getIdCliente() );
			$stmt->bindValue(3, $fila->getIdPrioridade() );
			$stmt->bindValue(4, $fila->getSenha() );
			$stmt->bindValue(5, $fila->getSigla() );
			$stmt->bindValue(6, $fila->getPosicao() );
			$stmt->bindValue(7, $fila->getGuiche() );
			$stmt->bindValue(8, $fila->getStatus() );
			$stmt->bindValue(9, $fila->getDataCad() );
		
			$this->conn->beginTransaction();
			$stmt->execute();
			$this->conn->commit();
		}catch ( PDOException $ex ){
			echo "Erro: ".$ex->getMessage(); 
		}
	}
	
	function altera() {
		
	}
	
	function deleta() {
		
	}
	
	function lista() {
		try{
			$stmt = $this->conn->prepare("SELECT * FROM senha");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}catch ( PDOException $ex ){  
			echo "Erro: ".$ex->getMessage();
		}
	}
	
	function ultimaDataAtualizada() {
		try{
			$stmt = $this->conn->prepare("SELECT dataat_sen FROM senha ORDER BY dataat_sen DESC LIMIT 1");
			$stmt->execute();
			while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
				return $rs->dataat_sen;
			}
		}catch ( PDOException $ex ){
			echo "Erro: ".$ex->getMessage();
		}
	}
	
}