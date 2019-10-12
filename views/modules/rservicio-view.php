<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Registrar <small>Servicio</small></h1>
    </div>
<!--    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
--></div>

<div class="container-fluid" onload="listar_rs('');">

    <div class="container" onload="listar_rs('');">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_consultar">


                <div class="row form-horizontal">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-xs-4  text-right">
                                    <label for="buscar" class="control-label">Buscar:</label>
                                </div>
                                <div class="col-xs-4">
                                    <input  type="text" name="buscar" id="buscarRS" class="form-control" onkeyup="listar_rs(this.value);" placeholder="Ingrese Cod. Suministro o Nombre / Calle"/>
                                </div>
                            </div>
                            <div class="form-group" id="datos-result">
                                <div class="card my-4" id="containerRS">
                                </div>
                                <div id="listaRS"></div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
          </div>

            <!--LOS DATOS DE SERVICIO-->


                <div class="container-fluid">
						<div class="row">


                            <div class="col-lg-12 col-md-8 col-sm-8 col-xs-8 rs-asusap" style="background: rgba(25,25,25,.1);">

                                        <div class="col-xs-12 col-sm-12">
                                            <label class="text-danger" name="nameUser">N. servicio <p id="idrs">1</p></label>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="col-xs-12 col-md-6 ">
                                                    <h3 class="tile-titles text-left font-weight-bold"class="text-titles" ><b> Nombre: </b><small id="nombreSR">Ana</small></h3>
                                            </div>
                                            <div class="col-xs-12 col-md-6 ">
                                                    <h3 class="tile-titles text-left font-weight-bold"><b> Apellido: </b><small id="apellSR">Vargas Huaman</small></h3>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="col-xs-12 col-md-6 ">
                                                    <h3 class="tile-titles text-left font-weight-bold" ><b> Cod. Suministro: </b><small id="codSR">254</small></h3>
                                            </div>
                                            <div class="col-xs-12 col-md-6 ">
                                                    <h3 class="tile-titles text-left font-weight-bold"><b> Direccion: </b><small id="direRS">Av. NG 256</small></h3>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="col-xs-12 col-md-3 ">
                                                    <h3 class="tile-titles text-left font-weight-bold"><b>Año:</b> <small id="anioRS">2019</small></h3>
                                            </div>
                                            <div class="col-xs-12 col-md-3 ">
                                                    <h3 class="tile-titles text-left font-weight-bold"><b>Mes: </b><small id="mesRS">Octubre</small></h3>
                                            </div>
                                            <div class="col-xs-12 col-md-6 ">
                                                <h3 class="tile-titles text-left font-weight-bold"><b>A nombre de: </b><small><input type="text"  id="anombre"></small></h3>
                                            </div>
                                        </div>

                                <div class="col-xs-12 col-sm-12">
                                    <div class="col-xs-12 col-md-6 ">

                                        <h3 class="tile-titles text-left font-weight-bold"><b>Detalles</b></h3>
                                    </div>
                                </div>



                                <div class="col-xs-12"
                                <div class="tab-pane fade" id="list">
                                    <div class="table-responsive">
                                        <table class="table table-bordered  text-center" >
                                            <thead class="tabla-cabezera">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Nombre - Descripcion</th>
                                                <th class="text-center">Costo</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table table-striped" id="table-body">

                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                                <div class="col-xs-12 col-sm-12">

<!--                                    <div class="ajax-action-button" id="add-more" onClick="createNew();">Agregar</div>
-->                                 <button  type="submit"  class="btn btn-danger btn-raised btn-sm  align-items-center  " id="add-more" onClick="crearNuevo();" value="+1" >
                                       Agregar Item
                                    </button>

                                    <div class="col-xs-12 col-sm-12">
                                        <div class="col-xs-12 col-md-2 ">
                                            <h3 class="tile-titles text-left font-weight-bold"><b> Total: </b><small>s/ 35.00</small></h3>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-center">
                                    <button type="submit"  class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> GUARDAR</button>
                                    <button type="submit"  class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> IMPRIMIR</button>

                                </p>
                                </div>


                            </div>
                        </div>
                    </div>
        </div>
    </div>


   <!-- <div class="col-xs-12"
        <div class="tab-pane fade" id="list">
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nombre - Descripcion</th>
                        <th class="text-center">Costo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Servicio de arreglamiento</td>
                        <td>s/ 15.00</td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Instalacion de agua a domicilio</td>
                        <td>s/ 20.00</td>
                    </tr>
                    </tbody>
                </table>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12">

            <div class="col-xs-12 col-md-12 align-items-center">
                <button class="btn btn-success btn-raised btn-xs" name="nameUser">Agregar Item</button>
            </div>

            <div class="col-xs-12 col-sm-12">
                <div class="col-xs-12 col-md-3 ">
                    <h2 class="text-titles"> Total: <small>s/ 35.00</small></h2>
                </div>
            </div>
        </div>

            <p class="text-center">
                <button type="submit"  class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> GUARDAR</button>
                <button type="submit"  class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> IMPRIMIR</button>

            </p>
    </div>-->

</div>


