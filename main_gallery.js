$(document).ready(function(){	
	var tablaPersonas =   $('#tablaPersonas').DataTable({
		"responsive": true,
		dom: 'lBfrtip',
		buttons: [
			{
				extend: 'collection',
				init: (api, node, config) => $(node).removeClass('btn-secondary'),
				className: 'btn btn-success',
				text: '<i class="fas fa-download"></i> Export',
				buttons: [
					{extend: 'csvHtml5',text:'<i class="fas fa-file-csv"></i> Export CSV',titleAttr: 'Csv',	
					exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9]
					/*	columns: [0,1,2,3,4,5,6,7,8,9,10] */
					}
					},
					{extend: 'excelHtml5',text:'<i class="fas fa-file-excel"></i> Export Excel',titleAttr: 'Csv',exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9]
					/*	columns: [0,1,2,3,4,5,6,7,8,9,10] */
					}},
					{extend: 'pdfHtml5',text:'<i class="far fa-file-pdf"></i> Export PDF',titleAttr: 'Csv',exportOptions: {
						columns: [0,1,2,3,4,5,6,7,8,9]
					/*	columns: [0,1,2,3,4,5,6,7,8,9,10] */
					}},
				]
			},
			{
				extend: 'print',
				init: (api, node, config) => $(node).removeClass('btn-secondary'),
				className: 'btn btn-success ml-1',
				text: '<i class="fas fa-print"></i> Print ',
				exportOptions: {
                    	columns: [0,1,2,3,4,5,6,7,8,9]
					/*	columns: [0,1,2,3,4,5,6,7,8,9,10] */
				}
			}
		],
		
	 	"columnDefs": [
			{
				"targets": 10,
				"orderable": false
			} ],
			"language": {
		/*	"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"    */   
			"url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
			},
			"lengthMenu": [ 10, 25, 50, 75, 100, 500, 1000, 1050, 1100, 1150 ],
			"lengthChange": true,
			"order": [[ 0, "desc" ]],
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			'ajax': {
				'url':'ajaxfile_gallery.php'
			},
			'columns': [
				{ data: 'id' },
				{ data: 'step_machine' },
				{ data: 'step_part' },
				{ data: 'step_name' },
				{ data: 'step_counter' },
				{ data: 'step_image' },
				{ data: 'step_instruction' },
				{ data: 'step_source' },
				{ data: 'step_language' },
				{ data: 'step_status' },
				{ data: 'accion' },
			],
			drawCallback: function () {
				$(".btn-group").addClass("btn-group-sm");
			}
	});
	
	
/* --------------------------------FINAL JQUERY DATATABLE ------------------------------------------------*/	
	
    //MODAL INSERIR 
	$("#btnNuevo, #btnNuevo2").click(function(){
		$("#formPersonas").trigger("reset");
	    $(".modal-header").css("background-color", "#4e73df");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Add Record");  
		$('#action').val('create');          
		$("#createRow").modal("show");  
		$('#registro-btn').html("save");   
		$('#step_image_uploaded_image').html('');   
		id=null;
		opcion = 1; //alta
	});    
	$("#btnSalir, #btnSalir2").click(function(){
		$("#formPersonas").trigger("reset");
		$(".modal-header").css("background-color", "#4e73df");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("close");  
		$("#logoutModal").modal("show");  
	});   
	
	//MODAL DETALHES
	$(document).on('click', '.view', function(){
		var id = $(this).attr("id");
		var action = 'detalles';
		jQuery('.modal-title').html("See Details");
		jQuery.ajax({
			url:"vistas/fetch_single_gallery.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(json){
				jQuery('#viewRow').modal('show');
								
				jQuery('#at-step_machine').text(json.step_machine);
				jQuery('#at-step_part').text(json.step_part);
				jQuery('#at-step_name').text(json.step_name);
				jQuery('#at-step_counter').text(json.step_counter);
				jQuery('#at-step_instruction').html(json.step_instruction);
				jQuery('#at-step_source').html(json.step_source);				
				jQuery('#at-step_language').html(json.step_language);
				jQuery('#at-step_status').html(json.step_status);

								
if(json.step_image === ""){
jQuery('#perfil_image').html('<a src="img/gallery/unknow_step.png" target="_blank"><img class="profile-step_image-img img-fluid img-circle" src="img/gallery/unknow_step.png" height="80" width="80" alt="Image"></a>');
}else{
jQuery('#perfil_image').html('<a src="img/gallery/'+json.step_image+'" target="_blank"><img class="profile-step_image-img img-fluid img-circle" src="img/gallery/'+json.step_image+'" width="80" height="80" alt="Image"/></a>');
				}
			}
		})
	});
	//EDIT BUTTON - BOTON EDITAR - BOTAO EDITAR    
	$(document).on('click', '.update', function(){
		var id = $(this).attr("id");
		var action = 'update';
		$.ajax({
			url:"vistas/fetch_single_gallery.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#createRow').modal('show');
				/*`codigo`,`apellidos`,`nombres`,`genero`,`step_image`,`estado`,`fecha`*/

				$('#step_machine').val(data.step_machine);
				$('#step_part').val(data.step_part);
				$('#step_name').val(data.step_name);
				$('#step_counter').val(data.step_counter);
				$('#step_instruction').val(data.step_instruction);
				$('#step_source').val(data.step_source);
				$('#step_language').val(data.step_language);
				$('#step_status').val(data.step_status);
				$('#id').val(data.id);
				
				$('#step_image_uploaded_image').html(data.step_image);
				$('#action').val("editar");				
				
				$(".modal-header").css("background-color", "#4e73df");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Edit Record"); 
				$('#registro-btn').html("Update");
				
			}
		})
	});
	
	//DELETE BUTTON - BOTAO EXCLUIR - BOTON BORRAR
	$(document).on('click', '.btnBorrar', function(){
		var id = $(this).attr("id");
		var action = "borrar";
		
		swal({
			title: 'Do you want to delete?',
			text: "This record will be permanently excluded!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#32c22d',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete!',
			showLoaderOnConfirm: true,
			
			preConfirm: function() {
				return new Promise(function(resolve) {
					
					$.ajax({
						url: 'vistas/eliminar_gallery.php',
						type: 'POST',
						data: {id:id, action:action},
						dataType: 'json'
					})
					.done(function(response){
						swal('Deleted!', response.message, response.step_status);
						tablaPersonas.ajax.reload();
					})
					.fail(function(){
						swal('Oops...', 'Unstable System :(!', 'error');
					});
				});
			},
			allowOutsideClick: false			  
		});	
	});	
	
	
	$("#formPersonas").submit(function(event){
		event.preventDefault();    

		var step_machine = $.trim($("#step_machine").val());
		var step_part = $.trim($("#step_part").val());
		var step_name = $.trim($("#step_name").val()); 
		var step_counter = $.trim($("#step_counter").val()); 
		var step_instruction = $.trim($("#step_instruction").val()); 
		var step_source = $.trim($("#step_source").val()); 
		var step_language = $.trim($("#step_language").val()); 
		var step_status = $.trim($("#step_status").val()); 
		var id = $.trim($("#id").val()); 
		
		
		var action = $('input#action').val(); 
		
		var extension = $('#step_image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Invalid Image!");
				$('#step_image').val('');
				return false;
			}
		}
		
		
	/*	if(codigo != '' && nombres != '' && apellidos != '' && genero != '') */
		if(step_machine != '' && step_part != '' && step_name != '' && step_counter != '' && step_instruction != '')
		
		{
			$.ajax({
				url:"vistas/crud_gallery.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data){
					if (data ==1){ 
						$('#formPersonas')[0].reset();
						$('#createRow').modal('hide');
						if(action == 'create'){
							swal("Recorded!", "Step registered successfully!", "success");
							} else {
							swal("Updated!", "Step updated successfully!", "success");
						}
						tablaPersonas.ajax.reload();
						}else{ 
						$('#createRow').modal('hide');
						tablaPersonas.ajax.reload();
						swal(":(", "Error while registering record...", "warning");
					}
					
					
					
					
				},
				error: function(data) {
					swal("Error!", "Please, try again", "error");
				}	
				
				
			});
		}
		else
		{
			alert("Mandatory fields!");
		}
		
		
	});   
});

// GERA A CRIPTOGRAFIA DA SENHA NO BANCO

function randString(id){
	
	var dataSet = $(id).attr('data-character-set').split(',');  
	
	var possible = '';
	
	if($.inArray('a-z', dataSet) >= 0){
		
		possible += 'abcdefghijklmnopqrstuvwxyz';
		
	}
	
	if($.inArray('A-Z', dataSet) >= 0){
		
		possible += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		
	}
	
	if($.inArray('0-9', dataSet) >= 0){
		
		possible += '0123456789';
		
	}
	
	if($.inArray('#', dataSet) >= 0){
		
		possible += '![]{}()%&*$#^<>~@|';
		
	}
	
	var text = '';
	
	for(var i=0; i < $(id).attr('data-size'); i++) {
		
		text += possible.charAt(Math.floor(Math.random() * possible.length));
		
	}
	
	return text;
	
}
// Create a new codigo
$(".getNewPass").click(function(){
	
	var field = $(this).closest('div').find('input[rel="gp"]');
	
	field.val(randString(field));
	
});
// Auto Select Pass On Focus
$('input[rel="gp"]').on("click", function () {
	$(this).select();
}); 