<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['action']) {
		
		include_once '../../bd/config.php';
		$objeto = new Conexion();
		$conexion = $objeto->Conectar();
		
		$pid = intval($_POST['id']);
		$query = "DELETE FROM item WHERE id=:pid";
		$stmt = $conexion->prepare( $query );
		$stmt->execute(array(':pid'=>$pid));
		
		if ($stmt) {
			$response['status']  = 'success';
			$response['message'] = 'Item excluido com sucesso!';
			} else {
			$response['status']  = 'error';
			$response['message'] = 'Erro ao excluir item...';
		}
		echo json_encode($response);
	}	