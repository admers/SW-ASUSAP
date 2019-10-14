<?php
	if($AjaxRequest){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}
	class adminModel extends mainModel{


        /* Modelo para guardar administrador - Administrator save model */
		protected function add_admin_model($dataAd){
			$query=mainModel::connect()->prepare("INSERT INTO admin(AdminName,AdminLastName,AdminAddress,AdminPhone,AccountCode) VALUES(:AdminName,:AdminLastName,:AdminAddress,:AdminPhone,:AccountCode)");
			$query->bindParam(":AdminName",$dataAd['AdminName']);
			$query->bindParam(":AdminLastName",$dataAd['AdminLastName']);
			$query->bindParam(":AdminAddress",$dataAd['AdminAddress']);
			$query->bindParam(":AdminPhone",$dataAd['AdminPhone']);
			$query->bindParam(":AccountCode",$dataAd['AccountCode']);
			$query->execute();
			return $query;
		}


		/* Modelo para eliminar administrador - Model to remove administrator */
		protected function delete_admin_model($code){
			$query=mainModel::connect()->prepare("DELETE FROM admin WHERE AccountCode=:Code");
			$query->bindParam(":Code",$code);
			$query->execute();
			return $query;
		}
    /*================================GUARDAR ASOCIADO============================================*/

        public function guardarUsuario($datosModel){

			$estado = 1;
			$cant_sumi = 0;
			$stmt=mainModel::connect()->prepare("INSERT INTO asociado (dni,nombre,apellido,telefono,estado,cant_suministro)
												VALUES (:dni,:nombre,:apellido,:telefono,:estado,:cant_suministro)");

			$stmt->bindParam(":dni",$datosModel["dni"]);
			$stmt->bindParam(":nombre",$datosModel["nombre"]);
			$stmt->bindParam(":apellido",$datosModel["apellido"]);
			$stmt->bindParam(":telefono",$datosModel["telefono"]);
			$stmt->bindParam(":estado",$estado);
			$stmt->bindParam(":cant_suministro",$cant_sumi);
			$stmt->execute();

			$cod_sumiA="";
			$estado_corte = 0;
			$contador_deuda = 0;

			$stmt1=mainModel::connect()->prepare("INSERT INTO suministro (cod_suministro, cod_suministroA, direccion, pasaje, casa_nro, estado_corte, tiene_medidor, categoria_suministro, contador_deuda, asociado_dni)
												VALUES (:cod_suministro, :cod_suministroA, :direccion, :pasaje, :casa_nro, :estado_corte, :tiene_medidor, :categoria_suministro, :contador_deuda, :asociado_dni)");

			$stmt1->bindParam(":cod_suministro",$datosModel["codigo_sum"]);
			$stmt1->bindParam(":cod_suministroA",$cod_sumiA);
			$stmt1->bindParam(":direccion",$datosModel["direccion"]);
			$stmt1->bindParam(":pasaje",$datosModel["pasaje"]);
			$stmt1->bindParam(":casa_nro",$datosModel["casa_nro"]);
			$stmt1->bindParam(":estado_corte",$estado_corte);
			$stmt1->bindParam(":tiene_medidor",$datosModel['tiene_medidor']); //falta en el formulario
			$stmt1->bindParam(":categoria_suministro",$datosModel["categoria"]);
			$stmt1->bindParam(":contador_deuda",$contador_deuda);
			$stmt1->bindParam(":asociado_dni",$datosModel["dni"]);
			$stmt1->execute();
			//$stmt->close();
			return true;

		}

	/*================================GUARDAR SUMINISTRO============================================*/

        protected function insertarSuministroModel($datosModel){

			$dniAsoc = $datosModel["asociado_dni"];
			//insertar suministro
			$stmt=mainModel::connect()->prepare("INSERT INTO suministro (cod_suministro, cod_suministroA, direccion, pasaje, casa_nro, estado_corte, tiene_medidor, categoria_suministro, contador_deuda, asociado_dni)
												VALUES (:cod_suministro, :cod_suministroA, :direccion, :pasaje, :casa_nro, :estado_corte, :tiene_medidor, :categoria_suministro, :contador_deuda, :asociado_dni)");
			$cod_sumiA = 0;
			$contador_deuda = 0;
			$stmt->bindParam(":cod_suministro",$datosModel["cod_suministro"]);
			$stmt->bindParam(":cod_suministroA",$cod_sumiA);
			$stmt->bindParam(":direccion",$datosModel["direccion"]);
			$stmt->bindParam(":pasaje",$datosModel["pasaje"]);
			$stmt->bindParam(":casa_nro",$datosModel["casa_nro"]);
			$stmt->bindParam(":estado_corte",$datosModel["corte"]);
			$stmt->bindParam(":tiene_medidor",$datosModel['medidor']);
			$stmt->bindParam(":categoria_suministro",$datosModel["categoria"]);
			$stmt->bindParam(":contador_deuda",$contador_deuda);
			$stmt->bindParam(":asociado_dni",$dniAsoc);
			$stmt->execute();

			//actualizar cantidad_sumini de asociado 
			$update_cant = $datosModel['cant_suministro'];
			$queryUpd = "UPDATE asociado SET cant_suministro = $update_cant WHERE dni = $dniAsoc";
			$stmt1 = mainModel::execute_single_query($queryUpd);

			return true;
		}

		protected function actualizarFGConsumoModel($datosModel){
			$anio = $datosModel['anio'];
			$mes = $datosModel['mes'];
			$con_medidor = $datosModel['gcn_consumo'];
			$sin_medidor = $datosModel['gsn_consumo'];
			$query = "UPDATE estado_gonsumo SET anio = $anio, mes=$mes, con_medidor=$con_medidor,sin_medidor=$sin_medidor WHERE id = 0";
			$stmt = mainModel::execute_single_query($query);
			return true;
		}
	/*================================GENERAR CONSUMO============================================*/

        public function listaGconsumoModelS($valor){

            $conexion=mainModel::connect();
            $query=$conexion->query("SELECT * FROM factura_recibo WHERE suministro_cod_suministro like '%".$valor."%'");
            $result = mainModel::execute_single_query($query);
            $arreglo= array();
            while ($re=$result->fetch_array(MYSQL_NUM())){
                $arreglo[]= $re;
            }

            return $arreglo;


            /*$stmt=mainModel::connect()->prepare("INSERT INTO factura_recibo (idfactura_recibo,anio,mes,fecha_emision,hora_emision,fecha_vencimiento,consumo,monto_pagar,esta_cancelado,esta_impreso)
												VALUES (:idfactura,:anio,:mes,:fecha_emision,:hora_emision,:fecha_vencimiento,:consumo,:monto_pagar,:esta_cancelado,:esta_impreso)");

            $stmt->bindParam(":idfactura",$valor["dni"]);
            $stmt->bindParam(":anio",$valor["nombre"]);
            $stmt->bindParam(":mes",$valor["apellido"]);
            $stmt->bindParam(":fecha_emision",$valor[""]);
            $stmt->bindParam(":hora_emision",$valor[""]);
            $stmt->bindParam(":fecha_vencimiento",$valor[""]);
            $stmt->bindParam(":consumo",$valor[""]);
            $stmt->bindParam(":monto_pagar",$valor[""]);
            $stmt->bindParam(":esta_cancelado",$valor[""]);
            $stmt->bindParam(":esta_impreso",$valor[""]);

            return true;*/

        }
        public function actualizarGC($datosModels){

            $stmt=mainModel::connect()->prepare("UPDATE factura_recibo SET consumo=:consumoupd WHERE idfactura_recibo=:id");
            $stmt->bindParam(":consumoupd",$datosModels["consumo"]);
            $stmt->bindParam(":id",$datosModels["id"]);
            $stmt->execute();
            return $stmt;


        }


    }

