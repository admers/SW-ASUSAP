<?php
    $AjaxRequest=true;
    require_once "../controllers/adminController.php";
    
    $dniAsoc = $_POST['codAsoc'];

    $asociado = new adminController();

    $query="SELECT * FROM asociado WHERE dni = $dniAsoc";
    $result = $asociado->consultaAsociado($query);

    $query2 = "SELECT * FROM suministro WHERE asociado_dni=$dniAsoc";
    $result2 = $asociado->consultaAsociado($query2);

    if($result->rowCount() == 1){

        $dataTabla = $result->fetch();
        
        $registroModal = [];
        while($dataModal = $result2->fetch()){     
            
            $medidor = $dataModal['tiene_medidor']?"Si":"No";
            $corte = $dataModal['estado_corte']?"Si":"No";

            $registroModal[] = [
                "codigo"=>$dataModal['cod_suministro'],
                "direccion"=>$dataModal['direccion'],
                "categoria"=>$dataModal['categoria_suministro'],
                "medidor"=>$medidor,
                "corte"=>$corte
            ];
        }

        $estado = isset($dataTabla['estado'])?"activo":"No activo";

        $arrdatos = array(
                    "tabla"=>[  
                        "dni"=>$dataTabla['dni'],
                        "nombre"=>$dataTabla['nombre'],
                        "apellido"=>$dataTabla['apellido'],
                        "telefono"=>$dataTabla['telefono'],
                        "estado"=>$estado,
                        "cant_suministro"=>$dataTabla['cant_suministro']
                    ],
                    "modal"=>array()
        );
        $arrdatos["modal"] = $registroModal;
        
        echo json_encode($arrdatos);
    }else{
        echo false;
    }
