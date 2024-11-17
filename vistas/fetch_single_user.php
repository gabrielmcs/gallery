<?php
	include_once '../../bd/config.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	
	if($_POST["action"]=="update"){
		$output = array();
		$statement = $conexion->prepare(
		"SELECT * FROM tbl_usuarios 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
		);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{

			$output["usuario"] = $row["usuario"];
			$output["password"] = $row["password"];
			$output["nome"] = $row["nome"];
			$output["nascimento"] = $row["nascimento"];
			$output["idioma"] = $row["idioma"];
			$output["nivel"] = $row["nivel"];
			$output["setor"] = $row["setor"];
			$output["origem"] = $row["origem"];
			$output["id"] = $row["id"];
			$output["doc"] = $row["doc"];
			$output["passaporte"] = $row["passaporte"];
			$output["telefone"] = $row["telefone"];
			$output["email"] = $row["email"];


//<a href="images/'.$row["imagen"].'" target="_blank"></a>

			if($row["imagen"] != '')		
			{
				$output['user_image'] = '<img src="images/'.$row["imagen"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["imagen"].'" />';
			}
			else
			{
				$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
			}
		}
		echo json_encode($output);
		}elseif($_POST["action"]=="detalles"){
		$output = array();
		$statement = $conexion->prepare(
		"SELECT * FROM tbl_usuarios 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
		);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
	
				
				if($row['idioma']==NULL or $row['idioma']==-1){
				$idioma = "<img src='img/flag/unknow.png' alt='Unknow' width='48' height='28' />";
				//$origem = '<div class="badge badge-alert badge-pill">Holanda</div>';
				}
				elseif($row['idioma']==0){
				$idioma = "<img src='img/flag/brasil.png' alt='Portugues' width='48' height='28' />";
				//$origem = '<div class="badge badge-dark badge-pill">Desconhecido</div>';	
				}
				elseif($row['idioma']==1){
				$idioma = "<img src='img/flag/espanhol.png' alt='Espanhol' width='48' height='28' />";
				//$origem = '<div class="badge badge-warning badge-pill">Dinamarca</div>';	
				}
				elseif($row['idioma']==2){
				$idioma = "<img src='img/flag/ingles.png' alt='Ingles' width='48' height='28' />";
				//$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}
				
			//DEFINE A DESCRIÇÃO DE ACORDO COM O VALOR SALVO	
				if($row['origem']==NULL or $row['origem']==-1){
				$origem = "<img src='img/flag/unknow.png' alt='Unknow' width='48' height='28' />";
				//$origem = '<div class="badge badge-alert badge-pill">Holanda</div>';
				}
				elseif($row['origem']==0){
				$origem = "<img src='img/flag/brasil.png' alt='Brasil' width='48' height='28' />";
				//$origem = '<div class="badge badge-dark badge-pill">Desconhecido</div>';	
				}
				elseif($row['origem']==1){
				$origem = "<img src='img/flag/argentina.png' alt='Argentina' width='48' height='28' />";
				//$origem = '<div class="badge badge-warning badge-pill">Dinamarca</div>';	
				}
				elseif($row['origem']==2){
				$origem = "<img src='img/flag/colombia.png' alt='Colombia' width='48' height='28' />";
				//$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}
			
//DEFINE A DESCRIÇÃO DE ACORDO COM O VALOR SALVO
			if($row['nivel']==NULL or $row['nivel']==-1){
				//$nivel = "<img src='img/flag/unknow.png' alt='Unknow' width='48' height='28' />";
				$nivel = '<div class="badge badge-dark badge-pill">Desconhecido</div>';
				}
				elseif($row['nivel']==0){
				//$nivel = "<img src='img/flag/brasil.png' alt='Portugues' width='48' height='28' />";
				$nivel = '<div class="badge badge-danger badge-pill">Usuario</div>';	
				}
				elseif($row['nivel']==1){
				//$nivel = "<img src='img/flag/espanhol.png' alt='Espanhol' width='48' height='28' />";
				$nivel = '<div class="badge badge-warning badge-pill">Supervisor</div>';	
				}
				elseif($row['nivel']==2){
				//$nivel = "<img src='img/flag/ingles.png' alt='Ingles' width='48' height='28' />";
				$nivel = '<div class="badge badge-success badge-pill">Admin</div>';	
				}

			//DEFINE A DESCRIÇÃO DE ACORDO COM O VALOR SALVO
			if($row['setor']==NULL or $row['setor']==-1){
				//$nivel = "<img src='img/flag/unknow.png' alt='Unknow' width='48' height='28' />";
				$setor = '<div class="badge badge-dark badge-pill">Desconhecido</div>';
				}
				elseif($row['setor']==0){
				//$nivel = "<img src='img/flag/brasil.png' alt='Portugues' width='48' height='28' />";
				$setor = '<div class="badge badge-primary badge-pill">Tecnico</div>';	
				}
				elseif($row['setor']==1){
				//$nivel = "<img src='img/flag/espanhol.png' alt='Espanhol' width='48' height='28' />";
				$setor = '<div class="badge badge-warning badge-pill">Admin</div>';	
				}
				elseif($row['setor']==2){
				//$nivel = "<img src='img/flag/ingles.png' alt='Ingles' width='48' height='28' />";
				$setor = '<div class="badge badge-success badge-pill">Vendas</div>';	
				}
			
//GERA UM LINK PARA LIGACAO DO TELEFONE DO USUARIO 
$telefone = "<a href='tel:".$row['telefone']."' target='_blank'><div class='badge badge-success badge-pill'>".$row['telefone']."</div></a>";

//GERA UM LINK PARA EMAIL DO USUARIO 
$email = "<a href='mailto:".$row['email']."' target='_blank'><div class='badge badge-dark badge-pill'>".$row['email']."</div></a>";


//<a href="images/'.$row["imagen"].'" target="_blank"></a>


			
			$output["usuario"] = $row["usuario"];
			$output["password"] = $row["password"];
			$output["nome"] = $row["nome"];
			$output["nascimento"] = $row["nascimento"];
			$output["idioma"] = $idioma;
			$output["nivel"] = $nivel;
			$output["origem"] = $origem;
			$output["setor"] = $setor;
			$output["imagen"] = $row["imagen"];
			$output["doc"] = $row["doc"];
			$output["passaporte"] = $row["passaporte"];
			$output["telefone"] = $telefone;
			$output["email"] = $email;
			$output["id"] = $row["id"];
			
		}
		echo json_encode($output);
	}
?>