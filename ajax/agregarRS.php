<?php
$AjaxRequest=true;
require_once "../core/configSite.php";

require_once "../controllers/adminController.php";
$db_handle = new adminController();

/*------------------modificando id factura monto total,a nombre--------------------------------*/
//  "ids="+idf+"&cost="+tot+"&cod="+codsu+"&anom="+anrs,
if (isset($_POST["cost"])){
    $Anombre=$_POST["anom"];
    $idFactRS=$_POST["ids"];
    $CostTotal=$_POST["cost"];
    //$cod=$_POST["cod"];
    $db_handle->modificarRS($idFactRS,$CostTotal,$Anombre);

}


/*----------------AGREDAR DATOS A LA TABLA -----------------------------------*/
//"aNom="+aname+"&aNio="+a+"&aMes="+mes+"&aCod="+cod,
if (isset($_POST['aCod'])){
    $ANOM=$_POST['aNom'];
    $ANIO=$_POST['aNio'];
    $AMES=$_POST['aMes'];
    $ACOD=$_POST['aCod'];
    // $nombre=$_POST['nombre'];
    $id=($_POST['ids']+$_POST['cost']);
    ;
  //  $codrs=$_POST['codirs'];

    $r=$db_handle->agregarRS($ANOM,$ANIO,$AMES,$ACOD);

    //print_r($r);
    echo json_encode($r);

}
/*##########AGREGAR LOS ITEMS DE SERVICIO##########*/
if (isset($_POST["costD"])){
    $Des=$_POST["NomD"];
    $DCost=$_POST["costD"];
    $DCS=$_POST['CodRS'];

    $db_handle->agregarRSI($Des,$DCost,$DCS);

}
/*-------------------ELIMINAR LOS ITEMS-----------------------------*/
if (isset($_POST['idsF'])){
    $IDF=$_POST['idsF'];
    $db_handle->eliminarRSI($IDF);
}



