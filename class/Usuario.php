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
			$this->setData($results[0]);;
		}
	}

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY desLogin");
	}

	public static function search($login){ //Método pra fazer busca ou pesquisa

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
		));
	}	

	public function login($login, $password){

		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
			":LOGIN"=>$login,
			":SENHA"=>$password
			));
		
		if (count($results) > 0)
		{
			$this->setData($results[0]);

		} else {
				throw new Exception("Login e/ou senha inválidos");		
		}
	}

	public function setData($data){

		$this->SetIdUsuario($data['idusuario']); //Vai armazenar as informações de usuario no banco de dados
		$this->SetDesLogin($data['deslogin']);//Vai armazenar as informações de login no banco de dados
		$this->SetDesSenha($data['dessenha']);//Vai armazenar as informações de senha no banco de dados
		$this->SetDtCadastro(new DateTime($data['dtcadastro']));//Vai armazenar as informações de senha no banco de dados		
	}

	public function insert(){

		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
			':LOGIN'=>$this->getDesLogin(),
			':PASSWORD'=>$this->getDesSenha()
			));

		if (count($results) > 0){
			$this->setData($results[0]);;
		}

	}

	public function update($login, $password){

		$this->SetDesLogin($login);
		$this->SetDesSenha($password);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin =:LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			':LOGIN'=>$this->getDesLogin(),
			':PASSWORD'=>$this->getDesSenha(),
			':ID'=>$this->getIdUsuario()
			));
	}

	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM tb_usuarios where idusuario = :ID", array(	
				':ID'=>$this->getIdUsuario()			
			));

		$this->SetIdUsuario(0);
		$this->SetDesLogin("");
		$this->SetDesSenha("");
		$this->SetIdUsuario(new DateTime());
	}

	public function __construct($login ="", $password = ""){
		$this->setDesLogin($login);
		$this->setDesSenha($password);
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