<div class="container-fluid" onload="guardarDB('');" id="contentAMRS">
    <div class="page-header">
        <h1 class="text-titles text-center" ><i class="zmdi zmdi-book zmdi-hc-fw"></i>Amortizar <small></small></h1>
    </div>
    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates</p>

    <script language='javascript'>

    /*    function obtenerValorParametro(sParametroNombre) {
            var sPaginaURL = window.location.search.substring(1);
            var sURLVariables = sPaginaURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) {
                var sParametro = sURLVariables[i].split('=');
                if (sParametro[0] == sParametroNombre) {
                    return sParametro[1];
                }
            }
            return null;
        }

        let valor = obtenerValorParametro('codIR');


        if (valor){

          console.log(valor)

            //document.getElementById("valors").innerHTML=valor.innerHTML;
                        /!*var fila='<tr class="selected" id="fila" onclick="seleccionar(this.id);"><td>1</td><td>'+valor+'</td><td>naa</td></tr>';
                        $('#tablaAS').append(fila);*!/


        }else{
           // alert("El parámetro no existe en la URL");
        }*/



    </script>
  <?
  $datos=explode("/", $_GET['views']);
  require_once "./controllers/adminController.php";
  $classAdmin=new adminController();

  $filesA=$classAdmin->datos_AmortizarC($datos[1]);
  if($filesA->rowCount()){
  $campos = $filesA->fetch();
?>
    <div class="container-fluid" onload="guardarDB('');" >




        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 rs-asusap" style="background: rgba(25,25,25,.1);" id="cuadro">

                <div class="col-xs-12 col-sm-12">
                    <label class="text-danger" name="nameUser">N. servicio <small id="idReciboA"><? echo $campos['idfactura_servicio']?></small></label>

                    <div class="col-xs-12 col-md-6 ">
                        <h3 class="tile-titles text-left font-weight-bold"><b>Fecha de Deuda: </b><small id="fechaAS"><? echo $campos['fecha']?></small></h3>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12">
                    <div class="col-xs-12 col-md-6 ">
                        <h3 class="tile-titles text-left font-weight-bold"class="text-titles" ><b> Nombre Apellido: </b><small id="nombreAR"><? echo $campos['a_nombre']?></small></h3>
                    </div>
                    <div class="col-xs-12 col-md-6 " id="cuadro12">
                        <h3 class="tile-titles text-left font-weight-bold" ><b> Cod. Suministro: </b><small id="codAR"><? echo $campos['suministro_cod_suministro']?></small></h3>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12" id="datos-resultAS">


                    <button class="collapsible" id="verList" ><input type="hidden"  id="toCoRS" value="<? echo $campos['idfactura_servicio']?>"> Ver tipos de servicios realizados¡</button>

                        <div class="card my-4 content" id="reciboA">
                            <p>estas viendo los detalles de servicios realizados</p>
                        </div>

                </div>




                <div class="col-xs-12"
                <div class="col-xs-12 tab-pane fade container" id="list">


                <p style="color: black;"><b>Monto TOTAL:</b>S/<small id="montTotal"><input  type="text" id="montTotall" name="montTotal" value="<? echo $campos['total_pago']?>" disabled ></small></p>

                    <div id="contAMORT" class="col-xs-12 col-sm-3  justify-content-center" style="background: rgba(253,140,0,0.77); color: white;">
                            <div class="col-xs-12 col-sm-12 col align-self-center">
                                <h3><b>Monto Restante:</b> </h3>
                                <p style="color: black;">S/<small id="mntTotal"><input  type="text" id="montAll" name="montTot" value="<? echo $campos['mont_restante']?>" disabled ></small></p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col align-self-center">
                            <h3><b>Monto a Pagar:</b></h3>
                                <p style="color: black;">S/ <small >
                                <input type="number" id="montPa" name="montPag" onkeyup="guardarDB(this.value);" >
                                    </small></p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col align-self-center" style="background: rgb(255,0,7);">
                            <h3><b>Monto Pendiente:</b></h3>
                                <p style="color: black;">S/ <small id="montP"><? echo $campos['mont_restante']?></small>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-9 ">
                            <p>NO puede ingresar numero <b>MAYOR A MONTO TOTAL </b></p>
                            <p>NO puede ingresar numero <b>MENOR A 0 </b></p>
                        </div>



                </div>


                <p class="text-center">


                    <button type="submit"  class="btn btn-info btn-raised btn-sm" id="guardarARMOTIZACION" onclick="guardarARMOTIZACION();"><i class="zmdi zmdi-floppy"></i> GUARDAR</button>
                    <button type="submit"  class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> IMPRIMIR</button>

                </p>
            </div>


             </div>


        </div>
    </div>
</div>

<?}?>
