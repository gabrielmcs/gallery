<?PHP

// DB CONECTION
//ALL THE DELETES ARE HERE
header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['action']) {
		
		include_once '../../bd/config.php';
		$objeto = new Conexion();
		$conexion = $objeto->Conectar();
		
		$pid = intval($_POST['id']);
		$query = "DELETE FROM gallery WHERE id=:pid";
		$stmt = $conexion->prepare( $query );
		$stmt->execute(array(':pid'=>$pid));
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Record Successfully Deleted!';
			} else {
			$response['status']  = 'error';
			$response['message'] = 'Error while deleting record...';
		}
		echo json_encode($response);
	}	
	
	