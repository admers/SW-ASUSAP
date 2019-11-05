<?php

    $AjaxRequest=true;
    require_once "../controllers/adminController.php";

    //$option = $_POST['OPTION'];
    // isset() -> Comprobar si una variable está definida
    if(isset($_POST['OPTION'])){
        //SI No está vacio. empty() -> para saber si una variable está vacía
        if(!empty($_POST['OPTION'])){
            

            //Opcion para generar consumo SIN medidor
            if($_POST['OPTION'] == 'GCSnMedi'){
                
                $gcsnmed = new adminController();
                $msj = $gcsnmed->insertarConsumoSnMController() ;
                echo json_encode($msj);            

            }    
        
            if($_POST['OPTION'] == 'GCCnMedi'){
                
                $codigoSum = $_POST['codigo_sum'];

                $regSumi = new adminController();
                $response = $regSumi->datosSumiAsocController($codigoSum);

                echo json_encode($response);
            }

            else if($_POST['OPTION'] == 'insertGCCnM'){

                $arrData = [
                    "cod_sum"=>$_POST['cod_sum'],
                    "consumo"=>$_POST['consumo'],
                    "monto"=>$_POST['monto']                    
                ];

                $respInsert = new adminController();
                $response = $respInsert->insertarCSumCnMController($arrData);

                //actualizar contador_deuda + 1
                if($response){
                    //Tambien pone en CORTE si tiene una 3ra deuda
                    $ok = $respInsert->actualizarContadorDeudaController($arrData['cod_sum']);
                }

                echo json_encode($ok);
            }
            
            else if($_POST['OPTION'] == 'buscarRD'){
                //solo se está usando la direccion
                $dataController = [
                    "direccion"=>$_POST['nombreDirec'],
                    "anio",$_POST['anio'],
                    "mes",$_POST['mes']
                ];
                $respRegDirec = new adminController();
                $response = $respRegDirec->obtenerRegXDirecController($dataController);
            
                echo json_encode($response);
            }        
            
            else if ($_POST['OPTION'] == 'bscSumCnCorte'){
                $cod_sum = $_POST['infoDBsqd'];
                $dataRes = new adminController();
                $response = $dataRes->obtenerRegSumCnCorteController($cod_sum);

                echo json_encode($response);
            }
        
            else if ($_POST['OPTION'] == 'bscGRxSum'){

                $dataPost = $_POST;
                $rspRegGR = new adminController();
                $response = $rspRegGR->obtenerSumGRxCod($dataPost);
                echo json_encode($response);
            }
            
            else if ($_POST['OPTION'] == 'CobrarRecibo'){

                $obj = new adminController();
                $response = $obj->obtenerSumParaCobrar($_POST['cod_sum']);
                echo json_encode($response);
            }
            
            else if ($_POST['OPTION'] == 'PagoRecibo'){

                $obj = new adminController();
                $response = $obj->cobrarRecibo($_POST['cod_sum'],$_POST['anio'],$_POST['mes']);
                echo json_encode($response);                
            }

        }
    }
