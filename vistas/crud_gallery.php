<?PHP

// DB CONECTION
//ALL THE INSERTERS ARE HERE
	include_once '../../bd/config.php';
	$objeto = new Conexion();
	$conexion = $objeto->Conectar();
	// Recepción de los datos enviados mediante POST desde el JS   
	
	$step_machine = (isset($_POST['step_machine'])) ? $_POST['step_machine'] : '';
	$step_part = (isset($_POST['step_part'])) ? $_POST['step_part'] : '';
	$step_name = (isset($_POST['step_name'])) ? $_POST['step_name'] : '';
	$step_counter = (isset($_POST['step_counter'])) ? $_POST['step_counter'] : '';
	$step_status = (isset($_POST['step_status'])) ? $_POST['step_status'] : '';
	$step_instruction = (isset($_POST['step_instruction'])) ? $_POST['step_instruction'] : '';
	$step_source = (isset($_POST['step_source'])) ? $_POST['step_source'] : '';
	$step_language = (isset($_POST['step_language'])) ? $_POST['step_language'] : '';	
	$step_image = '';
	
/*	
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
*/	

	//Insertar
	if($_POST['action']=="create"){
	  if($_FILES["step_image"]["name"] != '')
	  {
		  $extension = explode('.', $_FILES['step_image']['name']);
		  $new_name = rand() . '.' . $extension[1];
		  $destination = '../img/gallery/' . $new_name;
		  move_uploaded_file($_FILES['step_image']['tmp_name'], $destination);
		  $step_image = $new_name;
		  
	  }
	}
	//editar
	if($_POST['action']=="editar"){
		if($_FILES["step_image"]["name"]!= '')
		{
			$extension = explode('.', $_FILES['step_image']['name']);
			$new_name = rand() . '.' . $extension[1];
			$destination = '../img/gallery/' . $new_name;
			move_uploaded_file($_FILES['step_image']['tmp_name'], $destination);
			$step_image = $new_name;
			
			
		}else{
			if($_POST["hidden_step_image"]!=""){
				$step_image = $_POST["hidden_step_image"];
				}else{
				$step_image = '';	
			}
		}
	}
	
	
	$action = (isset($_POST['action'])) ? $_POST['action'] : '';
	$id = (isset($_POST['id'])) ? $_POST['id'] : '';
	
	switch($action){
		case "create": //alta
        $consulta = $conexion->prepare("INSERT INTO gallery (step_machine, step_part, step_name, step_counter, step_status, step_instruction, step_source, step_language, step_image) VALUES(:step_machine, :step_part, :step_name, :step_counter, :step_status, :step_instruction, :step_source, :step_language, :step_image) ");		
		$consulta->execute(
		array(
		':step_machine'	=>	$step_machine,
		':step_part'	=>	$step_part,
		':step_name'	=>	$step_name,
		':step_counter'	=>	$step_counter,
		':step_status'	=>	$step_status,
		':step_instruction'	=>	$step_instruction,
		':step_source'	=>	$step_source,
		':step_language'	=>	$step_language,
		':step_image'	=>	$step_image
		)
		);
		if ($consulta->rowCount() > 0){
			$data = 1;
			}else{
			$data = 0;
		}
        break;
		case "editar": //modificación
        $consulta = $conexion->prepare("UPDATE gallery SET step_machine=:step_machine, step_part=:step_part, step_name=:step_name, step_counter=:step_counter, step_status=:step_status, step_instruction=:step_instruction, step_source=:step_source, step_language=:step_language, step_image=:step_image WHERE id=:id");	
		
		$consulta->execute(
		array(
		':step_machine'	=>	$step_machine,
		':step_part'	=>	$step_part,
		':step_name'	=>	$step_name,
		':step_counter'	=>	$step_counter,
		':step_status'	=>	$step_status,
		':step_instruction'	=>	$step_instruction,
		':step_source'	=>	$step_source,
		':step_language'	=>	$step_language,		
		':step_image'	=>	$step_image,
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