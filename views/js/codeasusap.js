console.log("arrancando->Codeasusap.js");
actualizarTabla_gconsumo();
busacarAsocBtn();
generarConsumoSinMedidor();

InsertarSuministro();

//cuando ingresen código para buscar al asiciado
function busacarAsocBtn(){
	let el = document.getElementById("btnBuscarAsoc");
	if(el){

		el.addEventListener('click',function(){
			
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
	}

}

function InsertarSuministro(){

 	let el =  document.getElementById("btnisum")
	if(el){
		console.log("funcion insertarSuministro");
		el.addEventListener('click',(e)=>{
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
				
	}
}

/**
 * Se actualizará la tabla de estado_gconsumo para dar inicio a la generación de consumo
 * para el mes que corresponde.
 */
function actualizarTabla_gconsumo(){
	let el = document.querySelector("#btn_updGC");
	if(el){		
		//let el = $("#btn_updGC");
		console.log("UPDATE estado GCONSUMO");
		$("#btn_updGC").click(function(e){
			e.preventDefault();
			//console.log("click update tabla gconsuo");

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
}
/**
 * A traves de un btn se generará los consumos
 * desaparecerá cuando se hayá generado los consumos para el mes que corresponde
 */
function generarConsumoSinMedidor(){
	let el = document.querySelector("#btnGenerarCXD");
	if(el){		
		el.addEventListener('click',()=>{
			let optionData = new FormData();
			optionData.append("OPTION","GCSnMedi");

			fetch('../ajax/gestionRcbAjax.php',{
				method:'POST',
				body:optionData
			}).then(res => res.json())
			.then(data=>{
				console.log(data);
				if(data)
					location.reload();
				
			});

			console.log("click en btn consumo x defecto");
			
		});
	}
}

function generarConsumoConMedidor(value){
	let el = document.querySelector('#buscarSumCnM');
	if(el){
		console.log("Fn->generarConsumoConMedidor",value);
		
		let optionData = new FormData();
		optionData.append('OPTION',"GCCnMedi");
		optionData.append("codigo_sum",value);
		
		fetch("../ajax/gestionRcbAjax.php",{
			method:"POST",
			body:optionData
		}).then(res=>res.json())
		.then(data=>{

			if(data=="LISTO"){
				//crear boton de reinicio. reload
				console.log("MSJ DE LISTO - TERMINADO!!")
				document.querySelector("#alertOfCompl").innerHTML = `<span class="text-success blockquote"> LISTO!!</span>`;
				document.querySelector("#rspSumi").innerHTML = '';
				return null;
			}

			let htmlSumi = ``;
			let nmracion = 0;		
			data.forEach(element => {			
				htmlSumi +=`
					<tr>
						<th scope="row">${++nmracion}</th>
						<td>${element.codigo_sum}</td>
						<td contenteditable="true" onBlur="cogerConsumo(this,${element.consm_ant},'${element.codigo_sum}','${element.categoria}')" style="background: #00aa9a;color: red;" placeholder="0.0" autofocus>
							0.0
						</td>
						<td>${element.consm_ant}</td>
						<td>${element.contador_deuda}</td>
						<td>${element.nombre} ${element.apellido}</td>      
						<td>${element.categoria}</td>
						<td>${element.direccion}</td>

					</tr>
				`;
			});

			document.querySelector("#rspSumi").innerHTML = htmlSumi;		
			
		});

	}

}
generarConsumoConMedidor("");

function cogerConsumo(value, cons_ant, cod_sum, categoria){

	//realizar el repintado por si habia cometido un error.
	value.style.background = "#00aa9a";
	value.style.color = "red";


	let consumo = value.innerHTML;
	consumo = consumo.replace(",",".");
	consumo_df = eval(consumo - cons_ant);//diferencia de consumo ingresado y el consumo del mes anterior
	consumo_df = Number(consumo_df.toFixed(2));// determinanod la cantidad de decimales.	
	let monto = generarMonto(consumo_df,categoria);

	//si distinto de false, el monto es valido
	if(monto['res']!=false){

	//MENSAJE DE ALERTA PARA INSERTAR CONSUMO O NO :d
		swal({
			title: "¿Ejecutar esta acción?",
			text: "CONSUMO: "+ consumo +"<br>USUARIO: " + cod_sum + "<br>MONTO: " + monto.valor,
			type: "info",				
			confirmButtonColor: '#03A9F4',		  		
			confirmButtonText: '<i class="zmdi zmdi-run"></i> Aceptar',		
			showCancelButton: true,
			cancelButtonColor: '#F44336',
			cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> Cancel'		
		}).then(()=>{
			//Cuando le de la opción de ok
			console.log("le dio aceptar",consumo,cod_sum);
			//document.querySelector("#rspSumi").innerHTML = "--->>"+cod_sum;				
			/*
			*/
			dataS = new FormData();
			dataS.append("consumo",consumo);
			dataS.append("cod_sum",cod_sum);
			dataS.append("monto",monto.valor);
			dataS.append("OPTION","insertGCCnM");
			
			fetch('../ajax/gestionRcbAjax.php',{
				method:'POST',
				body:dataS
			})
			.then(res => res.json())
			.then(data=>{
				console.log("->",data);
				
				//actualizar tabla 
				let inputCode = document.querySelector("#buscarSumCnM").value;
				generarConsumoConMedidor(inputCode);
			});
		
		},function(){
			//si no le da a la opcion de aceptar
			console.log("No le dió aceptar")
			//value.innerHTML = 0;
			//location.reload();
		});

	}else{
		//color de ERROR para cuando ingrese un consumo invalido
		if(monto.option == 'negativo'){
			value.style.background = "orange";
			value.style.color = "white";		
		}else if(monto.option == 'invalido'){
			value.style.background = "red";
			value.style.color = "white";
		}else{
			value.style.background = "red";
			value.style.color = "white";			
		}
		console.log("no p",value);
	}
}

//escribir algoritmo para generar el monto con respecto al consumo ingresado
function generarMonto(consumo, categoria){
	//validando que sea un efectivamente un número valido. 
	if(!isNaN(parseFloat(consumo)) && isFinite(consumo)){
		if(consumo>=0){
			let calcMonto = 0, calcPrev = 0, igv = 0.18;
			if(categoria == 'Domestico'){
				consumo-=20;
				calcMonto += 4.20;
				if(consumo > 0){
					if(consumo <= 20){
						sumaMonto = consumo*0.60;
						calcMonto += sumaMonto + sumaMonto*igv;						
					}else{
						consumo -= 20;
						calcPrev = 20*0.60;
						calcMonto += calcPrev + calcPrev*igv;

						sumaMonto = consumo*0.95;
						calcMonto += sumaMonto+sumaMonto*igv;
					}
				}

			}
			else if(categoria == 'Comercial'){
				if(consumo <= 20){
					calcMonto = 10.00;
				}else{
					consumo-=20;
					calcMonto = 10.00;

					calcPrev = consumo*0.95;
					calcMonto += calcPrev + calcPrev*igv;
				}
			}
			else if(categoria == 'Estatal'){
				if(consumo <= 20){
					calcMonto = 12.00;
				}else{
					consumo-=20;
					calcMonto = 12.00;

					calcPrev = consumo*0.95;
					calcMonto += calcPrev + calcPrev*igv;
				}
			}
			else if(categoria == 'Industrial'){
				calcPrev = consumo*2.00;
				calcMonto = calcPrev + calcPrev*igv;
			}
			calcMonto = Number(calcMonto.toFixed(1));
			return {res:true, valor:calcMonto};

		}else{
			return {res:false, option:'negativo'};
		}
	}
	return {res:false, option:'invalido'};
}

//---------------------btn Buscar suministro con CORTE
function buscarSumiConCorte(){	
	let el = document.querySelector("#btnBuscarSumCorte");
	if(el){
		console.log("coem");			
		actualizarTablaConCorte("");
		el.addEventListener('keyup',function(){	
			console.log(this.value);			
			actualizarTablaConCorte(this.value);
		});
	}
}
function actualizarTablaConCorte($bsc_cod){
	//traer toda la tabla completa con limit 10
	let restbl = document.querySelector("#tblSumCorte");
	let data = new FormData();
	data.append('OPTION','bscSumCnCorte')
	data.append('infoDBsqd',$bsc_cod)
	fetch("../ajax/gestionRcbAjax.php",{
		method:'post',
		body:data
	}).then(res => res.json())
	.then(data=>{
		//console.log(data);
		let htmlRS = ``;
		let num = 0;
		data.forEach(element => {
			htmlRS += `
					<tr>
						<th scope="row">${++num}</th>
						<td>${element.cod_suministro}</td>
						<td>${element.nombre} ${element.apellido}</td>
						<td>${element.direccion}</td>
						<td>${element.telefono}</td>
						<td>${element.categoria_suministro}</td>
						<td class="text-center text-info">${element.contador_deuda}</td>
						<td class="text-center text-danger">                            							
							<b>EN CORTE</b>                  
						</td>
					</tr>	
			`;
		});
		restbl.innerHTML = htmlRS;
	});

}

buscarSumiConCorte()
//---------------------FIN - btn Buscar suministro con CORTE

/***************** EVENTOS GENERAR RECIBOS **************************** */
function generarmeses($selectmese, $selectanio){
	let elfech = document.querySelector($selectmese);
	if(elfech){
		console.log(elfech);
		let anio = document.querySelector($selectanio);
		let anioActual = anio.value; //la primera vez que corre es el año actual. :D
		mesesAct = elfech.innerHTML; //la primera vez que corre es los meses transcurridos hasta hoy :D
		anio.addEventListener('click',()=>{
			console.log(anio.value);
			console.log(anioActual);
			if(anio.value == anioActual){
				console.log("pintar hasta este mes")
				elfech.innerHTML = mesesAct;
			}else{
				console.log("pintar todos los mese")
				mesCom = `
					<option value="1">Enero</option><option value="2">Febrero</option><option value="3">Marzo</option><option value="4">Abril</option><option value="5">Mayo</option><option value="6">Junio</option><option value="7">Julio</option><option value="8">Agosto</option><option value="10">Octubre</option><option value="11">Noviembre</option><option value="12">Diciembre</option>
				`;
				elfech.innerHTML = mesCom;
			}
		})
	}
}
generarmeses(".fechas-meses","#fecha_anio");
generarmeses("#fecha_mesXsumi","#fecha_anioXsumi");

function GRbuscarXdireccion(){
	let el = document.querySelector("#nombreDirec");
	if(el){
		console.log("function->GRbuscarXdireccion()")

		$option_anio = document.querySelector('#fecha_anio');
		$option_mes = document.querySelector('#fecha_mes');
		
		//Linpiando tabla y buscador
		{
			$option_anio.addEventListener('click',()=>{
				el.value = '';
				document.querySelector("#resTablaRD").innerHTML = ``;
			})
			$option_mes.addEventListener('click',()=>{
				el.value = '';
				document.querySelector("#resTablaRD").innerHTML = '';
			})
		}
		
		actualizarTblGRDireccion("",$option_anio.value,$option_mes.value);
		console.log(el);		
		el.addEventListener("keyup",function(){
			//console.log("keyup",this.value);
			console.log($option_anio.value);
			console.log($option_mes.value);

			let nombreDireccion = this.value;

			actualizarTblGRDireccion(nombreDireccion,$option_anio.value,$option_mes.value);

		});
	}
}
function actualizarTblGRDireccion(direccion,anio,mes){
	let data = new FormData();
	data.append('OPTION','buscarRD');
	data.append('nombreDirec',direccion);
	data.append('anio',anio);
	data.append('mes',mes);

	fetch('../ajax/gestionRcbAjax.php',{
		method:'POST',
		body:data
	}).then(res => res.json())
	.then(rdata=>{
		console.log(rdata);
		//imprimir tabla

		$htmlRecib=``;
		let cont = 0;
		rdata.forEach(element=>{
			$htmlRecib += `
				<tr>
					<td>${++cont}</td>
					<td>${element.direccion}</td>          
					<td><a href="../reportes/rxd.php?direccion=${element.direccion}&anio=${$option_anio.value}&mes=${$option_mes.value}" class="btn btn-info btn-raised btn-xs" target="_blank">G. Recibo</a></td>
				</tr>
			`;					
		});

		document.querySelector("#resTablaRD").innerHTML = $htmlRecib;

	})
}

GRbuscarXdireccion();

// onkeyup(this) Función en el HTML erecibo-view.php
function GRbuscarSumXCod($this){
	console.log("Function -> GRbuscarSumXcod(value)")

	{
		document.querySelector("#fecha_anioXsumi").addEventListener('click',()=>{
			document.querySelector("#tblRspxSum_GR").innerHTML=``;			
		})
		document.querySelector("#fecha_mesXsumi").addEventListener('click',()=>{
			document.querySelector("#tblRspxSum_GR").innerHTML=``;			
		})
	}

	let txtCodSum = $this.value;
	let anioxsum = document.querySelector("#fecha_anioXsumi").value;
	let mesxsum = document.querySelector("#fecha_mesXsumi").value;
	console.log(txtCodSum);
	console.log(anioxsum, mesxsum);

	let data = new FormData();
	data.append("OPTION",'bscGRxSum');
	data.append("cod_sum",txtCodSum);
	data.append("anio",anioxsum);
	data.append("mes",mesxsum);

	fetch('../ajax/gestionRcbAjax.php',{
		method:"post",
		body:data
	}).then(res => res.json())
	.then(data => {
		console.log(data);
		let cont = 0;
		let html =``;	
		data.forEach(element=>{
			html +=`
			<tr>
				<td>${++cont}</td>
				<td>${element.suministro_cod_suministro}</td>
				<td>${element.anio}</td>
				<td>${element.mes}</td>
				<td>${element.monto_pagar}</td>
				<td>${element.esta_cancelado=='1'?"<span class='text-info'>Si</span>":"<span class='text-danger'>No</span>"}</td>
				<td>${element.tiene_medidor=='1'?'Si':'No'}</td>
				<td>${element.estado_corte=='1'?"<span class='text-danger'>Si</span>":"<span class='text-info'>No</span>"}</td>
				<td><a href="../reportes/rxp.php?codigoSum=${element.suministro_cod_suministro}&anio=${element.anio}&mes=${element.mes}" target="_blank" class="btn btn-info btn-raised btn-xs">G. Recibo</a></td>				
			</tr>			
			`;
		})	
		document.querySelector("#tblRspxSum_GR").innerHTML=html;
	})

}


//fUNCIONES PARA CRECIBO
function buscarSuministrosParaCobrar(){
	let el = document.getElementById('txtBscSumCobro');
	if(el){
		buscarSuministrosParaCobrarTBL('');
		el.addEventListener('keyup',()=>{	
			console.log(el.value);
			buscarSuministrosParaCobrarTBL(el.value);
		})
	}
}
function buscarSuministrosParaCobrarTBL(txtInput){
	
	let data = new FormData();
	data.append('OPTION','CobrarRecibo');
	data.append('cod_sum',txtInput);
	
	fetch('../ajax/gestionRcbAjax.php',{
		method:'POST',
		body:data
	}).then(res => res.json())
	.then(data=>{
		console.log(data)
		let ahtml = ``;
		let cont = 0;
		data.forEach(element=>{
			console.log(element)			
			ahtml += `
				<tr>
					<td>${++cont}</td>
					<td>${element.suministro_cod_suministro}</td>
					<td>${element.categoria_suministro}</td>
					<td>${element.anio}</td>
					<td>${element.mes}</td>
					<td>s/ ${element.monto_pagar}</td>
					<td><a href="#!" class="btn btn-success btn-raised btn-xs" onclick="cobrarAgua(this,'${element.suministro_cod_suministro}',${element.anio},${element.mes},${element.monto_pagar},${txtInput})">Cobrar</a></td>
				</tr>				
			`;
		});
		document.querySelector('#rspTblCrecibo').innerHTML = ahtml;
	})
}
function cobrarAgua(e,cod_sum,anio,mes,monto,txtinput){
	//DESCONTAR CONTADOR DEUDA
	//ESTADO CORTE, RESTAURAR. 
	let lmes = NombreMes(mes);

	console.log(e,cod_sum,lmes);
	swal({
		title: "¿Realizar cobro?",
		text: "<p>Para el mes de <b>"+lmes+"</b></p>SUMINISTRO: <b>" + cod_sum + "</b><br>COBRAR:    <b>S/ " + monto +" Soles</b>",
		type: "info",				
		confirmButtonColor: '#03A9F4',		  		
		confirmButtonText: '<i class="zmdi zmdi-run"></i> Aceptar',		
		showCancelButton: true,
		cancelButtonColor: '#F44336',
		cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> Cancel'		
	}).then(()=>{
		//Cuando le de la opción de ok
		let data = new FormData();
		data.append('OPTION','PagoRecibo');
		data.append('cod_sum',cod_sum);
		data.append('anio',anio);
		data.append('mes',mes);
	
		fetch('../ajax/gestionRcbAjax.php',{
			method:'post',
			body:data
		}).then(res => res.json())
		.then(data =>{
			console.log("data -> ",data);
			console.log("txtinput -> ",txtinput)
			txtinput = (txtinput==null || txtinput==undefined)?'':txtinput;
			buscarSuministrosParaCobrarTBL(txtinput);
		})
	},function(){
		//si no le da a la opcion de aceptar
		console.log("No le dió aceptar",cod_sum)
	});


	
}

buscarSuministrosParaCobrar()

//Función Nombre de fechas mes
function NombreMes($n_mes){
	$n_mes = Number($n_mes);
	switch ($n_mes) {
		case 1:
			$r_mes = "Enero";
			break;
		case 2:
			$r_mes = "Febrero";
			break;
		case 3:
			$r_mes = "Marzo";
			break;
		case 4:
			$r_mes = "Abril";
			break;				
		case 5:
			$r_mes = "Mayo";
			break;
		case 6:
			$r_mes = "Junio";
			break;
		case 7:
			$r_mes = "Julio";
			break;
		case 8:
			$r_mes = "Agosto";
			break;
		case 9:
			$r_mes = "Septiembre";
			break;
		case 10:
			$r_mes = "Octubre";
			break;
		case 11:
			$r_mes = "Noviembre";
			break;
		case 12:
			$r_mes = "Diciembre";
			break;												
		default:
			$r_mes = $n_mes;
			break;
	}	
	return $r_mes;
}
