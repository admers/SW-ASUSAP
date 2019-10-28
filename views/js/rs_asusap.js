function editRowRS(editableObjRS){
   // console.log("valor"+editableObjRS)
    $(editableObjRS).css("background","#FFF");
}

function guardarABD(editableObjRS,id) {
   // let ids = $("#ids").val();
    let descripcion = $("#descripcion").val();
    let monto = $("#monto").val();
    precio=$(editableObjRS).text();
    precio1=$(id).text();
    //$(editableObjRS).css("background","#FFF url(cargando.gif) no-repeat right");
    //console.log(ids+descripcion+monto);
    console.log($(editableObjRS).text()+id);

    var b=[];
    b=[precio1,precio]

  //console.log('OPCION'+b[2])

   //console.log( editableObjRS+id);
   /* $.ajax({
        url: "../ajax/buscarRS.php",SSS
        type: "POST",
        data:'insertV='+$(editableObjRS).text()+'&idV='+id,
        success: function(data){
            $(editableObjRS).css("background","#00fdeb");
        }
    });*/

}


let  c=0;
let  a=0;
let precio=0;
let t=Math.floor(Math.random() * 100) + 1;


function crearNuevo(){

    c+=1;



    let data = '<tr class="table-row" id="new_row_ajax">' +
        '<td scope="row" contenteditable="false"  onBlur="guardarABD(this,c)" id="txt_id"  onClick="editRowRS(this);"><input type="hidden" id="ids">'+c+'</td>' +

        '<td contenteditable="true" onBlur="guardarABD(this,c)"  id="txt_descripcion" onClick="editRowRS(this);"><input type="hidden" id="descripcion"></td>' +

        '<td contenteditable="true" onBlur="guardarABD(this,c)" onClick="editRowRS(this);" id="txt_monto"  ></td>' +
        '</tr>';

    //console.log("Has echo click"+'descripcion');
    $("#table-body").append(data);
}

function showRow(row) {
    let x=row.cells;
   // console.log(x[1]);

    document.getElementById("idrs").innerHTML = x[1].innerHTML;
    let  n = document.getElementById("nombreSR").innerHTML = x[2].innerHTML;
    let  a = document.getElementById("apellSR").innerHTML  = x[3].innerHTML;
    document.getElementById("codSR").innerHTML  = x[4].innerHTML;
    document.getElementById("direRS").innerHTML  = x[5].innerHTML;
    document.getElementById("anioRS").innerHTML  = x[6].innerHTML;
    document.getElementById("mesRS").innerHTML  = x[7].innerHTML;
    document.getElementById("anombre").value  = n+" "+a;
    //document.getElementById("codSR").value = x[2].innerHTML;
}

function listar_rs(valor) {

    if ($('#buscarRS').val()){
        $('#datos-result').show();
        $.ajax({
            url:"../ajax/buscarRS.php",
            type:'POST',
            data:'valor='+valor,
            success:function (resp) {
                let valores = JSON.parse(resp);
                htmlSumi=`<table class='table table-bordered'><thead><tr><th>#</th><th>usuario</th><th>Nombre AS.</th><th>Apellido AS.</th><th>Suministro</th><th>Direccion</th><th>año</th><th>mes</th><th>Seleccionar </th></tr></thead><tbody>`;
                for(let i=0;i<valores.length;i++){

                    htmlSumi += `
						<tr onclick="showRow(this);">
							<td>${i+1}</td>
							<td>${valores[i]["idfacts"]}</td>
							<td>${valores[i]["nombreAS"]}</td>
							<td>${valores[i]["apellidoAS"]}</td>
							<td>${valores[i]["codSum"]}</td>
							<td>${valores[i]["direSR"]}</td>
							<td>${valores[i]["anio"]}</td>
							<td>${valores[i]["mes"]}</td>
                            <td><a href="#!" class="btn btn-info btn-raised btn-xs">Seleccionar</a></td>
					
						</tr>	
					`;
                }
                htmlSumi+=`</tbody></table>`
                $("#containerRS").html(htmlSumi);
            }

        });
    }else {
        $('#datos-result').hide();
    }

}