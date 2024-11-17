<?php
	include_once '../../bd/config.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	
	if($_POST["action"]=="update"){
		$output = array();
		$statement = $conexion->prepare(
		"SELECT * FROM gallery 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
		);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output["step_machine"] = $row["step_machine"];
			$output["step_part"] = $row["step_part"];
			$output["step_name"] = $row["step_name"];
			$output["step_counter"] = $row["step_counter"];
			$output["step_instruction"] = $row["step_instruction"];
			$output["step_source"] = $row["step_source"];
			$output["step_language"] = $row["step_language"];
			$output["step_status"] = $row["step_status"];
			$output["id"] = $row["id"];

//SE TIVER IMAGEM NO BANCO, MOSTRA O PREVIEW, CASO CONTRARIO, NAO MOSTRA NADA
			if($row["step_image"] != '')		
			{
				$output['step_image'] = '<a href="img/gallery/'.$row["step_image"].'" target="_blank">
										<img src="img/gallery/'.$row["step_image"].'" class="img-thumbnail" width="70" height="55" />
										</a>
										<input type="hidden" name="hidden_step_image" value="'.$row["step_image"].'" />
										';

			}
			else
			{
				$output['step_image'] = '<input type="hidden" name="hidden_step_image" value="" />';
			}
							
			
		}
		echo json_encode($output);
		}elseif($_POST["action"]=="detalles"){
		$output = array();
		$statement = $conexion->prepare(
		"SELECT * FROM gallery 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
		);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
				
				
				if($row['step_language']==NULL or $row['step_language']==-1){
				$step_language = "<img src='img/flag/unknow.jpg' alt='Unknow' width='48' height='28' />";
				//$origem = '<div class="badge badge-alert badge-pill">Holanda</div>';
				}
				elseif($row['step_language']==0){
				$step_language = "<img src='img/flag/netherlands.jpg' alt='Deutch' width='48' height='28' />";
				//$origem = '<div class="badge badge-dark badge-pill">Desconhecido</div>';	
				}
				elseif($row['step_language']==1){
				$step_language = "<img src='img/flag/english.jpg' alt='English' width='48' height='28' />";
				//$origem = '<div class="badge badge-dark badge-pill">Desconhecido</div>';	
				}
				elseif($row['step_language']==2){
				$step_language = "<img src='img/flag/german.jpg' alt='German' width='48' height='28' />";
				//$origem = '<div class="badge badge-dark badge-pill">Desconhecido</div>';	
				}
				elseif($row['step_language']==3){
				$step_language = "<img src='img/flag/italian.jpg' alt='Italian' width='48' height='28' />";
				//$origem = '<div class="badge badge-dark badge-pill">Desconhecido</div>';	
				}
				elseif($row['step_language']==4){
				$step_language = "<img src='img/flag/portuguese.jpg' alt='Portuguese' width='48' height='28' />";
				//$origem = '<div class="badge badge-warning badge-pill">Dinamarca</div>';	
				}
				elseif($row['step_language']==5){
				$step_language = "<img src='img/flag/spanish.jpg' alt='Spanish' width='48' height='28' />";
				//$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}

				if($row['step_source']==NULL or $row['step_source']==-1){
				$step_source = "<img src='img/flag/unknow.jpg' alt='Unknow' width='48' height='28' />";
				//$origem = '<div class="badge badge-alert badge-pill">Holanda</div>';
				}
				elseif($row['step_source']==0){
				$step_source = "<img src='img/flag/brasil.jpg' alt='Brasil' width='48' height='28' />";
				//$origem = '<div class="badge badge-dark badge-pill">Desconhecido</div>';	
				}
				elseif($row['step_source']==1){
				$step_source = "<img src='img/flag/china.jpg' alt='China' width='48' height='28' />";
				//$origem = '<div class="badge badge-warning badge-pill">Dinamarca</div>';	
				}
				elseif($row['step_source']==2){
				$step_source = "<img src='img/flag/denmark.jpg' alt='Denmark' width='48' height='28' />";
				//$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}
				elseif($row['step_source']==3){
				$step_source = "<img src='img/flag/german.jpg' alt='Germany' width='48' height='28' />";
				//$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}
				elseif($row['step_source']==4){
				$step_source = "<img src='img/flag/italian.jpg' alt='Italy' width='48' height='28' />";
				//$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}
				elseif($row['step_source']==5){
				$step_source = "<img src='img/flag/japan.jpg' alt='Japan' width='48' height='28' />";
				//$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}
				elseif($row['step_source']==6){
				$step_source = "<img src='img/flag/netherlands.jpg' alt='Netherlands' width='48' height='28' />";
				//$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}
				elseif($row['step_source']==7){
				$step_source = "<img src='img/flag/usa.jpg' alt='USA' width='48' height='28' />";
				//$origem = '<div class="badge badge-success badge-pill">Italia</div>';	
				}

			
//GERA UM LINK PARA TIPO DE MAQUINA 
//$step_machine = "<a href='".$row['step_machine']."' target='_blank'><div class='badge badge-success badge-pill'>".$row['step_machine']."</div></a>";
if ($row['step_machine'] == "SHP"){$step_machine = "<div class='badge badge-primary badge-pill'>".$row['step_machine']."</div>";}
elseif($row['step_machine'] == "SFG"){$step_machine = "<div class='badge badge-danger badge-pill'>".$row['step_machine']."</div>";}
else{$step_machine = "<div class='badge badge-success badge-pill'>".$row['step_machine']."</div>";}

//GERA UM LINK PARA PARTE DA MAQUINA 
//$step_part = "<a href='".$row['step_part']."' target='_blank'><div class='badge badge-dark badge-pill'>".$row['step_part']."</div></a>";
$step_part = "<div class='badge badge-dark badge-pill'>".$row['step_part']."</div>";


//SE TIVER IMAGEM NO BANCO, MOSTRA O PREVIEW, CASO CONTRARIO, NAO MOSTRA NADA
			if($row["step_image"] != '')		
			{
				$output['step_image'] = '<a href="img/gallery/'.$row["step_image"].'" target="_blank">
										<img src="img/gallery/'.$row["step_image"].'" class="img-thumbnail" width="70" height="55" />
										</a>
										<input type="hidden" name="hidden_step_image" value="'.$row["step_image"].'" />
										';

			}
			else
			{
				$output['step_image'] = '<input type="hidden" name="hidden_step_image" value="" />';
			}
			$output["step_machine"] = $step_machine;
			$output["step_part"] = $step_part;
			$output["step_name"] = $row["step_name"];
			$output["step_counter"] = $row["step_counter"];
			$output["step_instruction"] = $row["step_instruction"];
			$output["step_source"] = $step_source;
			$output["step_language"] = $step_language;
			$output["step_status"] = $row["step_status"];
			$output["id"] = $row["id"];
			$output["step_image"] = $row["step_image"];

			
		}
		echo json_encode($output);
	}
?>