



/*---------------lista al momento hacer la busqueda-------------------*/

function objetoAjax() {
    var xmlhttp=false;
    try{
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
    }catch (e) {
        try{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }catch (e) {
            xmlhttp=false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined'){
        xmlhttp=new XMLHttpRequest();
    }
    return xmlhttp;
}
function rowRecibo(idrecibo){
    //let d=$('#idfac').val();
    let x=idrecibo.cells;
    let  a = x[1].innerHTML;
    let d=a;
    ajax=objetoAjax();

   // ajax.open("POST","../views/modules/ASupdate-view.php",true);
    ajax.open("POST","../ajax/gestionASERV.php",true);
    ajax.onreadystatechange=function(){
        if (ajax.readyState==4){
            document.getElementById("resultado").innerHTML=ajax.responseText;
        }
    }

    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    ajax.send("varp2="+d);
    console.log(d);
}

function abrir(id_fila) {
    var myTable = document.getElementById("alltable");
    var rowCount = myTable.rows.length;
    console.log(rowCount)
    var p=$('#'+id_fila);
    var u=p[0].cells[1].innerText;
    console.log("estas en id"+u)


        if($('#'+id_fila).hasClass('seleccionada')){
            $('#'+id_fila).removeClass('seleccionada');
            console.log("has borrado el marcador")
        } else{
            console.log("has seleccionado el marcador")
            $('#'+id_fila).addClass('seleccionada');

        }

    //2702id_fila_selected=id_fila;
    id_fila_selected.push(id_fila);
    var a=$('#'+id_fila);

    var k=a[0].cells[2].innerText;
    console.log(k)
   window.location="http://localhost/SW-ASUSAP/ASupdate/"+u;



}

function listar_as(valor) {

    console.log("click en el buscar amortizae")

    if ($('#buscarAS').val()){
        $('#datos-resultAS').show();
        $.ajax({
            url:"../ajax/gestionASERV.php",
            type:'POST',
            data:'valor='+valor,
            success:function (resp) {
                let valores = JSON.parse(resp);
                htmlSumi=`<table class='table table-bordered' id="alltable"><thead><tr><th>#</th><th>RECIBO</th><th>Nombre Apellido.</th><th>Cod. Sumistro</th><th>Año</th><th>Mes</th><th>Fecha</th><th>Tota Pago</th><th>Amortizar </th></tr></thead><tbody>`;

                for(let i=0;i<valores.length;i++){
                   // onclick="rowRecibo(this);"
                    htmlSumi += `
						<tr id="fila`+`${i + 1}`+`" >
							<td>${i+1}</td>
							<td >${valores[i]["idfacts"]}</td>
							<td>${valores[i]["anombre"]}</td>
							<td>${valores[i]["codSum"]}</td>
							<td>${valores[i]["anio"]}</td>
							<td>${valores[i]["mes"]}</td>
							<td>${valores[i]["fechars"]}</td>
							<td>S/ ${valores[i]["totalPago"]}</td>
                            <td><a href="#!" class="btn btn-info btn-raised btn-xs "   id="fila`+`${i + 1}`+`"   onclick="abrir(this.id);">Amortizar</a></td>
						</tr>	
					`;
                    // onclick="abrir(`+`${i + 1}`+`)
                    // <td><a href="http://localhost/SW-ASUSAP/ASupdate/?idF=${valores[i]["idfacts"]}" class="btn btn-info btn-raised btn-xs">Amortizar</a></td>

                }
                htmlSumi+=`</tbody></table>`
                $("#containerAS").html(htmlSumi);
                // $('#add-all').hide();
            }

        });
    }else {
        $('#datos-resultAS').hide();
        $('#add-all').hide();
    }

}

/*--------------collapsible------------------*/

//$(document).ready(function() {
    var coll = document.getElementsByClassName("collapsible");

    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {

            let codR = $("#toCoRS").val();

            let datos = new FormData();
            datos.append("codARSS",codR);

            $.ajax({
                url:"../ajax/gestionASERV.php",
                method:"POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function (resp) {

                    console.log(resp)
                    /*let valores = JSON.parse(resp);
                    htmlSumi=`<table class='table table-bordered' ><thead><tr><th>#</th><th>Nombre y descripcion</th><th>Monto.</th></tr></thead><tbody>`;
                    for(let i=0;i<valores.length;i++){

                        htmlSumi += `
						<tr>
							<td>${i+1}</td>
							<td>${valores[i]["descrRA"]}</td>
							<td>${valores[i]["costoRA"]}</td>

						</tr>
					`;
                    }
                    htmlSumi+=`</tbody></table>`
                    $("#reciboA").html(htmlSumi);*/
                    /*let valores = JSON.parse(resp);

                    htmlSumi=`<table class='table table-bordered' ><thead><tr><th>#</th><th>Nombre y descripcion</th><th>Monto.</th></tr></thead><tbody>`;

                    for(let i=0;i<valores.length;i++){

                        // onclick="rowRecibo(this);"
                        htmlSumi += `
						<tr>
							<td>${i+1}</td>
							<td >${valores[i]["descrRA"]}</td>
							<td>${valores[i]["costoRA"]}</td>
						</tr>
					`;
                    }
                    htmlSumi+=`</tbody></table>`

                    $("#reciboA").html(htmlSumi);*/

                }

            });

            //console.log(codR)
            this.classList.toggle("active");
            var content = this.nextElementSibling;

            // return AJAX;

            if (content.style.maxHeight){
                content.style.maxHeight = null;

            } else {

                content.style.maxHeight = content.scrollHeight + "px";


            }

        });
    }
//});

function guardarDB(editableObj) {

let mt=$('#montAll').val();
let t=$('#montPa').val();
    let mp=parseInt(mt)-parseInt(t);

if (mp>0 && mp<mt){
   res=mp;

}
else if( mp<mt ) {
    res=0;

}
else {
   if (t<0){
       res=0;
   }else {
       res=mt;
   }


}
htmlSumi=`<b><input type="text" name="montTot" value="`+res+`" disabled ></b>`
$("#montP").html(htmlSumi);

   // console.log(' has echo en la monto pagar'+t+mt);

//let nh=$('#montP').innerHTML = parseInt(mt);

    /* $.ajax({
         url: "../ajax/gc.php",
         type: "POST",
         data:'editval='+$(editableObj).text()+'&id='+id,
         success: function(data){
             $(editableObj).css("background","#00fdeb");
         }
     });*/
}
function resaltar(){
   //let a=$("#contentAMRS").childNodes;

  // Console.log(a)
}
//Cuando la página esté cargada ejecutará la función resaltar
$("#contentAMRS").ready(resaltar);

    /*----------------------GUARDAR AMORTIZACION-------------------------------------*/
function guardarARMOTIZACION() {

    let mpag=document.getElementById("montPa").value;
    let mTotal=document.getElementById("montAll").value;
    let ids=document.getElementById("idReciboA").innerHTML;
    let rest=mTotal-mpag;

    console.log("monto pagado esta guardandose "+ids+mpag)
    $.ajax({
        url: "../ajax/gestionASERV.php",
        type: 'POST',
        data: 'mopagr=' + mpag+'&idsr=' + ids+'&montRes=' + rest,
        success: function (resp) {
            console.log("si ineserto monto pagado"+resp)
        }
    });

}

