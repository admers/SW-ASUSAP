console.log("probando...");
actualizarTabla_gconsumo();
generarConsumoSinMedidor();

//cuando ingresen código para buscar al asiciado
document.getElementById("btnBuscarAsoc").addEventListener('click',function(){
    
    let usuario = $("#txtBuscarAsoc").val();
    
    let datos = new FormData();
    datos.append("codAsoc",usuario);
    datos.append("btnaccion","buscarAsociado");
    
    $.ajax({
		url:"../ajax/buscarAjax.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success:function(respuesta){
			if(respuesta){

				let datos = JSON.parse(respuesta);
				let datostabla = datos.tabla;
				let datosmodal = datos.modal;
				
				let htmlAsoc = `
					<tr>
						<td>1</td>
						<td>${datostabla["dni"]}</td>
						<td>${datostabla["nombre"]}</td>
						<td>${datostabla["apellido"]}</td>
						<td>${datostabla["telefono"]}</td>
						<td>${datostabla["estado"]}</td>
						<td>${datostabla["cant_suministro"]}</td>
						<td><a href="#cantSumin" data-toggle="modal" dni="485666" class="cantSumin btn btn-success btn-raised btn-xs" ><i class="zmdi zmdi-refresh"></i></a></td>
						<td><a href="#!" class="btn btn-success btn-raised btn-xs"><i class="zmdi zmdi-refresh"></i></a></td>
						<td><a href="#!" class="btn btn-danger btn-raised btn-xs"><i class="zmdi zmdi-delete"></i></a></td>
					</tr>   				
				`; 
				let htmlSumi = ``;
				for (let index = 0; index < datosmodal.length; index++) { //El index tiene que comenzar desde cero. Porque cada uno de los suministros tiene como indice un numeral, y este comienza con el cero.
					
					htmlSumi += `
						<tr>
							<td>${index+1}</td>
							<td>${datosmodal[index]["codigo"]}</td>
							<td>${datosmodal[index]["direccion"]}</td>
							<td>${datosmodal[index]["categoria"]}</td>
							<td>${datosmodal[index]["medidor"]}</td>
							<td>${datosmodal[index]["corte"]}</td>
						</tr>	
					`;
					console.log(htmlSumi);					
				}

				//Escribe datos en el modal del suministro. 
				$(".txtDniAsocModal").val(datostabla["dni"]);
				$(".txtNombreAsocModal").val(datostabla["nombre"]);
				
				//IMPRIME DATOS PARA LOS ASOCIADOS Y SUMINISTROS		
				$(".responseAsoc").html(htmlAsoc);//Escribe datos en la tabla
				$(".responseSumi").html(htmlSumi);//Escribe datos en el modal
				
				//Limpia el msj de no se encontró nada.
				$(".infoAsoc").html("");

				//CONTROL DEL BTN PARA AGREGAR SUMINISTRO
				$('#btnAddSumiModal').attr("disabled", false)
				$('#btnAddSumiModal').attr("data-toggle", "modal")							

			}else{
				//Limpia la tabla de asociado.
				$(".responseAsoc").html("");
				//Imprime msj de error cuando no coincide el dato con los registro de la db
				$(".infoAsoc").html("<div class='text-danger'>No se encontró asociado...</div>");
				
				//CONTROL DEL BTN PARA AGREGAR SUMINISTRO
				$('#btnAddSumiModal').attr("disabled", true)
				$('#btnAddSumiModal').attr("data-toggle", "#")
				
			}
        
		}
	});

});


function InsertarSuministro(){

	document.getElementById("btnisum").addEventListener('click',(e)=>{
		e.preventDefault();

		let dni = $("#txtDniAsocModal").val();
		//document.getElementById("direccionPsjSumi").focus();

		let dt = new FormData(formularioSumi);
		dt.append('dni',dni);
		/*
		console.log(dt.get('dni'));
		console.log(dt.get('categoriaSumi'));
		console.log(dt.get('direccionSumi'));		
		console.log(dt.get('direccionPsjSumi'));		
		console.log(dt.get('direccionNroSumi'));		
		console.log(dt.get('medidorSumi'));		
		console.log(dt.get('corteSumi'));	
		*/
		//validar que no se dejen valores vacios en el formulario
		if(dt.get('direccionPsjSumi')=="" || dt.get('direccionNroSumi')==""){			
			//colocar cursor donde falta rrellenar información					
			if(dt.get('direccionPsjSumi')==""){
				document.getElementById("direccionPsjSumi").focus();
			}else{
				document.getElementById("direccionNroSumi").focus();
			}
			//mensaje de error cuando no se rellenan todos los campos
			swal({
				text: "¡Ingrese todos los campos correctamente!",
				type: "warning",										  		
				confirmButtonText: 'corregir'			
			});
			return false;
		}

		fetch('../ajax/gestionAS.php',{
			method: 'POST',
			body: dt
		})
		.then(res => res.json())
		.then(data=>{
			console.log(data)
			//response
			swal({
				title: "¡OK!",
				text: "¡Usuario ha sido creado correctamente!",
				type: "success",				
				confirmButtonColor: '#03A9F4',		  		
				confirmButtonText: '<i class="zmdi zmdi-run"></i> Aceptar',				
			}).then(()=>{
				console.log("le dio aceptar");
				//Cuando le de la opción de ok
				location.reload();
			},function(){
				console.log("No le dió aceptar")
				//si no le da a la opcion de aceptar
				location.reload();
			});
		})
	});
	
	console.log("funcion de insert sumi");
}

/**
 * Se actualizará la tabla de estado_gconsumo para dar inicio a la generación de consumo
 * para el mes que corresponde.
 */
function actualizarTabla_gconsumo(){
	console.log("UPDATE GCONSUMO");
    $("#btn_updGC").click(function(e){
		e.preventDefault();
		console.log("click update tabla gconsuo");

		let datos = new FormData();
    	datos.append("UPDfgc",true);
		
		fetch('../ajax/gestionAS.php',{
			method: 'POST',
			body: datos
		}).then(res => res.json())
		.then(data=>{
			console.log(data)
			location.reload();
			//response
		})
    });   
}

function generarConsumoSinMedidor(){
	document.querySelector("#btnGenerarCXD").addEventListener('click',()=>{
		let optionData = new FormData();
		optionData.append("OPTION","GCSMedi");

		fetch('../ajax/gestionRcbAjax.php',{
			method:'POST',
			body:optionData
		}).then(res => res.json())
		.then(data=>{
			console.log(data);
		});

		console.log("clickkk btn x defecto");
		//location.reload();
	});
}

InsertarSuministro();
