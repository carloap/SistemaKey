<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

class Usuario {
	
	public $id;
	public $nome;
	public $login;
	public $senha;
	
	function Usuario() {}
	
	// Setters and Getters...
	public function setId( $id ){
		$this->id = $id;
	}
	
	public function setNome( $nome ){
		$this->nome = $nome;
	}
	
	public function setLogin( $login ){
		$this->login = $login;
	}
	
	public function setSenha( $senha ){
		$this->senha = $senha;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function getLogin(){
		return $this->login;
	}
	
	public function getSenha(){
		return $this->senha;
	}
}