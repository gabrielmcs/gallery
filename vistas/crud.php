<?php
	include_once '../../bd/config.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	// Recepción de los datos enviados mediante POST desde el JS   
	
	$codigo = (isset($_POST['codigo'])) ? $_POST['codigo'] : '';
	$datahora = (isset($_POST['datahora'])) ? $_POST['datahora'] : '';
	$descricao_EN = (isset($_POST['descricao_EN'])) ? $_POST['descricao_EN'] : '';
	$orcamento = (isset($_POST['orcamento'])) ? $_POST['orcamento'] : '';
	$cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : '';
	$custo = (isset($_POST['custo'])) ? $_POST['custo'] : '';
	$moeda = (isset($_POST['moeda'])) ? $_POST['moeda'] : '';
	$desconto = (isset($_POST['desconto'])) ? $_POST['desconto'] : '';
	$sistema = (isset($_POST['sistema'])) ? $_POST['sistema'] : '';
	$origem = (isset($_POST['origem'])) ? $_POST['origem'] : '';
	$replicar = (isset($_POST['replicar'])) ? $_POST['replicar'] : '';
	$consolidado = (isset($_POST['consolidado'])) ? $_POST['consolidado'] : '';
	$imagen = '';
	$imagen2 = '';

		//SE A DATA NAO FOR SETADA, LIMPA O CAMPO	
	//	if ($datahora == "31-12-1969"){$datahora = "";}	

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
		  $destination2 = '../offer/' . $new_name2;
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
			$destination2 = '../offer/' . $new_name2;
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
		
		 //VERIFICA SE ORCAMENTO FOI CONSOLIDADO
		if ($consolidado){
		$consolidado = 1;
		}else{
		$consolidado = 0;
		}
		
        $consulta = $conexion->prepare("INSERT INTO item (codigo, datahora, descricao_EN, orcamento, cliente, custo, moeda, desconto, sistema, imagen, imagen2, origem, consolidado) VALUES(:codigo, :datahora, :descricao_EN, :orcamento, :cliente, :custo, :moeda, :desconto, :sistema, :imagen, :imagen2, :origem, :consolidado) ");		
		$consulta->execute(
		array(
		':codigo'	=>	$codigo,
		
		':datahora'	=>	$datahora,
		':descricao_EN'	=>	$descricao_EN,
		':orcamento'	=>	$orcamento,
		':cliente'	=>	$cliente,
		':custo'	=>	$custo,
		':moeda'	=>	$moeda,
		':desconto'	=>	$desconto,		
		':sistema'	=>	$sistema,
		':imagen'	=>	$imagen,
		':imagen2'	=>	$imagen2,
		':consolidado'	=>	$consolidado,
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
		
		//VERIFICA SE ORCAMENTO FOI CONSOLIDADO
		if ($consolidado){
		$consolidado = 1;
		}else{
		$consolidado = 0;
		}
		
        $consulta = $conexion->prepare("UPDATE item SET codigo=:codigo, datahora=:datahora, descricao_EN=:descricao_EN, orcamento=:orcamento, cliente=:cliente, custo=:custo, moeda=:moeda, desconto=:desconto, sistema=:sistema, imagen=:imagen, imagen2=:imagen2, origem=:origem, consolidado=:consolidado WHERE id=:id");	
		
		$consulta->execute(
		array(
		':codigo'	=>	$codigo,
		
		':datahora'	=>	$datahora,
		':descricao_EN'	=>	$descricao_EN,
		':orcamento'	=>	$orcamento,
		':cliente'	=>	$cliente,
		':custo'	=>	$custo,
		':moeda'	=>	$moeda,
		':desconto'	=>	$desconto,
		':sistema'	=>	$sistema,
		':imagen'	=>	$imagen,
		':imagen2'	=>	$imagen2,
		':origem'		=>	$origem,
		':consolidado'		=>	$consolidado,
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
	
	
	//COPIAR REGISTRO, SE O CHECKBOX REPLICAR ESTIVER ATIVADO.
	 if($replicar){
	 
	 //VERIFICA SE ORCAMENTO FOI CONSOLIDADO
		if ($consolidado){
		$consolidado = 1;
		}else{
		$consolidado = 0;
		}
	 
	 $consulta = $conexion->prepare("INSERT INTO item (codigo, datahora, descricao_EN, orcamento, cliente, custo, moeda, desconto, sistema, imagen, imagen2, origem, consolidado) VALUES(:codigo, :datahora, :descricao_EN, :orcamento, :cliente, :custo, :moeda, :desconto, :sistema, :imagen, :imagen2, :origem, :consolidado) ");		
		$consulta->execute(
		array(
		':codigo'	=>	$codigo,
		
		':datahora'	=>	$datahora,
		':descricao_EN'	=>	$descricao_EN,
		':orcamento'	=>	$orcamento,		
		':cliente'	=>	$cliente,
		':custo'	=>	$custo,
		':moeda'	=>	$moeda,
		':desconto'	=>	$desconto,		
		':sistema'	=>	$sistema,
		':imagen'	=>	$imagen,
		':imagen2'	=>	$imagen2,
		':consolidado'	=>	$consolidado,
		':origem'		=>	$origem
		)
		);
	}
	
	print json_encode($data, JSON_UNESCAPED_UNICODE);
	$conexion = NULL;