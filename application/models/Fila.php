<?php if (!defined('APPPATH')) exit('No direct script access allowed.');

class Fila {
	private $idSenha;
	private $idUsuario;
	private $idCliente;
	private $idPrioridade;
	private $senha_sen;
	private $sigla_sen;
	private $posicao_sen;
	private $guiche_sen;
	private $status_sen;
	private $datacad_sen;
	
	function Fila() {}
	
	// Setters and Getters
	public function setIdSenha($id) {
		$this->idSenha = $id;
	}
	public function setIdUsuario($id) {
		$this->idUsuario = $id;
	}
	public function setIdCliente($id) {
		$this->idCliente = $id;
	}
	public function setPrioridade($id) {
		$this->idPrioridade = $id;
	}
	public function setSenha($senha){
		$this->senha_sen = $senha;
	}
	public function setSigla($sigla){
		$this->sigla_sen = $sigla;
	}
	public function setPosicao($posicao){
		$this->posicao_sen = $posicao;
	}
	public function setGuiche($guiche){
		$this->guiche_sen = $guiche;
	}
	public function setStatus($status){
		$this->status_sen = $status;
	}
	public function setDataCad($data){
		$this->datacad_sen = $data;
	}
	
	public function getIdSenha() {
		return $this->idSenha;
	}
	public function getIdUsuario() {
		return $this->idUsuario;
	}
	public function getIdCliente() {
		return $this->idCliente;
	}
	public function getPrioridade() {
		return $this->idPrioridade;
	}
	public function getSenha(){
		return $this->senha_sen;
	}
	public function getSigla(){
		return $this->sigla_sen;
	}
	public function getPosicao(){
		return $this->posicao_sen;
	}
	public function getGuiche(){
		return $this->guiche_sen;
	}
	public function getStatus(){
		return $this->status_sen;
	}
	public function getDataCad(){
		return $this->datacad_sen;
	}
	
}