
<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles">                
            <i class="zmdi zmdi-money-box zmdi-hc-fw"></i> GENERAR CONSUMO <small>para <b><?php echo "$FechaGConsumoNum $FechaGConsumo $FechLiteral[r_anio]"; ?></b></small>            
        </h1>
    </div>
</div>
<div class="container-fluid">
    <?php if($btn_xdefct){ ?>
        <a href="#" id="btnGenerarCXD" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> 
            GENERAR CONSUMO X DEFECTO
        </a>
        <br>
        <br>
    <?php 
        }else{
            echo '
                <div class="alert alert-success lead" role="alert">
                    YA SE GENERO CONSUMO 4.20
                </div>

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Muy bien!</h4>
                    <p>Se generaron los consumos para los suministros sin medidor .</p>
                    <hr>
                    <p class="mb-0">Ahora toca llenar los consumos para los suministros con medidor!!</p>
                </div>   
                ';
        } 
    ?>
  
</div>


<div class="container-fluid">
</div>
    <div class="container" onload="listar_gconsumo('');">
        <div class="row form-horizontal">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_consultar" data-toggle="tab">
                        Suministros con medidor 
                        <?php 
                            // echo $tabla_consumo?"FALTA GENERAR CONSUMOS":"YA SE GENERÓ LOS CONSUMOS";
                        ?>
                        <?php 
                            echo $tabla_consumo?'<span class="text-danger "> FALTA</span>':'<span class="text-success blockquote"> LISTO!!</span>';
                        ?>
                    </a>
                </li>
                
                
            </ul>
        </div>
        <br>

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
