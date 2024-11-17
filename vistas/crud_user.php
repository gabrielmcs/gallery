<?php
	include_once '../../bd/config.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	// Recepción de los datos enviados mediante POST desde el JS   
	
	$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
	$password = (isset($_POST['password'])) ? $_POST['password'] : '';
	$nome = (isset($_POST['nome'])) ? $_POST['nome'] : '';
	$nascimento = (isset($_POST['nascimento'])) ? $_POST['nascimento'] : '';
	$doc = (isset($_POST['doc'])) ? $_POST['doc'] : '';
	$passaporte = (isset($_POST['passaporte'])) ? $_POST['passaporte'] : '';
	$telefone = (isset($_POST['telefone'])) ? $_POST['telefone'] : '';
	$email = (isset($_POST['email'])) ? $_POST['email'] : '';	
	$idioma = (isset($_POST['idioma'])) ? $_POST['idioma'] : '';
	$nivel = (isset($_POST['nivel'])) ? $_POST['nivel'] : '';
	$setor = (isset($_POST['setor'])) ? $_POST['setor'] : '';
	$origem = (isset($_POST['origem'])) ? $_POST['origem'] : '';
	$imagen = '';

	//Insertar
	if($_POST['action']=="create"){
	  if($_FILES["user_image"]["name"] != '')
	  {
		  $extension = explode('.', $_FILES['user_image']['name']);
		  $new_name = rand() . '.' . $extension[1];
		  $destination = '../images/' . $new_name;
		  move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		  $imagen = $new_name;
		  
	  }
	}
	//editar
	if($_POST['action']=="editar"){
		if($_FILES["user_image"]["name"]!= '')
		{
			$extension = explode('.', $_FILES['user_image']['name']);
			$new_name = rand() . '.' . $extension[1];
			$destination = '../images/' . $new_name;
			move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
			$imagen = $new_name;
			
			
		}else{
			if($_POST["hidden_user_image"]!=""){
				$imagen = $_POST["hidden_user_image"];
				}else{
				$imagen = '';	
			}
		}
	}
	
	
	$action = (isset($_POST['action'])) ? $_POST['action'] : '';
	$id = (isset($_POST['id'])) ? $_POST['id'] : '';
	
	switch($action){
		case "create": //alta
        $consulta = $conexion->prepare("INSERT INTO tbl_usuarios (usuario, password, nome, nascimento, doc, passaporte, telefone, email, idioma, nivel, setor, imagen, origem) VALUES(:usuario, :password, :nome, :nascimento, :doc, :passaporte, :telefone, :email, :idioma, :nivel, :setor, :imagen, :origem) ");		
		$consulta->execute(
		array(
		':usuario'	=>	$usuario,
		':password'	=>	$password,
		':nome'	=>	$nome,
		':nascimento'	=>	$nascimento,
		':doc'	=>	$doc,
		':passaporte'	=>	$passaporte,
		':telefone'	=>	$telefone,
		':email'	=>	$email,
		':idioma'	=>	$idioma,
		':nivel'	=>	$nivel,
		':setor'	=>	$setor,
		':imagen'	=>	$imagen,
		':origem'		=>	$origem
		)
		);
		if ($consulta->rowCount() > 0){
			$data = 1;
			}else{
			$data = 0;
		}
        break;
		case "editar": //modificación
        $consulta = $conexion->prepare("UPDATE tbl_usuarios SET usuario=:usuario, password=:password, nome=:nome, nascimento=:nascimento, doc=:doc, passaporte=:passaporte, telefone=:telefone, email=:email, idioma=:idioma, nivel=:nivel, setor=:setor, imagen=:imagen, origem=:origem WHERE id=:id");	
		
		$consulta->execute(
		array(
		':usuario'	=>	$usuario,
		':password'	=>	$password,
		':nome'	=>	$nome,
		':nascimento'	=>	$nascimento,
		':doc'	=>	$doc,
		':passaporte'	=>	$passaporte,
		':telefone'	=>	$telefone,
		':email'	=>	$email,		
		':idioma'	=>	$idioma,
		':nivel'	=>	$nivel,
		':setor'	=>	$setor,
		':imagen'	=>	$imagen,
		':origem'		=>	$origem,
		':id'		=>	$id
		)
		);
		if ($consulta->rowCount()){
			$data = 1;
			}else{
			$data = 0;
		}       
		
		break;        
		
	}

	
	print json_encode($data, JSON_UNESCAPED_UNICODE);
	$conexion = NULL;