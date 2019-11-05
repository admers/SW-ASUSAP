<?php

$AjaxRequest=true;
require_once "../core/configSite.php";

require_once "../controllers/adminController.php";

$val=$_POST['valor'];

if(!empty($val))
{
    $valor=$_POST['valor'];
    $inst = new adminController();
    $r=$inst ->listaAservicio($valor);
    //print_r($r);
    echo json_encode($r);
}

/*---------------------------------------------------*/
$codK = $_POST['codARSS'];
if (!empty($codK)){
    $codK = $_POST['codARSS'];
    $asociado = new adminController();

    $query = "SELECT * FROM detalle_servicio WHERE factura_servicio_idfactura_servicio ='.$codK.'";
    $result = $asociado->consultaAsociado($query);


    if ($result) {


        while ($dataModal = $result->fetch(PDO::FETCH_ASSOC)) {
            $data["data"][] =  $dataModal;

        }

        echo json_encode($data);
    } else {
        echo "ERROR";
    }
}



$mopagr=$_POST['mopagr'];
if (!empty($mopagr)){

    $mopagr=$_POST['mopagr'];
    $IDS=$_POST['idsr'];
    $MR=$_POST['montRes'];
    $inst = new adminController();
    $r=$inst ->montoPagado($mopagr,$IDS,$MR);
    //print_r($r);
  //  echo json_encode($r);

}


/*
if (!empty($_POST['varp2'])){
    echo "el contenido esta lleno";
}
else{
    echo "el contenido esta vacio";

}*/

