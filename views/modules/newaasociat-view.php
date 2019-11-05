<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Nuevo Persona <small>Registration</small></h1>
	</div>
	<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
</div>
<div class="container-fluid">
    <!--Aquí estaba el btn de agregar asociado-->
</div>
<!--AGREGAR ASOCIADO FORMULARIO-->
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<ul class="nav nav-tabs" style="margin-bottom: 15px;">
			  	<li class=""><a href="#new" data-toggle="tab">Nuevo Asociado</a></li>
			</ul>

			<div id="myTabContent" class="tab-content">
				<div class="formNewAss" id="new">
					<div class="container-fluid">
                        <!---formulario nuevo asociado -->
						<div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
							    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
									
                                    <div class="col-md-12">
										<div class="col-md-4 form-group row label-floating">
											<label for="listaDireccion" class="col-md-4 control-label">DIRECIÓN</label>
											<div class="col-md-12">
												<select class="form-control" id="listaDireccion" name="direccionAsoc" >
													<option>Jr. los chancas</option>
													<option>Jr. leoncio</option>
													<option>Jr. mariano melgar</option>
													<option>Av. chasqui</option>
												</select>
											</div>	                                            
										</div>                                        
                                        <div class="col-md-4 form-group label-floating ">
                                            <label class="control-label">Pasaje</label>
                                            <input class="form-control" type="text" name="direccionPsjAsoc" required>
                                        </div>
                                        <div class="col-md-4 form-group label-floating ">
                                            <label class="control-label">Nro Dirección </label>
                                            <input class="form-control" type="number" name="direccionNroAsoc" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
										<div class="col-md-6 form-group label-floating">
											<label for="listaCategoria" class="col-md-4 control-label">CATEGORIA</label>
											<div class="col-md-12">
												<select class="form-control" id="listaCategoria" name="categoriaAsoc">
													<option>Domestico</option>
													<option>Comercial</option>
													<option>Estatal</option>
													<option>Industrial</option>
												</select>
											</div>											
                                        </div>
                                        
                                        <div class="col-md-6 form-group label-floating">
											<label for="medidorAsoc" class="col-md-4 control-label">MEDIDOR</label>
											<div class="col-md-12">
												<select class="form-control" id="medidorAsoc" name="medidorAsoc">
													<option value="0">No</option>
													<option value="1">Si</option>													
												</select>
											</div>											
										</div>
									</div>

                                    <div class="col-xs-12 col-sm-12">                                        
                                        <div class="col-xs-6 col-md-6 form-group label-floating ">
                                          <label class="control-label">NOMBRE</label>
                                          <input class="form-control" type="text" name="nombreAsoc" required>
                                        </div>
                                        <div class="col-xs-6 col-md-6 form-group label-floating ">
                                          <label class="control-label">APELLIDO</label>
                                          <input class="form-control" type="text" name="apellidoAsoc" required>
                                        </div>

                                    </div>

                                    <div class="col-xs-12 col-sm-12">

                                        <div class="col-xs-12 col-md-6 form-group label-floating">
                                          <label class="control-label">DNI</label>
                                          <input class="form-control" type="text" name="dniAsoc" required>
                                        </div>

                                        <div class="col-xs-12 col-md-6 form-group label-floating">
                                          <label class="control-label">TELEFONO</label>
                                          <input class="form-control" type="number" name="telefonoAsoc">
                                        </div>

                                    </div>

								    <p class="text-center">
								    	<button type="submit" class="btn btn-info btn-raised btn-sm" name="registrarAsoc"><i class="zmdi zmdi-floppy"></i> GUARDAR</button>
								    </p>
							    </form>
							</div>
						</div>

                        <?php

                            require_once "./controllers/adminController.php";
                            $suministro = new adminController();
                            $result = $suministro->guardarUsuarioController();                        
                            if(isset($result)){
                                if($result){
                                    echo "sucess";
                                }else{
                                    echo "No success :C";
                                }
                            }
                        ?>
					</div>
				</div>
			</div>
		</div>
<!-- FIN - AGREGAR ASOCIADO FORMULARIO-->

<!-- BUSCAR ASOCIADO A TRAVÉS DE UN INPUT-->
        <div class="col-md-12"> 
            <div class="col-xs-12 col-sm-12">
                <div class="col-xs-12 col-md-4 form-group">
                    <input class="form-control" type="search" placeholder="Buscar Asociado " name="txtBuscarAsoc" id="txtBuscarAsoc">
                </div>
                <div class="col-xs-12 col-md-2 form-group ">
                    <button class="btn btn-success btn-raised btn-sm" name="btnBuscarAsoc" id="btnBuscarAsoc">Buscar</button>
                </div>                
            </div>
            <!--BTN PARA AGREGAR SUMINISTRO-->
            <a href="#addSumiModal" class="btn btn-primary" id="btnAddSumiModal" data-toggle="#" disabled><span class="glyphicon glyphicon-plus"></span>Agregar suministro</a>
            <!-- FIN - BTN PARA AGREGAR SUMINISTRO-->
            <div class="col-md-12">                            
                
					<div class="table-responsive">
						<table class="table table-hover text-center">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">DNI</th>
									<th class="text-center">Nombre</th>
									<th class="text-center">Apellido</th>
									<th class="text-center">Telefono</th>
									<th class="text-center">Estado</th>
									<th class="text-center">Cant. Suministro</th>
									<th class="text-center">Ver Suministros</th>
									<th class="text-center">Actualizar</th>
									<th class="text-center">Eliminar</th>
								</tr>
                            </thead>
                            <!--Respuesta servidor tabla de asociado-->                            
							<tbody class="responseAsoc">
								<tr>
									<td>1</td>
									<td>00001111</td>
									<td>Nombre</td>
									<td>Apellidos</td>
									<td>Telefono</td>
									<td>Estado</td>
									<td>Cantidad</td>
									<td><a href="#!" class="btn btn-success btn-raised btn-xs" ><i class="zmdi zmdi-refresh"></i></a></td>
									<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
									<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
								</tr>							
							</tbody>
                        </table>
                        <div class="infoAsoc">
                        </div>  
					</div>
			  	
                <!--MODAL PARA AGREGAR SUMINISTRO PARA USUARIO ESPECIFICO-->
                <div class="">
                    <!-- Agregar Nuevos Registros modal 1 -->
                    <div class="modal fade" id="addSumiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabelAddSumi" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="formularioSumi" enctype="multipart/form-data" autocomplete="off">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title text-center" id="myModalLabelAddSumi">INSERTAR SUMINISTRO</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                                <div class="col-xs-12 col-sm-12">
                                                    <div class="col-md-6 form-group label-floating ">
                                                        <label class="control-label">DNI</label>
                                                        <input class="form-control txtDniAsocModal" type="text" name="dniAsocSumi" id="txtDniAsocModal" value="#" disabled>
                                                    </div>
                                                    <div class="col-md-6 form-group label-floating ">
                                                        <label class="control-label">NOMBRE</label>
                                                        <input class="form-control txtNombreAsocModal" type="text" name="nombreAsocSumi" id="txtNombreAsocModal" value="#" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="col-md-12 form-group label-floating ">
                                                        <label for="listaCategoriaSumi" class="col-md-4 control-label">CATEGORIA</label>
                                                        <div class="col-md-12">
                                                            <select class="form-control" id="listaCategoriaSumi" name="categoriaSumi">
                                                                <option>Domestico</option>
                                                                <option>Comercial</option>
                                                                <option>Estatal</option>
                                                                <option>Industrial</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-sm-12">

                                                    <div class="col-md-12 form-group row label-floating">
                                                        <label for="listaDireccionSumi" class="col-md-4 control-label">DIRECIÓN</label>
                                                        <div class="col-md-12">
                                                            <select class="form-control" id="listaDireccionSumi" name="direccionSumi" >
                                                                <option>Jr. los chancas</option>
                                                                <option>Jr. leoncio</option>
                                                                <option>Jr. mariano melgar</option>
                                                                <option>Av. chasqui</option>
                                                            </select>
                                                        </div>	                                            
                                                    </div> 
                                                    <div class="col-md-8 form-group label-floating ">
                                                        <label class="control-label">Pasaje</label>
                                                        <input type="text" class="form-control"  id="direccionPsjSumi" name="direccionPsjSumi" required autofocus> 
                                                    </div>
                                                    <div class="col-md-4 form-group label-floating ">
                                                        <label class="control-label">Nro Dirección </label>
                                                        <input type="number" class="form-control" id="direccionNroSumi" name="direccionNroSumi" required>
                                                    </div>                                                            

                                                </div>                                                        
                                                
                                                <div class="col-md-12">
                                                    <div class="col-md-6 form-group label-floating">
                                                        <label for="medidorSumi" class="col-md-4 control-label">MEDIDOR</label>
                                                        <div class="col-md-12">
                                                            <select class="form-control" id="medidorSumi" name="medidorSumi">
                                                                <option value="0">No</option>
                                                                <option value="1">Si</option>													
                                                            </select>
                                                        </div>											
                                                    </div>
                                                    <div class="col-md-6 form-group label-floating">
                                                        <label for="corteSumi" class="col-md-4 control-label">CORTE</label>
                                                        <div class="col-md-12">
                                                            <select class="form-control" id="corteSumi" name="corteSumi">
                                                                <option value="0">No</option>
                                                                <option value="1">Si</option>													
                                                            </select>
                                                        </div>											
                                                    </div>
                                                    <!--Validar en el ajax para procesar la petición-->
                                                    <input type="hidden" name="insertSumin" value="true">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                                        <button type="submit" class="btn btn-primary btnaSum" id="btnisum"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Suministro</button>                                        
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- Agregar Nuevos Registros fin modal 1 -->
                </div>
                <!--FIN - MODAL PARA AGREGAR SUMINISTRO PARA USUARIO ESPECIFICO-->
            </div>

        </div>
<!-- FIN - BUSCAR ASOCIADO A TRAVÉS DE UN INPUT-->

<!-- MODAL PARA LISTAR LOS SUMINISTROS DEL ASOCIADO -->
<div class="modal fade" id="cantSumin" tabindex="-1" role="dialog" aria-labelledby="myModalcantSumin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center" id="myModalcantSumin"> LISTA DE SUMINISTROS POR ASOCIADO</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            
                            <div class="col-xs-12 col-sm-12">
                                <div class="col-xs-12 col-md-6 form-group label-floating ">
                                    <label class="control-label">DNI</label>
                                    <input class="form-control txtDniAsocModal" type="text" id="txtDniAsocModal" value="--" disabled>
                                </div>
                                <div class="col-xs-12 col-md-6 form-group label-floating">
                                    <label class="control-label">ASOCIADO</label>
                                    <input class="form-control txtNombreAsocModal" type="text" id="txtNombreAsocModal" value="--" disabled>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12">
                                <!-- Tabla del modal para mostrar suministro -->
                                <div class="table-responsive">
                                    <table class="table table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Codigo</th>
                                                <th class="text-center">dirección</th>
                                                <th class="text-center">Categoria</th>
                                                <th class="text-center">Medidor</th>
                                                <th class="text-center">Corte</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody class="responseSumi">
                                            <tr>
                                                <td>1</td>
                                                <td>66661111-0</td>
                                                <td>direccion</td>
                                                <td>categoria</td>
                                                <td>medidor</td>
                                                <td>corte</td>
                                            </tr>							
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                    </div>
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> ACEPTAR </button>
                </div>            
        </div>
    </div>

</div>
<!-- FIN - MODAL PARA LISTAR LOS SUMINISTROS DEL ASOCIADO -->

    <!--TABLA LISTA DE REGISTROS-->
    <!--
        <div class="col-xs-12">
           <div class="tab-pane">
               <div class="table-responsive">
                   <table class="table table-hover text-center">
                       <thead>
                       <tr>
                           <th class="text-center">#</th>
                           <th class="text-center">Nombre</th>
                           <th class="text-center">Dni/Ruc</th>
                           <th class="text-center">Telefono</th>
                           <th class="text-center">Cant. Sumistro</th>
                           <th class="text-center">Sumistro</th>
                           <th class="text-center">Actualizar</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr>
                           <td>1</td>
                           <td>Carlos Alfaro</td>
                           <td>75123459</td>
                           <td>952143568</td>
                           <td>1</td>
                           <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                           <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                       </tr>
                       <tr>
                           <td>2</td>
                           <td>Claudia Rodriguez</td>
                           <td>31254578</td>
                           <td>921453687</td>
                           <td>1</td>
                           <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                           <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                       </tr>
                       <tr>
                           <td>3</td>
                           <td>Ana Quispe</td>
                           <td>32154869</td>
                           <td>9685412367</td>
                           <td>1</td>
                           <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                           <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                       </tr>
                       <tr>
                           <td>4</td>
                           <td>Yuli Vargas</td>
                           <td>41586452</td>
                           <td>965412387</td>
                           <td>2</td>
                           <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                           <td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
                       </tr>
                       </tbody>
                   </table>
                   <ul class="pagination pagination-sm">
                       <li class="disabled"><a href="#!">«</a></li>
                       <li class="active"><a href="#!">1</a></li>
                       <li><a href="#!">2</a></li>
                       <li><a href="#!">3</a></li>
                       <li><a href="#!">4</a></li>
                       <li><a href="#!">5</a></li>
                       <li><a href="#!">»</a></li>
                   </ul>
               </div>
           </div>
       </div>
    -->

	</div>
</div>