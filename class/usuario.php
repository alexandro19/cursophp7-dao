<?php 

/**
 * 
 */
class Usuario 
{
	
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($value){
		$this->idusuario = $value;
	}


	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($value){
		$this->deslogin = $value;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($value){
		$this->dessenha = $value;
	}

	public function getDtCadastro(){
		return $this->dtcadastro;
	}

	public function setDtCadastro($value){
		$this->dtcadastro = $value;
	}


	public function __construct($usuario, $senha){

		$this->setDeslogin($usuario);
		$this->setDessenha($senha);
	}


	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario=:ID", array(

			":ID"=>$id

		));

		if(count($results) > 0){

			$row = $results[0];
			$this->setData($results[0]);

		}

	}


	public function login($login, $senha){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE desusuario=:LOGIN AND dessenha = :SENHA", array(

			":LOGIN"=>$login,
			":SENHA"=>$senha

		));

		if(count($results) > 0){

			$row = $results[0];
			$this->setData($results[0]);

		}
		else{

			throw new Exception("Usuário ou senha inválido");
			
		}

	}

	public function setData($data){
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['desusuario']);
		$this->setDessenha($data['dessenha']);
		$this->setDtCadastro(new DateTime($data['dtcadastro']));

	}

	public function insert(){

		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(

		':LOGIN'=>$this->getDeslogin(),
		':SENHA'=>$this->getDessenha()

		));

		if(count($results) > 0){
			$this->setData($results[0]);
		}

	}



	public static function getList()
	{

		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios");

	}


	public static function search($login){

		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE desusuario like :SEARCH ORDER BY desusuario", array(
			":SEARCH"=>"%".$login."%"

		));

	} 

	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}

}

 ?>