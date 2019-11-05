console.log("probando..GC_ASUSAP.");
function editRow(editableObj) {
	$(editableObj).css("background","#FFF");
	//console.log(editableObj);
}
function saveToDB(editableObj,id) {
	$(editableObj).css("background","#FFF url(cargando.gif) no-repeat right");
	console.log($(editableObj).text()+id);
	$.ajax({
		url: "../ajax/gc.php",
		type: "POST",
		data:'editval='+$(editableObj).text()+'&id='+id,
		success: function(data){
			$(editableObj).css("background","#00fdeb");
		}
	});

}
function listar_gconsumo(valor){
	//console.log(valor);
	//let idsumunistro = $("#buscar").val();
	if ($('#buscar').val()){
		$('#datos-resultGC').show();

		$.ajax({
			url:"../ajax/buscarGC.php",
			type:'POST',
			data:'valor='+valor

			}).done(function(resp){
			let valores = JSON.parse(resp);

			htmlSumi=`
				<table class='table table-bordered'>
					<thead>
						<tr>
							<th>#</th>
							<th>usuario</th>
							<th>Sumistro</th>
							<th>Direcion</th>
							<th>MONTO</th>
							<th>año</th>
							<th>mes</th>
							<th>F. de Emision</th>
							<th>H. de Emision</th>
							<th>CONSUMO </th>
						</tr>
					</thead>
					<tbody>`;

			for(let i=0;i<valores.length;i++){

				htmlSumi += `
							<tr>
								<td>${i+1}</td>
								<td>${valores[i]["nombre"]}</td>
								<td>${valores[i]["codSu"]}</td>
								<td>${valores[i]["dire"]}</td>
								<td class="text-center" style="background: yellow;color: red;">
									S/ ${valores[i]["monto"]}
								</td>
								<td>${valores[i]["anio"]}</td>
								<td>${valores[i]["mes"]}</td>
								<td>${valores[i]["fechE"]}</td>
								<td>${valores[i]["horaE"]}</td>
								<td class="text-center" style="background: #00aa9a;color: red;" contenteditable="true" onBlur="saveToDB(this,${valores[i]["idfact"]})" onClick="editRow(this); autofocus">
									${valores[i]["consumo"]}
								</td> 
						
							</tr>	
						`;

			}
			htmlSumi+=` </tbody> </table>`;

			$("#container").html(htmlSumi);
		});

	}
	else {
		$('#datos-resultGC').hide();

	}

}

