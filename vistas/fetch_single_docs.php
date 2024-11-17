<?php
	include_once '../../bd/config.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	
	if($_POST["action"]=="update"){
		$output = array();
		$statement = $conexion->prepare(
		"SELECT * FROM docs 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
		);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{

			$output["tipo"] = $row["tipo"];
			$output["descricao"] = $row["descricao"];
			$output["linha"] = $row["linha"];
			$output["modelo"] = $row["modelo"];
			$output["revisao"] = $row["revisao"];
			$output["datahora"] = $row["datahora"];
			$output["idioma"] = $row["idioma"];
			$output["origem"] = $row["origem"];
			$output["id"] = $row["id"];

//SE TIVER IMAGEM NO BANCO, MOSTRA O PREVIEW, CASO CONTRARIO, NAO MOSTRA NADA
			if($row["imagen"] != '')		
			{
				$output['user_image'] = '<a href="images/'.$row["imagen"].'" target="_blank">
										<img src="images/'.$row["imagen"].'" class="img-thumbnail" width="70" height="55" />
										</a>
										<input type="hidden" name="hidden_user_image" value="'.$row["imagen"].'" />
										';
//				$output['user_image'] = '<img src="images/'.$row["imagen"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["imagen"].'" />';
			}
			else
			{
				$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
			}

//SE TIVER ARQUIVO NO BANCO, MOSTRA NO PREVIEW UM ICONE DO ARQUIVO, CASO CONTRARIO, NAO MOSTRA NADA
			if($row["imagen2"] != '')		
			{
				$output['user_image2'] = '<a href="offer/'.$row["imagen2"].'" target="_blank">
										<img src="img/docs.jpg" class="img-thumbnail" width="70" height="55" />
										</a>
										<input type="hidden" name="hidden_user_image2" value="'.$row["imagen2"].'" />
										';
//				$output['user_image2'] = '<img src="img/offer.jpg" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image2" value="'.$row["imagen2"].'" />';
			}
			else
			{
				$output['user_image2'] = '<input type="hidden" name="hidden_user_image2" value="" />';
			}


		}
		echo json_encode($output);
		}elseif($_POST["action"]=="detalles"){
		$output = array();
		$statement = $conexion->prepare(
		"SELECT * FROM docs 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
		);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
	
			//ORIGEM	
			if($row['origem']==0){
				$origem = '<div class="badge badge-warning badge-pill">Holanda</div>';
				}elseif($row['origem']==-1){
				$origem = '<div class="badge badge-dark badge-pill">Desconhecido</div>';	
				}
				elseif($row['origem']==1){
				$origem = '<div class="badge badge-danger badge-pill">Dinamarca</div>';	
				}
				elseif($row['origem']==2){
				$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}
				elseif($row['origem']==3){
				$origem = '<div class="badge badge-primary badge-pill">Brasil</div>';	
				}
			
			
				//IDIOMA
				if($row['idioma']==NULL or $row['idioma']==-1){
				$idioma = "<img src='img/flag/unknow.png' alt='Unknow' width='37' height='23' />";
				//$origem = '<div class="badge badge-alert badge-pill">Holanda</div>';
				}
				elseif($row['idioma']==0){
				$idioma = "<img src='img/flag/portugues.png' alt='Portugues' width='37' height='23' />";
				//$origem = '<div class="badge badge-dark badge-pill">Desconhecido</div>';	
				}
				elseif($row['idioma']==1){
				$idioma = "<img src='img/flag/espanhol.png' alt='Espanhol' width='37' height='23' />";
				//$origem = '<div class="badge badge-warning badge-pill">Dinamarca</div>';	
				}
				elseif($row['idioma']==2){
				$idioma = "<img src='img/flag/ingles.png' alt='Ingles' width='37' height='23' />";
				//$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}
			
			
//CHECA SE O ARQUIVO ORCAMENTO EXISTE FISICAMENTE NA PASTA DOCS. SE EXISTIR O NOME DO ORCAMENTO FICA AZUL E GERA UM LINK PARA BAIXA-LO. SE NAO EXISTIR, FICA CINZA.
$docs = "docs/".$row['imagen2'];

if( (file_exists($docs)) && ($row['imagen2'] != "") ){
$descricao = "<a href='docs/".$row['imagen2']."' target='_blank'><div class='badge badge-primary badge-pill'>".$row['descricao']."</div></a>";
}else{
$descricao = "<div class='badge badge-secondary badge-pill'>".$row['descricao']."</div>";
}		
			
			$output["tipo"] = $row["tipo"];
			$output["descricao"] = $descricao;
			$output["linha"] = $row["linha"];
			$output["modelo"] = $row["modelo"];
			$output["revisao"] = $row["revisao"];
			$output["datahora"] = $row["datahora"];
			$output["idioma"] = $idioma;
			$output["origem"] = $origem;
			$output["imagen"] = $row["imagen"];
			$output["imagen2"] = $row["imagen2"];
			$output["id"] = $row["id"];
			
		}
		echo json_encode($output);
	}
?>