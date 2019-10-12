<?
$AjaxRequest=true;
require_once "../core/configSite.php";

require_once "../controllers/adminController.php";

$val=$_POST['valor'];
if(!empty($val))
{
    $valor=$_POST['valor'];
    $inst = new adminController();
    $r=$inst ->listaGconsumo($valor);
    //print_r($r);
    echo json_encode($r);
}

