<?php
$AjaxRequest=true;
require_once "../core/configSite.php";

require_once "../controllers/adminController.php";
$db_handle = new adminController();

if (isset($_POST["editval"])){
    $editv=$_POST["editval"];
    $idv=$_POST["id"];
    $db_handle->updGConsumo($editv,$idv);
/*
    $queryUpd = "UPDATE factura_recibo SET consumo = $editv WHERE  idfactura_recibo= $idv";
    $result = $db_handle->consultaAsociado($queryUpd);
*/

    echo $result;
}

