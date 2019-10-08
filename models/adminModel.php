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

	}