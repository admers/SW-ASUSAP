<?php


//fetch.php
$AjaxRequest = true;
require_once "../core/configSite.php";

require_once "../controllers/adminController.php";

$inst = new adminController();

//$connect = mysqli_connect("localhost", "root", "cardenas", "dbasusap2");
$columns = array('cod_suministro', 'direccion', 'tiene_medidor', 'nombre', 'asociado_dni');
// $query= "SELECT a.idfactura_recibo,f.nombre,s.cod_suministro,s.direccion,a.consumo,a.monto_pagar,a.anio,a.mes,a.fecha_emision,a.hora_emision,a.fecha_vencimiento,a.consumo,a.monto_pagar, s.cod_suministro
//                            FROM ((factura_recibo a INNER JOIN suministro s ON a.suministro_cod_suministro = s.cod_suministro)
//                            INNER JOIN asociado f ON f.dni = s.asociado_dni) WHERE a.suministro_cod_suministro  like '%" . $valor . "%' OR f.nombre  like '%" . $valor . "%' OR s.direccion  like '%" . $valor . "%'";
//
$query = "SELECT s.cod_suministro,s.direccion,S.casa_nro, s.tiene_medidor,a.nombre,a.apellido,s.asociado_dni,s.categoria_suministro FROM suministro s INNER JOIN asociado a ON a.dni = s.asociado_dni WHERE ";

if($_POST["is_date_search"] == "yes")
{
    $all=$_POST["start_date"] ;
   $esta=$_POST["estad"] ;
   $catA=$_POST["catA"] ;
   $MdAso = $_POST["MdAsoc"] ;
   // if ($all=="TODOS"){
    //-----------------------DIRECCION  ------------------------------------------------------------
    if ( $all==="TODOS" && $esta==3 && $catA=="Todos" && $MdAso=="Todos"){
      // $query .= 'direccion BETWEEN "'.$_POST["start_date"].'" AND ';
        $query .= 'direccion BETWEEN "'.$_POST["start_date"].'" AND ';
    }
    //-----------------------ESTADO ACTIVO--------------------------------------
    else if ($all=="TODOS" && $esta==0){
        if ($catA=="Domestico"){
            if ($MdAso=='C Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
           else if ($MdAso=='S Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
           else if ($MdAso=='Todos'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND';
            }


           // $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Comercial"){

            if ($MdAso=='C Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND';
            }

            //$query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Estatal"){
            if ($MdAso=='C Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND';
            }
          //  $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Industrial"){
            if ($MdAso=='C Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND';
            }
            //$query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        ///.................PARA TODOS
        if ($catA=="Todos"){
            if ($MdAso=='C Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND';
            }
            //$query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }

        $query .= ' estado_corte="'.$_POST["estad"].'" AND ';
    }
    else if ($all=="TODOS" && $esta==2){
        if ($catA=="Domestico"){
            if ($MdAso=='C Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND';
            }
           // $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Comercial"){

            if ($MdAso=='C Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND';
            }


            //$query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Estatal"){
            if ($MdAso=='C Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND';
            }
           // $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Industrial"){
            if ($MdAso=='C Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"].'" AND';
            }
            //$query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        //-------------------D-TO, ESTA-INACT, SUMINI-TODOS,------------todos con medidor-------------------------------------
        if ($catA=="Todos"){
            if ($MdAso=='C Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= 'estado_corte ="'.$_POST["estad"].'" AND';
            }
            //$query .= 'estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
         $query .= ' estado_corte="'.$_POST["estad"].'" AND ';
    }

//-----------------------------TIPO DE ESTADO DE DIVERSOS DIRECCIONES--------------------------------------------
    else if ($all!="TODOS" && $esta==3){

        if ($catA=="Domestico"){
            if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }
            else if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
          // $query .= ' direccion ="'.$_POST["start_date"].'" AND categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Comercial"){
            if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }
            else if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
        }
        if ($catA=="Estatal"){
            if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }
            else if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
           // $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Industrial"){
            if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }
            else if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
           // $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Todos"){
            if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"] .'" AND';
            }
            else if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
           // $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }

        $query .= ' direccion ="'.$_POST["start_date"].'" AND ';
    }
    else if ($all!="TODOS" && $esta==2){
        if ($catA=="Domestico"){
            if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }

           // $query .= ' direccion ="'.$_POST["start_date"].'" AND categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Comercial"){
            if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }

            //$query .= ' direccion ="'.$_POST["start_date"].'" AND  categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Estatal"){

            if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }
           // $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Industrial"){
            if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }
           // $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }

        if ($catA=="Todos"){
            if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND';
            }
           // $query .= ' direccion ="'.$_POST["start_date"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }

      $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND';

    }
    else if ($all!="TODOS" && $esta==0){
        if ($catA=="Domestico"){

            if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }
           // $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Comercial"){
            if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }

           // $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Estatal"){
            if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }
           // $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }
        if ($catA=="Industrial"){
            if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
            }
           // $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }

        if ($catA=="Todos"){
            if ($MdAso=='C Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   tiene_medidor="'.'1'.'" AND';
            }
            else if ($MdAso=='S Medidor'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   tiene_medidor="'.'0'.'" AND';
            }
            else if ($MdAso=='Todos'){
                $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND';
            }
           // $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
        }


        $query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND';
    }
//-------------------------CATEGORIA DE SUMINISTRO-------------------------------------

    else if ($all=="TODOS" && $esta==3 && $catA=="Domestico"){

        if ($MdAso=='C Medidor'){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND   tiene_medidor ="'.'1'.'" AND';
        }else if ($MdAso=="Todos"){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND';
        }else if ($MdAso=='S Medidor'){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND   tiene_medidor ="'.'0'.'" AND';
        }

       //$query .= 'categoria_suministro="'.$_POST["catA"] .'" AND';
        //$query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
    }
    else if ($all=="TODOS" && $esta==3 && $catA=="Comercial"){
        if ($MdAso=='C Medidor'){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND   tiene_medidor ="'.'1'.'" AND';
        }else if ($MdAso=="Todos"){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND';
        }else if ($MdAso=='S Medidor'){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND   tiene_medidor ="'.'0'.'" AND';

        }
          //


       //$query .= 'categoria_suministro="'.$_POST["catA"] .'" AND';
       // $query .= 'categoria_suministro="'.$_POST["catA"] .'" AND';
        //$query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" ANDSSS   categoria_suministro="'.$_POST["catA"] .'" AND';
    }
    else if ($all=="TODOS" && $esta==3 && $catA=="Estatal"){
        if ($MdAso=='C Medidor'){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND   tiene_medidor ="'.'1'.'" AND';
        }else if ($MdAso=="Todos"){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND';
        }else if ($MdAso=='S Medidor'){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND   tiene_medidor ="'.'0'.'" AND';
        }

       // $query .= 'categoria_suministro="'.$_POST["catA"] .'" AND';
        //$query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
    }
    else if ($all=="TODOS" && $esta==3 && $catA=="Industrial"){

        if ($MdAso=='C Medidor'){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND   tiene_medidor ="'.'1'.'" AND';
        }else if ($MdAso=="Todos"){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND';
        }else if ($MdAso=='S Medidor'){
            $query .= 'categoria_suministro ="'.$_POST["catA"].'" AND   tiene_medidor ="'.'0'.'" AND';
        }

        //$query .= 'categoria_suministro="'.$_POST["catA"] .'" AND';
        //$query .= ' direccion ="'.$_POST["start_date"].'" AND estado_corte ="'.$_POST["estad"].'" AND   categoria_suministro="'.$_POST["catA"] .'" AND';
    }
    //-----------------------CON MEDIDOR----------------------------------------
   else if ($all=="TODOS" && $esta==3 && $catA=="Todos" && $MdAso=='Todos' ){
       $query .= ' tiene_medidor ="'.$_POST["MdAso"].'" AND';
        //$query .=' direccion ="'.$_POST["start_date"]. 'AND tiene_medidor="'."1".'" AND';
    }
   else if ($all=="TODOS" && $esta==3 && $catA=="Todos" && $MdAso=='S Medidor' ){
       $query .= ' tiene_medidor ="'.'0'.'" AND';
        //$query .=' direccion ="'.$_POST["start_date"]. 'AND tiene_medidor="'."1".'" AND';
    }
   else if ($all=="TODOS" && $esta==3 && $catA=="Todos" && $MdAso=='C Medidor' ){
       $query .= ' tiene_medidor ="'.'1'.'" AND';
        //$query .=' direccion ="'.$_POST["start_date"]. 'AND tiene_medidor="'."1".'" AND';
    }

}


if(isset($_POST["search"]["value"]))
{
    $query .= '
  ( cod_suministro LIKE "%'.$_POST["search"]["value"].'%" 
  OR direccion  LIKE "%'.$_POST["search"]["value"].'%" 
  OR tiene_medidor LIKE "%'.$_POST["search"]["value"].'%" 
  OR asociado_dni LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
    $query .= 'ORDER BY apellido ASC ';
}
$query1 = '';

if($_POST["length"] != -1)
{
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$rs = $inst->consultaAsociado($query);
$number_filter_row = $rs->rowCount($rs);
//$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

//$result = mysqli_query($connect, $query . $query1);
$result = $inst->consultaAsociado($query . $query1);

$data = array();
$s = 1;
//$columns = array('cod_suministro', 'direccion', 'tiene_medidor', 'categoria_suministro', 'asociado_dni');



    while ($row = $result->fetch()) {



        $sub_array = array();
        $sub_array[] = $s++;
        $sub_array[] = $row["cod_suministro"];
        $sub_array[] = $row["apellido"] . " " . $row["nombre"];
        $sub_array[] = $row["asociado_dni"];
        $sub_array[] = $row["direccion"]."  N° #".$row["casa_nro"];
        $sub_array[] = $row["categoria_suministro"];
        if ($row['tiene_medidor'] == "1"){
            $sub_array[] = "CM";
        }
        else{
            $sub_array[] = "SM";
        }
       // $sub_array[] = $row['tiene_medidor'].$MdAso;
        // $sub_array[] = $row["mes"];
        $data[] = $sub_array;




}


function get_all_data($connect)
{
    $insts = new adminController();
    $query = "SELECT * FROM suministro";
    $result = $insts->consultaAsociado($query);
    // $result = mysqli_query($connect, $query);
    return $result->rowCount($result);
}

$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => get_all_data($inst->consultaAsociado($this)),
    "recordsFiltered" => $number_filter_row,
    "data" => $data
);

echo json_encode($output);


