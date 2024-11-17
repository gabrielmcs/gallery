<?php
	include_once '../../bd/config.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	
	if($_POST["action"]=="update"){
		$output = array();
		$statement = $conexion->prepare(
		"SELECT * FROM item 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
		);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output["id"] = $row["id"];
			$output["codigo"] = $row["codigo"];
			$output["datahora"] = $row["datahora"];
			$output["descricao_EN"] = $row["descricao_EN"];
			$output["orcamento"] = $row["orcamento"];
			$output["cliente"] = $row["cliente"];
			$output["custo"] = $row["custo"];
			$output["moeda"] = $row["moeda"];
			$output["desconto"] = $row["desconto"];			
			$output["sistema"] = $row["sistema"];
			$output["origem"] = $row["origem"];
			$output["consolidado"] = $row["consolidado"];

//SE TIVER IMAGEM NO BANCO, MOSTRA O PREVIEW, CASO CONTRARIO, NAO MOSTRA NADA
			if($row["imagen"] != '')		
			{
				$output['user_image'] = '<a href="images/'.$row["imagen"].'" target="_blank">
										<img style="text-align:center;" src="images/'.$row["imagen"].'" class="img-thumbnail text-center" width="70" height="55" />
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
										<img style="text-align:center;" src="img/offer.jpg" class="img-thumbnail text-center" width="70" height="55" />
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
		"SELECT * FROM item 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
		);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
	
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
			
		//SE A DATA NAO FOR SETADA, LIMPA O CAMPO	
	//	if ($row["datahora"] == "31-12-1969"){$row["datahora"] = "";}	

//SE ORCAMENTO CONSOLIDADO, ATIVA CHECKBOX
if ($row['consolidado']){ 		
$consolidado = '<div class="text-center"><i class="fa fa-check-circle fa-2x text-success text-center" aria-hidden="true" ></i></div>';
}else{
$consolidado = '<div class="text-center"><i class="fa fa-times-circle fa-2x text-danger text-center" aria-hidden="true"></i></div>';
}
			
//CHECA SE O ARQUIVO ORCAMENTO EXISTE FISICAMENTE NA PASTA OFFER. SE EXISTIR O NOME DO ORCAMENTO FICA AZUL E GERA UM LINK PARA BAIXA-LO. SE NAO EXISTIR, FICA CINZA.
$offer = "offer/".$row['imagen2'];

if( (file_exists($offer)) && ($row['imagen2'] != "") ){
$orcamento = "<a href='offer/".$row['imagen2']."' target='_blank'><div class='badge badge-primary badge-pill'>".$row['orcamento']."</div></a>";
}else{
$orcamento = "<div class='badge badge-secondary badge-pill'>".$row['orcamento']."</div>";
}	
			$output["id"] = $row["id"];
			$output["codigo"] = $row["codigo"];
			$output["datahora"] = $row["datahora"];
			$output["descricao_EN"] = $row["descricao_EN"];
			$output["orcamento"] = $orcamento;
			$output["cliente"] = $row["cliente"];
			$output["custo"] = $row["custo"];
			$output["moeda"] = $row["moeda"];
			$output["desconto"] = $row["desconto"];
			$output["origem"] = $origem;
			$output["sistema"] = $row["sistema"];
			$output["consolidado"] = $consolidado;			
			$output["imagen"] = $row["imagen"];
			$output["imagen2"] = $row["imagen2"];
		}
		echo json_encode($output);
	}
?>