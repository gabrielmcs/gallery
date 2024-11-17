
</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
            <span><h6>Galeria - Manual de Instruções - <span class="badge badge-pill badge-danger" ><?PHP echo date("Y"); ?></h6></span>
		</div>
	</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->	

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">-</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Deseja sair?</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				<a class="btn btn-primary" href="../bd/logout.php">Sair</a>
				
			</div>
		</div>
	</div>
</div>
<!-- LOADING -->
<script type="text/javascript" src="../plugins/pace-master/pace.min.js"></script>
<link rel="stylesheet" href="../plugins/pace-master/themes/yellow/corner-indicator.css">  
<!-- LOADING -->

<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- datatables JS -->
<script type="text/javascript" src="vendor/datatables/datatables.min.js"></script>
    
<!-- código propio JS --> 
<script src="assets/swal2/sweetalert2.min.js"></script>


<!--Export Datatable in EXCEL, PDF, CSV-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

<!-- Datatable Responsive (com os botoes de + e -) -->
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

<!-- Script principal customizado do sistema  -->
<script type="text/javascript" src="main.js"></script> 
<script>
/*---------------------------------------------------------*/	
/* FUNCTION BUTTON LOADER ---------------------------------*/
/*---------------------------------------------------------	*/

$('#registro-btn').click(function(){

  $('#registro-btn').button('loading');
  
  /* perform processing then reset button when done */
  setTimeout(function() {
       $('#registro-btn').button('reset');
  }, 1000000);
  
  
});
/*---------------------------------------------------------*/	
	
</script> 
</body>
</html>