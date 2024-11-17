<?php
	session_start();
	
	if($_SESSION["s_usuario"] === null){
		header("Location: ../index.php");
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////
$usuario = $_SESSION["s_usuario"];	
//CONEXAO COM BANCO	
include_once '../bd/config.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
//VERIFICANDO QUE O USUARIO E SENHA ESTAO CORRETOS, LEVANTA OS DADOS DO USUARIO (PERFIL, IDIOMA, ETC...)		
$select = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE usuario='$usuario'");
$select->execute();
$result = $select->fetch(PDO::FETCH_ASSOC);
$_SESSION["usuario"] = $result['usuario'];
$_SESSION["nivel"] = $result['nivel'];
$_SESSION["idioma"] = $result['idioma'];
$_SESSION["imagen"] = $result['imagen'];
$_SESSION["doc"] = $result['doc'];
$_SESSION["passaporte"] = $result['passaporte'];
$_SESSION["telefone"] = $result['telefone'];
$_SESSION["email"] = $result['email'];
$imagem = $result['imagen'];	
////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
<!DOCTYPE html>
<html lang="en">
	
	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		
<link rel="icon" type="image/png" href="../imagens/favicon-192x192.png" sizes="192x192" />	
<link rel="icon" type="image/png" href="../imagens/favicon-128x128.png" sizes="128x128" />
<link rel="icon" type="image/png" href="../imagens/favicon-48x48.png" sizes="48x48" />
<link rel="icon" type="image/png" href="../imagens/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="../imagens/favicon-16x16.png" sizes="16x16" />
      
	  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sanovo LATAM - Cadastro de Usuário</title>
		
		<!-- Custom fonts for this template-->
		<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		
		
		<!--datables CSS básico-->
		<link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css"/>
		<!--datables estilo bootstrap 4 CSS-->  
		<link rel="stylesheet"  type="text/css" href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">  
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">    
		<link rel="stylesheet" href="assets/swal2/sweetalert2.min.css" type="text/css" />
		
		<!-- Custom styles for this template-->
		<link href="css/sb-admin-2.min.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">

		<link href="css/styles.css" rel="stylesheet">
		
	</head>
	
	<body id="page-top">
		
		<!-- Page Wrapper -->
		<div id="wrapper">
			
			<!-- Sidebar -->
			<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
				
				<!-- Sidebar - Brand -->
				<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
				<!-- 	<div class="sidebar-brand-icon rotate-n-15">
					<i class="fa fa-laugh-wink text-dark fa-4x"></i> -->
					<div class="sidebar-brand-icon">
					<i><img class="center-block img-fluid d-block" width="50" height="50" src="../imagens/icone.png" ></i>					</div>
					<div class="sidebar-brand-text mx-3">DashBoard<sup></sup></div>
				</a>
				
				<!-- Divider -->
				<hr class="sidebar-divider my-0">
				
				<!-- Nav Item - Dashboard -->
				<li class="nav-item active">
					<a class="nav-link" href="index.php">
						<i class="fas fa-fw fa-2x text-dark fa-tachometer-alt"></i>
					<span>Painel de controle</span></a>				</li>
				
				
				
				<!-- Divider -->
				<hr class="sidebar-divider">
				
				
				
				<!-- Heading RETIRADO POR NAO TER FUNCAO-->
			<!--	<div class="sidebar-heading text-dark">
					Interface 
				</div>
				-->
				
				<!-- Nav Item - Pages Collapse Menu -->
				
				<!-- Tela de Itens -->
				
	<!--			<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
						<i class="fas fa-fw fa-cogs fa-2x text-dark"></i>
						<span class="text-dark">Itens</span>
					</a>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">Controle de Itens:</h6>
							<a id="btnNuevo2" data-toggle="modal" class="collapse-item" href="#">Adicionar Itens</a>
							<!-- <a class="collapse-item" href="cards.php">Cards</a> -->
							
			<!--			</div>
					</div>
				</li>
			-->	
				<!-- BOTAO ITEM -->
				<!-- Tela de Usuarios -->
              <!--		<li class="nav-item">
					<a class="nav-link collapsed" href="../user.php" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
						<i class="fas fa-fw fa-user fa-2x text-dark"></i>
						<span class="text-dark">Usuários</span>
					</a>
					
			-->		
				<!--	<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar"> -->
	          <!--			<div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">Controle de Usuários:</h6>
						<!--	<a id="btnNuevo4" data-toggle="modal" class="collapse-item" href="#">Adicionar Usuários</a> -->
							<!--<a class="collapse-item" href="cards.php">Cards</a>-->
				
                <!--			<a id="btnNuevo4" data-toggle="modal" class="collapse-item" href="#">Adicionar Usuários</a>
						</div>
					</div>
				</li>
				-->
				
				
				
                <!-- BOTAO USUARIOS -->
				            <li class="nav-item">
				                      <a class="nav-link" href="user.php">
				                            <i class="fas fa-fw fa-user fa-2x text-dark"></i>
				                            <span class="text-dark">Usuário</span> </a> </li>
	            <!-- BOTAO GALLERY -->
				            <li class="nav-item"> 
				                     <a class="nav-link" href="gallery.php"> 
			                                <i class="fas fa-camera-retro text-dark fa-2x"></i> 
			                                <span class="text-dark">Galeria</span> </a> </li>
	            <!-- BOTAO AGENDA DE SERVICOS -->
              <!-- BOTAO SAIR -->
			                <li class="nav-item">
			                            <a class="nav-link collapsed" href="#" data-toggle="modal" id="btnSalir2">
			                                      <i class="fas fa-sign-out-alt text-dark fa-2x"></i>
			                                      <span class="text-dark">Logout</span> </a> </li>
                <!-- Divider -->
	            <hr class="sidebar-divider d-none d-md-block">
				
	            <!-- Sidebar Toggler (Sidebar) -->
				            <div class="text-center d-none d-md-inline">
				                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
              </div>
			</ul>
			<!-- End of Sidebar -->
			
			<!-- Content Wrapper -->
			<div id="content-wrapper" class="d-flex flex-column">
				
				<!-- Main Content -->
				<div id="content">
					
					<!-- Topbar -->
					<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
						
						<!-- Sidebar Toggle (Topbar) -->
						<button id="sidebarToggleTop" class="btn btn-link d-md-none text-dark rounded-circle mr-3">
							<i class="fa fa-bars"></i>
						</button>
						
						
						
						<!-- Topbar Navbar -->
						<ul class="navbar-nav ml-auto">
							
							<!-- Nav Item - Search Dropdown (Visible Only XS) -->
							<li class="nav-item dropdown no-arrow d-sm-none">
								<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-mobile fa-fw text-dark fa-2x"></i>
								</a>
								<!-- Dropdown - Messages -->
								<!-- COMENTADO O SEARCH MENU NO FORMATO MOBILE, QUE NAO TEM FUNCAO NESTE CASO-->
								<!--
								<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
									<form class="form-inline mr-auto w-100 navbar-search">
										<div class="input-group">
											<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
											<div class="input-group-append">
												<button class="btn btn-primary" type="button">
													<i class="fas fa-search fa-sm"></i>
												</button>
											</div>
										</div>
									</form>
								</div>
								-->
							</li>
							
							
							
							<div class="topbar-divider d-none d-sm-block"></div>
							
							<!-- Nav Item - User Information -->
							<li class="nav-item dropdown no-arrow">
								<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["s_usuario"];?></span>
								<!--	<img class="img-profile rounded-circle" src="img/user.png">   -->
								<img class="img-profile rounded-circle" src="images/<?php echo $imagem;?>">
								</a>
								<!-- Dropdown - User Information -->
								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
									<a class="dropdown-item" href="#" id="">
										<i class="fas fa-eye fa-sm fa-fw mr-2 text-danger-400"></i>
										<b>Acessos:</b> <?php echo $result['contador'];?>
									</a>		
								<a class="dropdown-item" href="#" id="">
										<i class="fas fa-calendar fa-sm fa-fw mr-2 text-danger-400"></i>
										<b>Último acesso:</b> <?php echo $result['ultimo_acesso'];?>
								  </a>
														<!--	RETIREI ESTA PARTE DO USUARIO POR NAO HAVER FUNCAO AINDA.
			
								<a class="dropdown-item" href="#">
										<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
										Activity Log
									</a>
									
								-->
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#" data-toggle="modal" id="btnSalir">
										<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
										Sair
									</a>
								</div>
							</li>
							
						</ul>
						
					</nav>
					<!-- End of Topbar -->