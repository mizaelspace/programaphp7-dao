<?php

class Usuario 
{
	private $idUsuario;
	private $desLogin;
	private $desSenha;
	private $dtCadastro;

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function SetIdUsuario($value){
		$this->idusuario = $value;
	}

	public function getDesLogin(){
		return $this->deslogin;
	}

	public function SetDesLogin($value){
		$this->deslogin = $value;
	}	

	public function getDesSenha(){
		return $this->dessenha;
	}

	public function SetDesSenha($value){
		$this->dessenha = $value;
	}

	public function getDtCadastro(){
		return $this->dtcadastro;
	}

	public function SetDtCadastro($value){
		$this->dtcadastro = $value;
	}
	
	public function loadById($id){ //Carregar pelo id

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));
		
		if (count($results) > 0)
		{
			$row = $results[0];
			$this->SetIdUsuario($row['idusuario']); //Vai armazenar as informações de usuario no banco de dados
			$this->SetDesLogin($row['deslogin']);//Vai armazenar as informações de login no banco de dados
			$this->SetDesSenha($row['dessenha']);//Vai armazenar as informações de senha no banco de dados
			$this->SetDtCadastro(new DateTime($row['dtcadastro']));//Vai armazenar as informações de senha no banco de dados
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdUsuario(),
			"deslogin"=>$this->getDesLogin(),
			"dessenha"=>$this->getDesSenha(),
			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}
}



?>