<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles">
            <i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Generar <small>Consumo <b>Octubre 2019</b></small>
        </h1>
    </div>
</div>
<div class="container-fluid">

    <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Generar por Consumo</a>

    <!-- Agregar Nuevos Registros -->
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel"> Llena los campos</h4></center>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="col-xs-12 col-sm-12">
                                <div class="col-xs-12 col-md-12 form-group label-floating ">
                                    <label class="control-label">NOMBRE</label>
                                    <input class="form-control" type="text" name="nameUser">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <div class="col-xs-12 col-md-12 form-group label-floating ">
                                    <label class="control-label">APELLIDO</label>
                                    <input class="form-control" type="text" name="apellUser">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12">
                                <div class="col-xs-12 col-md-6 form-group label-floating ">
                                    <label class="control-label">DNI</label>
                                    <input class="form-control" type="text" name="dniUser">
                                </div>
                                <div class="col-xs-12 col-md-6 form-group label-floating">
                                    <label class="control-label">DIRECCION</label>
                                    <input class="form-control" type="text" name="direUser">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12">

                                <div class="col-xs-12 col-md-6 form-group label-floating">
                                    <label class="control-label">TELEFONO</label>
                                    <input class="form-control" type="number" name="telefUser">
                                </div>
                                <div class="col-xs-12 col-md-6 form-group label-floating">
                                    <label class="control-label">ESTADO</label>
                                    <input class="form-control" type="text" name="estadoUser">
                                </div>
                            </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                    <button type="submit" name="agregar" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Registro</button>

                </div>
                </form>
            </div>
        </div>

    </div>
</div>



    <div class="container" onload="listar_gconsumo('');">
        <div class="row form-horizontal">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_consultar" data-toggle="tab">Tab A</a></li>
            </ul>
        </div>
        </br>

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
                                    <input  type="text" name="buscar" id="buscar" class="form-control" onkeyup="listar_gconsumo(this.value);" placeholder="Ingrese Cod. Suministro o Nombre"/>
                                </div>
                            </div>
                            <div class="form-group" id="datos-resultGC">
                                    <div class="card-body" id="container">
                                    </div>
                                    <div id="lista"></div>
                            </div>

                        </div>

                    </div>
                </div>


            </div>

        </div><!-- tab content -->
    </div>



    <!--<div class="col-xs-12 col-sm-12">


        <diV class="row justify-content-center page-header">
            <h3 class="tile-titles text-center font-weight-bold"><b>Generar recibo para usuarios con MEDIDOR</b></h3>
        </diV>


        <div class="col-xs-12 col-md-4 form-group">
            <input class="form-control" type="search" name="nameUser">
        </div>
        <div class="col-xs-12 col-md-4 form-group ">
            <button class="btn btn-success btn-raised btn-xs" name="nameUser">buscar</button>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">

            <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                <li><a href="#list" data-toggle="tab">Lista</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="new">
                    <div class="container-fluid">
                    </div>
                </div>



            </div>
        </div>
        <div class="col-xs-12"
        <div class="tab-pane fade" id="list">
            <div class="table-responsive">

                <table class="table table-hover text-center">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Codigo</th>
                        <th class="text-center">Domicilio</th>
                        <th class="text-center">Cosumo</th>
                        <th class="text-center">Monto</th>
                        <th class="text-center">Mes</th>
                        <th class="text-center">Año</th>
                        <th class="text-center">G. Consumo</th>
                    </tr>
                    </thead>
                    <tbody id="table">


                    <tr>
                        <td>1</td>
                        <td>Carlos Alfaro</td>
                        <td>564</td>
                        <td>AV. Ku 256</td>
                        <td>121.4 l</td>
                        <td>s/ 6.25</td>
                        <td>Octubre</td>
                        <td>2019</td>
                        <td><a href="#!" class="btn btn-info btn-raised btn-xs">G. Consumo</a></td>


                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Claudia Rodriguez</td>
                        <td>231</td>
                        <td>AV. Bf 256</td>
                        <td>567.4 l</td>
                        <td>s/ 4.5</td>
                        <td>Octubre</td>
                        <td>2019</td>
                        <td><a href="#!" class="btn btn-info btn-raised btn-xs">G. Consumo</a></td>

                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ana Quispe</td>
                        <td>455</td>
                        <td>AV. FT 123</td>
                        <td>121.4 l</td>
                        <td>s/ 8.00</td>
                        <td>Octubre</td>
                        <td>2019</td>
                        <td><a href="#!" class="btn btn-info btn-raised btn-xs">G. Consumo</a></td>

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
    </div>-->

</div>