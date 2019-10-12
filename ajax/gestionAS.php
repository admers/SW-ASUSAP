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

    }else{
        echo json_encode("Server sumi response FALSE");
    }
    