$(document).ready(function(){	




	var tablaPersonas =   $('#tablaPersonas').DataTable({
		"responsive": true,
		
		dom: 'lBfrtip',
		buttons: [
			{
				
				//DEFINE QUAIS COLUNAS SERÃO EXPORTADAS PARA PDF, EXCEL E CSV
				
				extend: 'collection',
				init: (api, node, config) => $(node).removeClass('btn-secondary'),
				className: 'btn btn-success',
				text: '<i class="fas fa-download"></i> Exportar',
				buttons: [
					{extend: 'csvHtml5',text:'<i class="fas fa-file-csv"></i> Exportar CSV',titleAttr: 'Csv',exportOptions: {
						columns: [0,1,2,3,4,5,6]
					}
					},
					{extend: 'excelHtml5',text:'<i class="fas fa-file-excel"></i> Exportar Excel',titleAttr: 'Csv',exportOptions: {
						columns: [0,1,2,3,4,5,6]
					}},
					{extend: 'pdfHtml5',text:'<i class="far fa-file-pdf"></i> Exportar PDF',titleAttr: 'Csv',exportOptions: {
						columns: [0,1,2,3,4,5,6]
					}},
				]
			},
			{
				extend: 'print',
				init: (api, node, config) => $(node).removeClass('btn-secondary'),
				className: 'btn btn-success ml-1',
				text: '<i class="fas fa-print"></i> Imprimir ',
				exportOptions: {
                    columns: [0,1,2,3,4,5,6]
				}
			}
		],
		
	 	"columnDefs": [
			{
				"targets": 13,
				"orderable": false
			} ],

			"search":[ {
				"searching": true
			} ],

			"language": {
		/*	"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" */       
			"url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
			},
			"lengthMenu": [ 10, 25, 50, 75, 100, 500, 1000, 1050, 1100, 1150, 1200, 1250 ],
			"lengthChange": true,
			"order": [[ 0, "desc" ]],
			'processing': true,
			'serverSide': true,
			'searching': true,
			'serverMethod': 'post',
			'ajax': {
				'url':'ajaxfile.php'
			},
			'columns': [

				{ data: 'id' },
				{ data: 'codigo' },
				{ data: 'imagen' },
				{ data: 'descricao_EN' },
				{ data: 'orcamento' },
				{ data: 'consolidado' },
				{ data: 'datahora' },
				{ data: 'cliente' },
				{ data: 'custo' },
				{ data: 'moeda' },
				{ data: 'desconto' },
				{ data: 'sistema' },
				{ data: 'origem' },				
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
		$(".modal-header").css("background-color", "#1cc88a");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Novo Item");  
		$('#action').val('create');          
		$("#createRow").modal("show");  
		$('#registro-btn').html("Salvar"); 
		
		  $('#user_uploaded_image').html('');   
		  id=null;
		opcion = 1; //alta
	});    


	
	$("#btnSalir, #btnSalir2").click(function(){
		$("#formPersonas").trigger("reset");
		$(".modal-header").css("background-color", "#1cc88a");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Sair");  
		$("#logoutModal").modal("show");  
	});   
	
	//MODAL DETALHES
	$(document).on('click', '.view', function(){
		var id = $(this).attr("id");
		var action = 'detalles';
		jQuery('.modal-title').html("Ver Detalhes");
		jQuery.ajax({
			url:"vistas/fetch_single.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(json){
				jQuery('#viewRow').modal('show');
								
				jQuery('#at-codigo').text(json.codigo);
				//jQuery('#at-imagen').text(json.imagen);
				jQuery('#at-descricao_EN').text(json.descricao_EN);
				jQuery('#at-orcamento').html(json.orcamento);
				jQuery('#at-consolidado').html(json.consolidado);
				jQuery('#at-datahora').text(json.datahora);
				jQuery('#at-cliente').html(json.cliente);
				jQuery('#at-custo').html(json.custo);
				jQuery('#at-moeda').html(json.moeda);
				jQuery('#at-desconto').html(json.desconto);
				jQuery('#at-sistema').text(json.sistema);				
				jQuery('#at-origem').html(json.origem);
			

//IMAGEM DO ITEM
//jQuery('#perfil_image').html('<a src="img/user.png" target="_blank"><img style="text-align:center;" class="profile-user-img img-fluid img-circle text-center" src="img/part.png" height="80" width="80" alt="Imagen"></a>');


if(json.imagen === ""){
jQuery('#perfil_image').html('<img style="text-align:center;" class="profile-user-img img-fluid img-circle text-center" src="img/part.png" height="80" width="80" alt="Imagen"></a>');
}else{
jQuery('#perfil_image').html('<a src="images/'+json.imagen+'" target="_blank"><img style="text-align:center;" class="profile-user-img img-fluid img-circle text-center" src="images/'+json.imagen+'" width="80" height="80" alt="Imagen"/></a>');
}


			}
		})
	});
	//EDIT BUTTON - BOTON EDITAR - BOTAO EDITAR    
	$(document).on('click', '.update', function(){
		var id = $(this).attr("id");
		var action = 'update';
		$.ajax({
			url:"vistas/fetch_single.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#createRow').modal('show');

				$('#id').val(data.id);
				$('#codigo').val(data.codigo);
				//$('#imagen').val(data.imagen);
				$('#descricao_EN').val(data.descricao_EN);
				$('#orcamento').val(data.orcamento);
			
			
			
			
			//	$('#consolidado').html(data.consolidado);
						 if(data.consolidado == 1){
   						    // data.consolidado = true;
							$('#consolidado').attr("checked");							
							$('#consolidado').prop("checked");
							}
							
							
							
							
							
				$('#datahora').val(data.datahora);
				$('#cliente').val(data.cliente);
				$('#custo').val(data.custo);
				$('#moeda').val(data.moeda);
				$('#desconto').val(data.desconto);
				$('#sistema').val(data.sistema);
				$('#origem').val(data.origem);
				$('#user_uploaded_image').html(data.user_image);
				$('#user_uploaded_image2').html(data.user_image2);
				
				$('#action').val("editar");				
				
				$(".modal-header").css("background-color", "#4e73df");
				$(".modal-header").css("color", "white");
				$(".modal-title").text("Editar Item"); 
				$('#registro-btn').html("Confirmar");
				
			}
		})
	});
	
	//DELETE BUTTON - BOTAO EXCLUIR - BOTON BORRAR
	$(document).on('click', '.btnBorrar', function(){
		var id = $(this).attr("id");
		var action = "borrar";
		
		swal({
			title: 'Deseja seguir com a exclusão?',
			text: "O registro será excluido permanentemente!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sim, apagar!',
			showLoaderOnConfirm: true,
			
			preConfirm: function() {
				return new Promise(function(resolve) {
					
					$.ajax({
						url: 'vistas/eliminar.php',
						type: 'POST',
						data: {id:id, action:action},
						dataType: 'json'
					})
					.done(function(response){
						swal('Excluido!', response.message, response.status);
						tablaPersonas.ajax.reload();
					})
					.fail(function(){
						swal('Oops...', 'Sistema instável :(!', 'error');
					});
				});
			},
			allowOutsideClick: false			  
		});	
	});	
	
	
	$("#formPersonas").submit(function(event){
		event.preventDefault();    

		var id = $.trim($("#id").val()); 
		var codigo = $.trim($("#codigo").val());
	//	var imagen = $.trim($("#imagen").val());
		var descricao_EN = $.trim($("#descricao_EN").val());  
		var orcamento = $.trim($("#orcamento").val());
		var consolidado = $.trim($("#consolidado").val()); 	
		var datahora = $.trim($("#datahora").val());
		var cliente = $.trim($("#cliente").val());
		var custo = $.trim($("#custo").val());
		var moeda = $.trim($("#moeda").val());
		var desconto = $.trim($("#desconto").val());		
		var sistema = $.trim($("#sistema").val());
		var origem = $.trim($("#origem").val()); 
			
		var action = $('input#action').val(); 
		
		//IMAGEM DA PECA 'gif','png','jpg','jpeg'
		var extension = $('#user_image').val().split('.').pop().toLowerCase();
		if(extension != '')
		{
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
			{
				alert("Tipo de Imagem Inválida! Use arquivos .jpg, .png ou .gif");
				$('#user_image').val('');
				return false;
			}
		}


		//ORCAMENTO ('doc','pdf','docx','PDF')
		var extension2 = $('#user_image2').val().split('.').pop().toLowerCase();
		if(extension2 != '')
		{
			if(jQuery.inArray(extension2, ['doc','pdf','docx','PDF']) == -1)
			{
				alert("Tipo de arquivo Inválido! Use arquivos .doc, .docx ou .pdf)");
				$('#user_image2').val('');
				return false;
			}
		}

//REGRA PARA SALVAR O REGISTRO. DEVE HAVER PREENCHIMENTO MINIMO NESTES CAMPOS

		if(codigo != '' && descricao_EN != '' && custo != '' && moeda != '' && desconto != '' && origem != '')
		
		{
			$.ajax({
				url:"vistas/crud.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data){
					if (data ==1){ 
						$('#formPersonas')[0].reset();
						$('#createRow').modal('hide');
						if(action == 'create'){
							swal("Registrado!", "Item cadastrado com sucesso!", "success");
							} else {
							swal("Atualizado!", "Item alterado com sucesso!", "success");
						}
						tablaPersonas.ajax.reload();
						}else{ 
						$('#createRow').modal('hide');
						tablaPersonas.ajax.reload();
						swal(":-)", "Boa!, item salvo com sucesso!", "success");
					}
					
					
					
					
				},
				error: function(data) {
					swal("Error!", "Erro, tente novamente!", "error");
				}	
				
				
			});
		}
		else
		{
			alert("Campos obrigatórios");
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