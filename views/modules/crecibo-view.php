<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Cobrar <small>Recibo</small></h1>
    </div>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
</div>

<div class="container-fluid">

    <div style='text-align:left;margin:20px 0px;'>

        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" placeholder="Busqueda..."  name='txtBscSumCobro' id='txtBscSumCobro' maxlength='25' class=" form-control form-control-lg form-control-borderless">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div><!-- /input-group -->
        </div><!-- /.row -->
    </div>

    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                <li><a href="#list" data-toggle="tab">Lista</a></li>
            </ul>
        </div>

        <div class="col-xs-12">
            <div class="tab-pane" id="list">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Cod Suministro</th>
                                <th class="text-center">Categoría</th>
                                <th class="text-center">Año</th>
                                <th class="text-center">Mes</th>
                                <th class="text-center">Monto</th>
                                <th class="text-center">Cobro</th>
                            </tr>
                        </thead>
                        <tbody id="rspTblCrecibo">
                            <tr>
                                <td>1</td>
                                <td>Carlos Alfaro</td>
                                <td>564</td>
                                <td>2019</td>
                                <td>Octubre</td>
                                <td>s/ 6.25</td>
                                <td><a href="#!" class="btn btn-success btn-raised btn-xs">Cobrar</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Claudia Rodriguez</td>
                                <td>231</td>
                                <td>2019</td>
                                <td>Octubre</td>
                                <td>s/ 4.5</td>
                                <td><a href="#!" class="btn btn-success btn-raised btn-xs">Cobrar</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Ana Quispe</td>
                                <td>455</td>
                                <td>2019</td>
                                <td>Octubre</td>
                                <td>s/ 8.00</td>
                                <td><a href="#!" class="btn btn-success btn-raised btn-xs">Cobrar</a></td>
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
    </div>
</div>