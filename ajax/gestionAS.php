<?php
    $AjaxRequest=true;

    // insertar un nuevo suministro a la db
    if(isset($_POST['insertSumin'])){
        
        require_once "../controllers/adminController.php";

        /**
         * recibir los datos enviados desde la vista 
         * verificar si el asociado existe para agregarle un suministro
         * necesito traer la 'cantdad de sumistro' que tiene el asociado para incrementarlo en 1
         * generar el código para el suministro de acuerdo al dni asociado y cant_suminstro incrementado en +1
         * preparar los datos para enviarlo al modelo
         * insertar el suministro.
         * preparar array resultado para enviarlo a la vista.
         */
        //
        $insertSumi = new adminController();

        $result = $insertSumi->insertarSuministroController();

        echo json_encode("server sumi response ".$result);

    }
    //Se valida la actualización de la tabla de fehcas de generación de consumo. Btn para dar inicio a la generación de consumo.
    elseif(isset($_POST['UPDfgc'])){
        
        require_once "../controllers/adminController.php";
        $updateTablegc = new adminController();
        $result = $updateTablegc->actualizarFGConsumoController();
        if($result){
            echo json_encode("TRUE Server UPDfgc ");
        }else {
            echo json_encode("FALSE Server UPDfgc");            
        }
    }

    else{
        
        echo json_encode("Server sumi response FALSE".$_POST['UPDfgc']);
    }
    