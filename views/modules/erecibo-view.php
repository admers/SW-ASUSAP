<?php

    require_once "controllers/adminController.php";
    $fechas = new adminController();
    $fecha_hoy = $fechas->consultar_fecha_actual();

    $FechaER = $fecha_hoy['mes']-1;//mes anterior (Emision Recibo - ER)
    $FechLiteral = $fechas->obtenerNombrefecha($fecha_hoy['anio'],$FechaER);    
?>

<div class="container-fluid" id="pageXDIREC">
    <div class="page-header">
        <h2 class="text-titles"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Emitir <small>Recibo</small> <?php echo "{$FechLiteral['r_mes']} {$FechLiteral['r_anio']}";?></h2>
    </div>
<!--    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
-->
</div>

<div class="container-fluid">
    <!-- EMITIR X CALLE -->
    <div class="row"> 
    <!--
        <h3 class="tile-titles text-center font-weight-bold"><b>Recibos X Dirección</b></h3>-->
        <div class="jumbotron jumbotron-fluid">
            
            <a href="#pageXSUM" class="btn btn-secondary btn-raised ">BUSCAR POR SUMINISTRO</a>
            <div class="container bg-info">
                <h4 class="display-4 text-center text-muted">Emitir Recibos Por Dirección</h4>            
            </div>
        </div>
                
        <div class="col-xs-12 col-sm-12">
            <div class="col-xs-12 col-md-4 form-group">
                <input class="form-control" type="search" name="nombreDirec" id="nombreDirec" placeholder="NOMBRE DIRECCIÓN">
            </div>
            <div class="col-xs-12 col-md-2 form-group ">
                <button class="btn btn-success btn-raised btn-xs" name="nameUser">buscar</button>
            </div>
            <div class="col-xs-12 col-md-3 form-group ">
                <select name="fecha_mes" id="fecha_mes" class="form-control fechas-meses">
                    <option value="<?php echo $FechaER;?>"><?php echo $FechLiteral["r_mes"];?></option>
                    <?php 
                        //Gnerea los nombres de los meses
                        for ($i_mes=1; $i_mes <= $FechaER; $i_mes++) { 
                            # code...
                            if($FechaER == $i_mes)continue;

                            $L_mes = $fechas->obtenerNombrefecha($fecha_hoy['anio'],$i_mes);
                            echo "<option value='{$i_mes}'>{$L_mes['r_mes']}</option>";
                        }
                    ?>
                </select>              
            </div>
            <div class="col-xs-12 col-md-3 form-group ">
                <select name="fecha_anio" id="fecha_anio" class="form-control">
                    <option value="<?php echo $FechLiteral["r_anio"];?>"><?php echo $FechLiteral["r_anio"];?></option>
                    <option value="<?php echo $FechLiteral["r_anio"]-1;?>"><?php echo $FechLiteral["r_anio"]-1;?></option>
                    <option value="<?php echo $FechLiteral["r_anio"]-2;?>"><?php echo $FechLiteral["r_anio"]-2;?></option>
                    <option value="<?php echo $FechLiteral["r_anio"]-3;?>"><?php echo $FechLiteral["r_anio"]-3;?></option>                    
                </select>              
            </div>
        </div>

        <div class="col-xs-12">
            <div class="tab-pane " id="list">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Calle / Dirección</th>                                                                                                
                                <th class="text-center">Generar recibo</th>
                            </tr>
                        </thead>
                        <tbody id="resTablaRD">
                           <!--<tr>
                                <td>1</td>
                                <td>Av. los celajes</td>          
                                <td><a href="#!" class="btn btn-info btn-raised btn-xs">G. Recibo</a></td>
                            </tr>
                            <tr>
                                <td>2</td>                                
                                <td>AV. Bf 256</td>
                                <td><a href="#!" class="btn btn-info btn-raised btn-xs">G. Recibo</a></td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- EMITIR X PERSONA -->
    <div class="row">
        <!--<h3 class="tile-titles text-center font-weight-bold"><b>Recibos X Persona</b></h3>-->

        <div class="jumbotron jumbotron-fluid" id="pageXSUM">
            <a href="#pageXDIREC" class="btn btn-secondary btn-raised">BUSCAR POR DIRECCIÓN</a>
            <div class="container bg-info">
                <h4 class="display-4 text-center text-muted">Emitir Recibos Por Persona</h4>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12">
            <div class="col-xs-12 col-md-4 form-group">
                <input class="form-control" type="search" name="txtCodSum_GR" id="txtCodSum_GR" onkeyup="GRbuscarSumXCod(this)" placeholder="CÓDIGO SUMINISTRO Ejm. 70598957-0">
            </div>
            <div class="col-xs-12 col-md-2 form-group ">
                <button class="btn btn-success btn-raised btn-xs" name="btnBscCodSum_GR">buscar</button>
            </div>
            <div class="col-xs-12 col-md-3 form-group ">
                <select name="fecha_mesXsumi" id="fecha_mesXsumi" class="form-control">
                    <option value="<?php echo $FechaER;?>"><?php echo $FechLiteral["r_mes"];?></option>
                    <?php 
                        //Gnerea los nombres de los meses
                        for ($i_mes=1; $i_mes <= $FechaER; $i_mes++) { 
                            # code...
                            if($FechaER == $i_mes)continue;

                            $L_mes = $fechas->obtenerNombrefecha($fecha_hoy['anio'],$i_mes);
                            echo "<option value='{$i_mes}'>{$L_mes['r_mes']}</option>";
                        }
                    ?>
                </select>              
            </div>
            <div class="col-xs-12 col-md-3 form-group ">
                <select name="fecha_anioXsumi" id="fecha_anioXsumi" class="form-control">
                    <option value="<?php echo $FechLiteral["r_anio"];?>"><?php echo $FechLiteral["r_anio"];?></option>
                    <option value="<?php echo $FechLiteral["r_anio"]-1;?>"><?php echo $FechLiteral["r_anio"]-1;?></option>
                    <option value="<?php echo $FechLiteral["r_anio"]-2;?>"><?php echo $FechLiteral["r_anio"]-2;?></option>
                    <option value="<?php echo $FechLiteral["r_anio"]-3;?>"><?php echo $FechLiteral["r_anio"]-3;?></option>                    
                </select>              
            </div>
        </div>

        <div class="col-xs-12">
            <div class="tab-pane " id="list">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Cod Suministro</th>
                                <th class="text-center">Año</th>
                                <th class="text-center">Mes</th>
                                <th class="text-center">Monto</th>
                                <th class="text-center">Cancelado</th>
                                <th class="text-center">Medidor</th>
                                <th class="text-center">Con corte</th>
                                <th class="text-center">Generar recibo</th>
                            </tr>
                        </thead>
                        <tbody id="tblRspxSum_GR">
                            <!--<tr>
                                <td>1</td>
                                <td>564</td>
                                <td>Carlos Alfaro</td>
                                <td>AV. Ku 256</td>
                                <td>s/ 6.25</td>
                                <td><a href="#!" class="btn btn-info btn-raised btn-xs">G. Recibo</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>231</td>
                                <td>Claudia Rodriguez</td>
                                <td>AV. Bf 256</td>
                                <td>s/ 4.5</td>
                                <td><a href="#!" class="btn btn-info btn-raised btn-xs">G. Recibo</a></td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    
</div>
    <!-- RELLENO IMAGEN-->
<hr>
<div class="card mb-3 text-center pb-3">
    <div class="card-body">   

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Importante Recordar!!</h4>
  <p class="card-text">Recuerda utilizar este apartado exclusivamente para generar recibos de suministros que perdieron su recibo</p>
  <hr>
    <img src="../views/assets/img/cara.png" class="mb-3 card-img-top" style="height:50px; margin:0 0 15px 0">    
  <p class="mb-0"><small class=""><?php echo "{$FechLiteral['r_mes']} {$FechLiteral['r_anio']}";?></small></p>
</div>

    </div>
</div>  