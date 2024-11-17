<?php
	include_once '../../bd/config.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	// Recepción de los datos enviados mediante POST desde el JS   
	
	$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
	$descricao = (isset($_POST['descricao'])) ? $_POST['descricao'] : '';
	$linha = (isset($_POST['linha'])) ? $_POST['linha'] : '';
	$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
	$revisao = (isset($_POST['revisao'])) ? $_POST['revisao'] : '';
	$datahora = (isset($_POST['datahora'])) ? $_POST['datahora'] : '';
	$idioma = (isset($_POST['idioma'])) ? $_POST['idioma'] : '';
	$origem = (isset($_POST['origem'])) ? $_POST['origem'] : '';
	$imagen = '';
	$imagen2 = '';

/////////////////////////UPLOAD IMAGEM ////////////////////////////////////////////	
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
/////////////////////////////////////////////////////////////////////////////////	
/////////////////////////UPLOAD ORCAMENTO ////////////////////////////////////////////	
	//Insertar
	if($_POST['action']=="create"){
	  if($_FILES["user_image2"]["name"] != '')
	  {
		  $extension2 = explode('.', $_FILES['user_image2']['name']);
		  $new_name2 = rand() . '.' . $extension2[1];
		  $destination2 = '../docs/' . $new_name2;
		  move_uploaded_file($_FILES['user_image2']['tmp_name'], $destination2);
		  $imagen2 = $new_name2;
	  }
	}
	//editar
	if($_POST['action']=="editar"){
		if($_FILES["user_image2"]["name"]!= '')
		{
			$extension2 = explode('.', $_FILES['user_image2']['name']);
			$new_name2 = rand() . '.' . $extension2[1];
			$destination2 = '../docs/' . $new_name2;
			move_uploaded_file($_FILES['user_image2']['tmp_name'], $destination2);
			$imagen2 = $new_name2;
		}else{
			if($_POST["hidden_user_image2"]!=""){
				$imagen2 = $_POST["hidden_user_image2"];
				}else{
				$imagen2 = '';	
			}
		}
	}
/////////////////////////////////////////////////////////////////////////////////		
	
		
	$action = (isset($_POST['action'])) ? $_POST['action'] : '';
	$id = (isset($_POST['id'])) ? $_POST['id'] : '';
	
	switch($action){
		case "create": //alta
        $consulta = $conexion->prepare("INSERT INTO docs (tipo, descricao, linha, modelo, revisao, datahora, idioma, origem, imagen, imagen2) VALUES(:tipo, :descricao, :linha, :modelo, :revisao, :datahora, :idioma, :origem, :imagen, :imagen2) ");		
		$consulta->execute(
		array(
		':tipo'	=>	$tipo,
		':descricao'	=>	$descricao,
		':linha'	=>	$linha,
		':modelo'	=>	$modelo,
		':revisao'	=>	$revisao,
		':datahora'	=>	$datahora,
		':idioma'	=>	$idioma,
		':origem'	=>	$origem,
		':imagen'	=>	$imagen,
		':imagen2'	=>	$imagen2
		)
		);
		if ($consulta->rowCount() > 0){
			$data = 1;
			}else{
			$data = 0;
		}
        break;
		case "editar": //modificación
        $consulta = $conexion->prepare("UPDATE docs SET tipo=:tipo, descricao=:descricao, linha=:linha, modelo=:modelo, revisao=:revisao, datahora=:datahora, idioma=:idioma, origem=:origem, imagen=:imagen, imagen2=:imagen2 WHERE id=:id");	
		
		$consulta->execute(
		array(
		':tipo'	=>	$tipo,
		':descricao'	=>	$descricao,
		':linha'	=>	$linha,
		':modelo'	=>	$modelo,
		':revisao'	=>	$revisao,
		':datahora'	=>	$datahora,
		':idioma'	=>	$idioma,
		':origem'	=>	$origem,
		':imagen'	=>	$imagen,
		':imagen2'	=>	$imagen2,
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