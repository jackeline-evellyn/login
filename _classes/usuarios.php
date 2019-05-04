<?php
class Usuario 
{
	private $pdo;
	public $msgErro = "";
	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		try 
		{
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);

		} catch(PDOException $e){
			$msgErro = $e->getMessage();
		}
		
	}	
	public function cadastrar($nome, $telefone,  $email, $senha)
	{
		global $pdo;
		//Verificar se já existe email cadastrado
		$sql = $pdo->prepare("SELECT email into usuario where email= :e");

		//bindValue substitue :e pelo valor da variavel email 
		$sql->bindValue(":e",$email);
		$sql->execute();

		if($sql->rowCount()>0){
			return false; //já está cadastrado
		}
		else
		{
		//Caso não, cadastre
			$sql = $pdo->prepare("INSERT INTO usuario (nome_completo, telefone, email,senha) values (:n,:t,:e,:s)");
			$sql-> bindValue(":n",$nome);
			$sql-> bindValue(":t",$telefone);
			$sql-> bindValue(":e",$email);
			$sql-> bindValue(":s",md5($senha));
			$sql->execute();
			return true;
		}


	}
	public function logar($email, $senha)
	{
		global $pdo;
        //verificar se email e senha estao cadastrados
		$sql = $pdo->prepare("SELECT id_usuario from usuario where email=:e and senha=:s");
		$sql->bindValue(":e",$email);
		$sql->bindValue(":s",md5($senha));
		$sql->execute();
		if($sql->rowCount()>0){
		//entrar no sistema (session)
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario'];
			return true; //Foi possível logar
		} else
			return false; //Não foi possível logar
		{
		}
	}
}



?>