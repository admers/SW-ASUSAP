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

        $stmt=mainModel::connect()->prepare("INSERT INTO asociado (idasociado,dni,direccion,nombre,apellido,telefono,estado)
                                            VALUES (:idasociado,:dni,:direccion,:nombre,:apellido,:telefono,:estado)");
        $stmt->bindParam(":idasociado",$datosModel["idasociado"]);
        $stmt->bindParam(":dni",$datosModel["dni"]);
        $stmt->bindParam(":direccion",$datosModel["direccion"]);
        $stmt->bindParam(":nombre",$datosModel["nombre"]);
        $stmt->bindParam(":apellido",$datosModel["apellido"]);
        $stmt->bindParam(":telefono",$datosModel["telefono"]);
        $stmt->bindParam(":estado",$datosModel["estado"]);
        $stmt->execute();
        //$stmt->close();
        return $stmt;

        }

	}