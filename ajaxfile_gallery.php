<?php

session_start();

/* AJAX CODE FOR DATATABLE WORKS. IF YOU NEED MORE OR LESS COLLUMS, MUST TO CHANGE THIS FILE.*/


	include '../bd/config.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	# Read value
	$draw = $_POST['draw'];
	$row = $_POST['start'];
	$rowperpage = $_POST['length']; // Rows display per page
	$columnIndex = $_POST['order'][0]['column']; // Column index
	$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
	$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
	$searchValue = $_POST['search']['value']; // Search value
	$searchArray = array();
	## Search 
	$searchQuery = " ";
	

	if($searchValue != ''){
		$searchQuery = " AND (
        step_machine LIKE :step_machine OR 
        step_part LIKE :step_part OR
		step_name LIKE :step_name OR
		step_counter LIKE :step_counter OR
		step_instruction LIKE :step_instruction OR
		step_source LIKE :step_source OR
		step_language LIKE :step_language OR	 	 
        step_status LIKE :step_status ) ";
		$searchArray = array( 
        'step_machine'=>"%$searchValue%", 
        'step_part'=>"%$searchValue%",
		'step_name'=>"%$searchValue%",
		'step_counter'=>"%$searchValue%",
		'step_instruction'=>"%$searchValue%",
		'step_source'=>"%$searchValue%",
		'step_language'=>"%$searchValue%",	
		'step_status'=>"%$searchValue%"
		);
	}

	
	## Total number of records without filtering
/*	$stmt = $conexion->prepare("SELECT COUNT(*) AS allcount FROM usuarios "); */
	$stmt = $conexion->prepare("SELECT COUNT(*) AS allcount FROM gallery ");
	$stmt->execute();
	$records = $stmt->fetch();
	$totalRecords = $records['allcount'];
	
	## Total number of records with filtering
/*	$stmt = $conexion->prepare("SELECT COUNT(*) AS allcount FROM usuarios WHERE 1 ".$searchQuery); */
	$stmt = $conexion->prepare("SELECT COUNT(*) AS allcount FROM gallery WHERE 1 ".$searchQuery);

	$stmt->execute($searchArray);
	$records = $stmt->fetch();
	$totalRecordwithFilter = $records['allcount'];
	
	## Fetch records
/*	$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset"); */
	$stmt = $conexion->prepare("SELECT * FROM gallery WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
	
	// Bind values
	foreach($searchArray as $key=>$search){
		$stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
	}
	
	$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
	$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
	$stmt->execute();
	$empRecords = $stmt->fetchAll();
	
	$data = array();

foreach($empRecords as $row){


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



/*
				if($row['idioma']==NULL or $row['idioma']==-1){
				$idioma = "<img src='img/flag/unknow.png' alt='Unknow' width='48' height='28' />";
				//$origem = '<div class="badge badge-alert badge-pill">Holanda</div>';
				}
				elseif($row['idioma']==0){
				$idioma = "<img src='img/flag/portugues.png' alt='Portugues' width='48' height='28' />";
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
		*/
		
	//	$originalDate = $row['datahora'];
	//	$datahora = date("d-m-Y", strtotime($originalDate));

//FOTO DOS USUARIOS COM LINK PARA ABRIR A FOTO. SE NAO TIVER USA AVATAR GENERICO
if ($row['step_image'] != ""){
$step_image = "<a href='img/gallery/".$row['step_image']."' target='_blank'><img src='img/gallery/".$row['step_image']."' alt='Step Image' width='48' height='48' /></a>";
}else{
$step_image = "<a href='img/gallery/unknow_step.png' target='_blank'><img src='img/gallery/unknow_step.png' alt='Step Image' width='48' height='48' /></a>";
}
			
			
//GERA UM LINK PARA TIPO DE MAQUINA 
//$step_machine = "<a href='".$row['step_machine']."' target='_blank'><div class='badge badge-success badge-pill'>".$row['step_machine']."</div></a>";
if ($row['step_machine'] == "SHP"){$step_machine = "<div class='badge badge-primary badge-pill'>".$row['step_machine']."</div>";}
elseif($row['step_machine'] == "SFG"){$step_machine = "<div class='badge badge-danger badge-pill'>".$row['step_machine']."</div>";}
else{$step_machine = "<div class='badge badge-success badge-pill'>".$row['step_machine']."</div>";}

//GERA UM LINK PARA PARTE DA MAQUINA 
//$step_part = "<a href='".$row['step_part']."' target='_blank'><div class='badge badge-dark badge-pill'>".$row['step_part']."</div></a>";
$step_part = "<div class='badge badge-dark badge-pill'>".$row['step_part']."</div>";

//REDUZ O TAMANHO DA INSTRUÇÕES PARA APRESENTA-LO ABREVIADO, 
//$step_instruction_reduz = substr($step_instruction,0,30);




//VERIFICA SE USUARIO TEM PERMISSAO PARA ADICIONAR E EXCLUIR REGISTROS		
if($_SESSION["nivel"] > 0){
			//if(1 > 0){		
		
		$op =' <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		
        <a class="dropdown-item view" href="#!" id="'.$row['id'].'"><svg class="feather" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> Ver detalhes</a>
				
        <a class="dropdown-item update" href="#!" id="'.$row['id'].'"><svg class="feather" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Editar</a>
		
        <a class="dropdown-item btnBorrar" href="#!" id="'.$row['id'].'"><svg class="feather" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Eliminar</a>
		</div>
		
		<button class="btn btn-datatable btn-icon btn-transparent-dark btnBorrar" id="'.$row['id'].'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
		
		}
		else{
		
$op =' <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		
        <a class="dropdown-item view" href="#!" id="'.$row['id'].'"><svg class="feather" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> Ver detalhes</a>
				
        <a disabled class="dropdown-item update disabled" href="#!" id=""><svg class="feather" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Editar</a>
		
        <a disabled class="dropdown-item btnBorrar disabled" href="#!" id=""><svg class="feather" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Excluir</a>
		</div>
		
		<button class="btn btn-datatable btn-icon btn-transparent-dark btnBorrar" disabled id="'.$row['id'].'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>';
		
		}
		
		$data[] = array(
		"id"=>$row['id'],
		"step_machine"=>$step_machine,
		"step_part"=>$step_part,
		"step_name"=>$row['step_name'],
		"step_counter"=>$row['step_counter'],
		"step_status"=>$row['step_status'],
		"step_instruction"=>$row['step_instruction'],
		"step_source"=>$step_source,
		"step_language"=>$step_language,	
		"step_image"=>$step_image,		
		"accion"=>$op
		);
		
		
		
	}
	
	## Response
	$response = array(
	"draw" => intval($draw),
	"iTotalRecords" => $totalRecords,
	"iTotalDisplayRecords" => $totalRecordwithFilter,
	"aaData" => $data
	);
	
	echo json_encode($response);