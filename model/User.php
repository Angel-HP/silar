<?php
/*
Un generador de getter y setters de PHP lo utilizaremos con:
http://mikeangstadt.name/projects/getter-setter-gen/
Para generar y establecer el modelo de La BD
*/
Class User {
	private $id_user;
	private $id_priv;
	private $id_status_user;
	private $id_history;
	private $name;
	private $user; 
	private $pass;
	private $tel;
	private $email;
	private $position;
	private $online;

	public function getId_user(){
		return $this->id_user;
	}

	public function setId_user($id_user){
		$this->id_user = $id_user;
	}

	public function getId_priv(){
		return $this->id_priv;
	}

	public function setId_priv($id_priv){
		$this->id_priv = $id_priv;
	}

	public function getId_status_user(){
		return $this->id_status_user;
	}

	public function setId_status_user($id_status_user){
		$this->id_status_user = $id_status_user;
	}

	public function getId_history(){
		return $this->id_history;
	}

	public function setId_history($id_history){
		$this->id_history = $id_history;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getUser(){
		return $this->user;
	}

	public function setUser($user){
		$this->user = $user;
	}

	public function getPass(){
		return $this->pass;
	}

	public function setPass($pass){
		$this->pass = $pass;
	}

	public function getTel(){
		return $this->tel;
	}

	public function setTel($tel){
		$this->tel = $tel;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPosition(){
		return $this->position;
	}

	public function setPosition($position){
		$this->position = $position;
	}

	public function getOnline(){
		return $this->online;
	}

	public function setOnline($online){
		$this->online = $online;
	}
}//Class User