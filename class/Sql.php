<?php

class Sql extends PDO
{
	private $conn; //Trazendo a conexão

	public function __construct() //Quando fazer a consulta vai entrar automaticamento no banco de dados
	{

		$this->conn = new PDO("mysql:host=127.0.0.1;dbname=dbphp7","root","zenildo.9"); //Conectando no banco
	}

	private function setParams($statement, $parameters = array()) //Chamando os parametros da setParam
	{
		foreach ($parameters as $key => $value) 
		{
			$this->setParam($statement, $key, $value);
		}
	}

	private function setParam($statement, $key, $value) //Trazendo o parametro
	{

		$statement->bindParam($key, $value);
	}

	public function query($rawQuery, $params = array())
	{
		$stmt = $this->conn->prepare($rawQuery); //Prepare vem da classe pai

		$this->setParams($stmt, $params);
		
		$stmt->execute();

		return $stmt;
	}


	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->query($rawQuery, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
}




?>