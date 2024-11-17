<?php require_once "vistas/parte_superior_gallery.php"
/* THIS FILE IS USED IN THE MIDDLE OF THE DASHBOARD. IT IMPORT MORE 2 FILES: PARTE SUPERIOR MEANS THE HEADER AND LEFT SIDE OF THE DASHBOAR. PARTE INFERIOR CORRESPOND TO DE FOOTER. */
?>
<!--INICIO DO CONTAINER PRINCIPAL-->

<div class="container_B">
	<div class="container mt-n10">
		<div class="card mb-4">
			<div class="card-header font-weight-bold">
			  <h4 class="font-weight-bold" > Step Gallery Controller </h4>
						
              <?PHP			
//VERIFICA SE USUARIO TEM PERMISSAO PARA ADICIONAR ITEM
if($_SESSION["nivel"] > 0){		
echo '<small class="float-sm-right"><button id="btnNuevo" type="button" class="btn btn-success btn-sm" data-toggle="modal"><i class="fas fa-plus"></i>&nbsp; Step Gallery</button></small></div>';
}else{
echo '<small class="float-sm-right"><button id="btnNuevo" type="button" class="btn btn-success btn-sm" data-toggle="modal" disabled><i class="fas fa-plus"></i>&nbsp; Step Gallery</button></small></div>';
}		
?>			
			
			
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">  
							<table id="tablaPersonas" class="table table-striped table-bordered  table-hover table-condensed" style="width:100%">
								<thead>
									<tr>
										<th width="2%">ID</th>
										<th width="10%">Machine</th>
										<th width="10%">Part</th>                                
										<th width="5%">Step</th>
										<th width="2%">Counter</th>
										<th width="5%">Image</th>
										<th width="30%">Instruction</th>
										<th width="2%">Source</th>
										<th width="2%">Language</th>  
										<th width="2%">Status</th> 
										<th width="5%">Control</th>  
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>ID</th>
										<th>Machine</th>
										<th>Part</th>
										<th>Step</th>
										<th>Counter</th>
										<th>Image</th>
										<th>Instruction</th>
										<th>Source</th>
										<th>Language</th>                                 
										<th>Status</th> 
										<th>Control</th>  
									</tr>
								</tfoot>
							</table> 
						</div></div> </div>                  
			</div>
			
		</div>  
	</div>    
	
	<!--Modal para CRUD-->
	<div class="modal fade" id="createRow" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document" style="max-width: 600px;">
			<form class="form-horizontal" id="formPersonas" enctype="multipart/form-data">
				<input type="hidden" name="action" id="action">    
				<input type="hidden" name="id" id="id">    
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title font-weight-bold">Add Step</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="font-weight-bold" for="step_machine">Machine</label>
			<!-- <input autocomplete="off" name="step_machine" id="step_machine" type="text" class="form-control" rel="gp" required placeholder="Step Machine"> -->
									<select require name="step_machine" id="step_machine" class="form-control" >
									<option value="">Choose...</option>
									
									
									<option value="Alpha">Alpha</option>
									<option value="Ardenta">Ardenta</option>
									<option value="BasicPasteur">BasicPasteur</option>
									<option value="BrakerPro">BrakerPro</option>
									
									<option value="SFG">Farm Grader</option>
								<!--<option value="FarmGrader">FarmGrader</option>-->
									
									<option value="FarmPacker">FarmPacker</option>
									<option value="FlexLoader">FlexLoader</option>
									<option value="Generic">Generic</option>
									<option value="GraderPro">GraderPro</option>
									
									<!--<option value="HatcheryPacker">HatcheryPacker</option>-->
									<option value="SHP">Hatchery Packer</option>
									<option value="HatcheryPerformance">HatcheryPerformance</option>
									<option value="Homogeneizador">Homogeneizator</option>
									<option value="Infeed6Rows">Infeed6Rows</option>
									<option value="JetWasher">JetWasher</option>
									<option value="Optiaccumulator">OptiAccumulator</option>
									<option value="OptiBraker">OptiBraker</option>
									<option value="OptiGrader">OptiGrader</option>
									<option value="OptiLoader">OptiLoader</option>
									<option value="Pasteurizador">Pasteurizador</option>
									<option value="PasteurWave">PasterWave</option>
									<option value="Pre-Accumulator">Pre-Accumulator</option>
									<option value="TrayStacker">TrayStacker</option>
									<option value="TrayStacker">TrayStacker</option>
									<option value="TrayWasher">TrayWasher</option>
									<option value="UltraFiltration">UltraFiltration</option>
									
									
																		
								</select>
							</div>
							<div class="form-group col-md-6">
								<label class="font-weight-bold" for="step_part">Part</label>
							<!-- <input type="text" name="step_part" id="step_part" class="form-control" placeholder="Part Name" required> -->
									<select require name="step_part" id="step_part" class="form-control" >
									<option value="">Choose...</option>
									<option value="Auxiliar Conveyor">Auxiliar Conveyor</option>	
									<option value="Basic Frame">Basic Frame</option>
									<option value="Bunker">Bunker</option>
									<option value="Denester">Denester</option>
									<option value="Drop Gates">Drop Gates</option>
									<option value="Egg Carrier">Egg Carrier</option>
									<option value="Eletric Panel">Eletric Panel</option>
									<option value="Elevator">Elevator</option>
									<option value="Infeed">Infeed</option>
									<option value="Inserter">Inserter</option>
									<option value="Main Chain">Main Chain</option>			
									<option value="Main Frame">Main Frame</option>	
									<option value="Main Pneumatics">Main Pneumatics</option>	
									<option value="Outfeed">Outfeed</option>
									<option value="Safety System">Safety System</option>
									<option value="Timming">Timming</option>
									<option value="Transporter">Transporter</option>	
									<option value="Transfer Head">Transfer Head</option>	
									<option value="Tray Conveyor">Tray Conveyor</option>
									<option value="Tunnel">Tunnel</option>
										
								</select>
								
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="font-weight-bold" for="step_name">Step</label>
								<div class="input-group">
									<input autocomplete="off" name="step_name" id="step_name" type="text" value="PASSO" class="form-control" rel="gp" data-size="6" required placeholder="Step Name">
								<!--	<span class="input-group-append">
										<button class="btn btn-danger getNewPass" type="button"><i class="fas fa-sync-alt"></i></button>
									</span>
								-->
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="font-weight-bold" for="step_counter">Counter</label>
								<input type="text" name="step_counter" id="step_counter" class="form-control" placeholder="Counter ID" >
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="font-weight-bold" for="step_status">Status</label>
								<div class="input-group">
				<!-- <input autocomplete="off" name="step_status" id="step_status" type="text" class="form-control" rel="gp" data-size="6" placeholder="Status"> -->
								<select name="step_status" id="step_status" class="form-control" >
									<option value="">Choose...</option>
									<option value="0">Disable</option>
									<option value="1" selected="selected">Enable</option>									
								</select>
								
								<!--	<span class="input-group-append">
										<button class="btn btn-danger getNewPass" type="button"><i class="fas fa-sync-alt"></i></button>
									</span>
								-->
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="font-weight-bold" for="step_instruction">Instruction</label>
								<input type="text" name="step_instruction" id="step_instruction" class="form-control" placeholder="Instruction" >
							</div>
						</div>
																	
						<div class="form-row">
						
							<div class="form-group col-md-6">
								<label class="font-weight-bold" for="step_source">Source</label>
							<!--	<input type="text" class="form-control" name="idioma" id="idioma" placeholder="Idioma" required> -->
									<select name="step_source" id="step_source" class="form-control" >
									<option value="">Choose...</option>
									<option value="0">Brazil</option>
									<option value="1">China</option>
									<option value="2">Denmark</option>
									<option value="3">Germany</option>
									<option value="4">Italy</option>
									<option value="5">Japan</option>
									<option value="6">Netherland</option>
									<option value="7">USA</option>
									<option value="-1">Unknow</option>										
								</select>
							</div>
							<div class="form-group col-md-6">
								<label class="font-weight-bold" for="step_language">Language</label>
								<select name="step_language" id="step_language" class="form-control" >
									<option value="">Choose...</option>
									<option value="0">Deutch</option>
									<option value="1">English</option>
									<option value="2">German</option>
									<option value="3">Italian</option>
									<option value="4">Portuguese</option>
									<option value="5">Spanish</option>
									<option value="-1">Unknow</option>
								</select>
							</div>
						</div>
						
						
						<div class="form-row">
							<div class="form-group col-md-8">            
								<label class="font-weight-bold">Step Image</label>
								<input type="file" name="step_image" class="form-control" id="step_image" />
							</div>
							<div class="form-group col-md-4"> 
								<label class="font-weight-bold">Preview</label> <br>          
								<span id="step_image_uploaded_image"></span>
							</div>    
						</div> 
						
					
						
					</div>
					<div class="modal-footer">
						<button  type="submit" class="btn btn-dark" id="registro-btn">Add Step</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div class="modal" id="viewRow" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title font-weight-bold">View Step Record</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="card card-dark card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<span id="perfil_image"></span>
							</div>
						
							
							<h5 class="profile-username text-center" id="at-step_machine"></h5>
							<p class="text-muted text-center font-weight-bold" id="at-step_machine"></p>			
						
							<ul class="list-group list-group-unbordered  py-2">																
								<li class="list-group-item font-weight-bold">
									<b>Machine:</b> <a class="float-right" id="at-step_machine"></a></li>
								<li class="list-group-item font-weight-bold">
									<b>Part:</b> <a class="float-right" id="at-step_part"></a>
								</li>
								<li class="list-group-item font-weight-bold">
									<b>Step:</b> <a class="float-right" id="at-step_name"></a>
								</li>
								<li class="list-group-item font-weight-bold">
									<b>Counter:</b> <a class="float-right" id="at-step_counter"></a>
								</li>
								<!--
								<li class="list-group-item font-weight-bold">
									<b>Image:</b> <a class="float-right" id="at-step_image"></a>
								</li>
								-->
								<li class="list-group-item font-weight-bold">
									<b>Instruction:</b> <a class="float-right" id="at-step_instruction"></a>
								</li>
								<li class="list-group-item font-weight-bold"><strong>Source</strong><b>:</b> <a class="float-right" id="at-step_source"></a>
								</li>
								<li class="list-group-item font-weight-bold">
									<b>Language:</b> <a class="float-right" id="at-step_language"></a>
								</li>
								<li class="list-group-item font-weight-bold">
									<b>Status:</b> <a class="float-right" id="at-step_status"></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    
</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior_gallery.php"?>