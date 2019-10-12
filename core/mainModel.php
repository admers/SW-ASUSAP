<?php
	if($AjaxRequest){
		require_once "../core/configAPP.php";
	}else{
		require_once "./core/configAPP.php";
	}
	class mainModel{

		/* Funcion para conectar a la BD - Function to connect to DB */
		protected function connect(){
			$link= new PDO(SGBD,USER,PASS);
			return $link;
		}


		/* Funcion para ejecutar una consulta simple - Function to execute a simple query */
		protected function execute_single_query($query){
			$response=self::connect()->prepare($query);
			$response->execute();
			return $response;
		}


		/* Funcion para desencriptar claves - Function to decrypt keys */
		/*protected function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}*/


		/* Funcion para generar codigos aleatorios - Function to generate random codes */
		protected function generate_code($letter,$length,$correlative){
			for ($i=1; $i<=$length; $i++){ 
			    $number = rand(0,9); 
			    $letter .= $number; 
			}
			return $letter.$correlative;
		}

		protected function generate_codigo_sum($dni,$correlative){
			
			$codigo = $dni."-".$correlative; 

			return $codigo;
		}

		/* Funcion para limpiar cadenas de texto - Function to clean text strings */
		protected function clean_string($value) {
			$value = trim($value);
			$value = stripslashes($value);
	        $value = str_ireplace("<script>", "", $value);
	        $value = str_ireplace("</script>", "", $value);
	        $value = str_ireplace("<script src", "", $value);
	        $value = str_ireplace("<script type=", "", $value);
	        $value = str_ireplace("SELECT * FROM", "", $value);
	        $value = str_ireplace("DELETE FROM", "", $value);
	        $value = str_ireplace("INSERT INTO", "", $value);
	        $value = str_ireplace("--", "", $value);
	        $value = str_ireplace("^", "", $value);
	        $value = str_ireplace("[", "", $value);
	        $value = str_ireplace("]", "", $value);
	        $value = str_ireplace("\\", "", $value);
	        $value = str_ireplace("=", "", $value);
	        $value = str_ireplace("==", "", $value);
	        return $value;
	    }


		/*----------  
		Función para mostrar alerta de SweetAlert - SweetAlert alert display function  
		----------*/
	    protected function sweet_alert($data){
	    	if($data['Alert']=="reload"){
				$alert="
					<script>
						swal({
						  	title: '".$data['Title']."',
						  	text: '".$data['Text']."',
						  	type: '".$data['Type']."',
						  	confirmButtonText: 'Aceptar'
						}).then(function () {
						  	location.reload();
						});
					</script>"
				;
	    	}elseif($data['Alert']=="single"){
	    		$alert="
					<script>
						swal(
						  '".$data['Title']."',
						  '".$data['Text']."',
						  '".$data['Type']."'
						);
					</script>"
				;
	    	}elseif($data['Alert']=="clear"){
	    		$alert="
					<script>
						swal({
						  	title: '".$data['Title']."',
						  	text: '".$data['Text']."',
						  	type: '".$data['Type']."',
						  	confirmButtonText: 'Aceptar'
						}).then(function () {
						  	$('.DataAjaxForm')[0].reset();
						});
					</script>"
				;
	    	}
			return $alert;
		}
	}