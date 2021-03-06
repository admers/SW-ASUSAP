<?php 

//Permite incluir los archivos necesarios para las funciones de consulta.
$AjaxRequest=true;

require_once "../controllers/adminController.php";
require "fpdf/fpdf.php";


//Recepcionando datos por GET
$selectDireccion = $_GET['direccion'];//$_GET['direccion'] || 'Jr. los chancas'
$selectAnio = $_GET['anio'];
$selectMes = $_GET['mes'];

//Inicializando objeto de consultas
$objDirec = new adminController();

//mensaje admin
$msjAdmin = utf8_decode($objDirec->getmensajeReciboController());
//devuelve los registros por dirección
$resConsult = $objDirec->recibosObtenerDataSumXdirec($selectDireccion,$selectAnio,$selectMes);
//devuelve el mes en forma literal
$fechaL = $objDirec->obtenerNombrefecha($selectAnio,$selectMes);
$mesLit = $fechaL['r_mes'];
//Asigna el fondo para el recibo 
$_POST['urlimg'] = $resConsult['res']?'img/reciboAgua.jpg':'img/sinResultado.jpg';

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        //$this->Image('logo.jpg',10,8,33);
        //$this->Image('img/sinResultado.jpg',0,0,148,210);
        // Arial bold 15
        $this->SetFont('Arial','B',20);
        // Movernos a la derecha
        $this->SetXY(5,7);
        // Título
        $this->Cell(30,12,'ASUSAP',0,0,'C');
        // Salto de línea
        //$this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        //$this->SetY(-15);
        // Arial italic 8
        //$this->SetFont('Arial','I',8);
        // Número de página
        //$this->Cell(0,10,'Pag '.$this->PageNo(),0,0,'C');
    }

}

//function mainClass(){
//}
//mainClass();

//pdf --A5 en mm Array(148, 210) / (148, 218.01)
$pdf = new PDF('P','mm',Array(148, 223) );

if(!$resConsult['res']){
    //cUANDO NO HAY REGISTRO
    $pdf->AddPage();    
    $pdf->Image($_POST['urlimg'] ,0,0,148,210);    

    $pdf->SetFont('Arial','B',20);
    $pdf->SetXY(5,7);
    $pdf->Cell(30,12,'ASUSAP',0,0,'C');

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(21,4.5);
    $pdf->Cell(100,10,"SIN REGISTROS PARA {$mesLit} del {$selectAnio}",0,0,'C');

}else{
    //CUANDO HAY REGISTROS

    $dataQuery = $resConsult['data'];

    while($element = $dataQuery->fetch(PDO::FETCH_ASSOC)){

        $medidor = $element['tiene_medidor']?'Si':'No';    
        $cortado = $element['estado_corte']?'Si':'No';
        $esta_cancelado = $element['esta_cancelado']?'RECIBO CANCELADO':'FALTA CANCELAR';

        //verifica que sea una institución para solo imprimir el nombre
        $nombre_completo = ($element['categoria_suministro']=='Estatal')?utf8_decode($element['nombre']):utf8_decode($element['apellido']." ".$element['nombre']); 
        $_POST['urlimg'] = $element['estado_corte'] || $element['contador_deuda']>=2?'img/corte.jpg':'img/reciboAgua.jpg';
        
        //MESAJE DE CORTE O NO CORTE
        $msjCorte = ($element['contador_deuda']>=2)?'PRÓXIMO MES EN CORTE!!':'NO ESTÁ EN CORTE';
        $msjCorte = ($element['contador_deuda']>=3)?'EN CORTE':$msjCorte;

        //Función que recupera los meses de las deudas anteriores
        $deudasMes = $objDirec->consultaDeudasMes($element['cod_suministro']);

        //Operacion de importe total
        $lectura_ant="#";
        $lectura_act = "#";
        $consumo_dif = "#";            
        if($medidor == "Si"){
            $lectura_act = $element['consumo'];
            $lectura_ant = $objDirec->obtenerConsumoAnterior($element['cod_suministro'],$selectAnio,$selectMes);
            $consumo_dif = $lectura_act-$lectura_ant;
        }

        //AGREGAMOS PÁGINA ****************************************************
        $pdf->AddPage();    
        $pdf->Image($_POST['urlimg'] ,0,0,148,210);
        
        //código del suministro
        $pdf->SetFont('Arial','B',15);     
        $pdf->SetXY(103,5);
        $pdf->Cell(45,8,$element['cod_suministro'],0,0,'C');
        
        //CONFIGURANDO EL TAMAÑO Y TIPO DE LETRA
        $pdf->SetFont('Arial','B',7);  

        //PRIMERA COLUMNA - INFORMACIÓN GENERAL ****************************************************
        $pdf->SetXY(24,35.5);
        $pdf->Cell(50,5,$nombre_completo ,0,0,'');  //nombre de tituar
        $pdf->SetXY(27,40.8);
        $pdf->Cell(50,5,$selectDireccion,0,0,'');    //direccion del titular 
        $pdf->SetXY(9,43.5);
        $pdf->Cell(100,10,utf8_decode("SAN JERÓNIMO"),0,0,''); //distrito
        $pdf->SetXY(11,48.8);
        $pdf->Cell(100,10,$element['categoria_suministro'],0,0,''); //categoria del suministro

        //SEGUNDA COLUMNA - INFORMACIÓN DE PAGO ****************************************************
        $pdf->SetXY(119,35.5);
        $pdf->Cell(50,5,"{$mesLit} del {$selectAnio}",0,0,''); //mes facturado 
        $pdf->SetXY(130.5,40.7);
        $pdf->Cell(50,5,"MENSUAL",0,0,''); //frecuencia de facturación
        $pdf->SetXY(121.8,46);
        $pdf->Cell(50,5,$element['fecha_emision'],0,0,''); //fecha emision
        $pdf->SetXY(127,51.2);
        $pdf->Cell(50,5,$element['fecha_vencimiento'],0,0,''); //fecha vencimiento

        //REGISTROS DEL MEDIDOR ****************************************************
        $pdf->SetXY(0,63);
        $pdf->Cell(18,9,$medidor,0,0,'C'); // Tiene medidor??
        $pdf->SetXY(18,63);
        $pdf->Cell(19,9,$lectura_ant." m3",0,0,'C'); // lectura anterior
        $pdf->SetXY(37,63);
        $pdf->Cell(19,9,$lectura_act." m3",0,0,'C'); // lectura Actual
        $pdf->SetXY(56,63);
        $pdf->Cell(19,9,$consumo_dif." m3",0,0,'C'); // consumo


        //INFORMACIÓN COMPLEMENTARIA ****************************************************              
        
        $pdf->SetXY(10,143);
        $pdf->Cell(100,5,"Cantidad deudas: {$element['contador_deuda']}",0,0,'');  
        
        //$pdf->SetXY(10,115);
        //$pdf->Cell(46,10,$esta_cancelado,1,0,'C'); // Está cancelado el recibo ??

        //Imprime los meses endeudados
        $pdf->SetXY(90,125);
        $total_suma_deudas=0; 
        $enum = 0;         
        for ($i=0; $i < count($deudasMes); $i++) { 
            # code...
            $total_suma_deudas += $deudasMes[$i]['monto_pagar'];
            if($deudasMes[$i]['mes'] == $selectMes)
                continue;
            $enum++;
            $nombreMes =  $objDirec->obtenerNombrefecha($deudasMes[$i]['anio'],$deudasMes[$i]['mes']);
            $pdf->SetX(90);
            $pdf->Cell(50,4,$enum.".- ".$nombreMes['r_mes']." del ".$nombreMes['r_anio'],0,0,'');
            $pdf->SetX(130);
            $pdf->Cell(50,4,"S/. ".$deudasMes[$i]['monto_pagar'],0,0,'');
            $pdf->ln();
        }
        
        //DETALLE DE LA FACTURACIÓN ****************************************************
        if($medidor=="Si" || $element['categoria_suministro'] == 'Mantenimiento'){
            $subT = modoDePago($pdf,$element,$consumo_dif);

            //conceptos----
            $pdf->SetXY(85,68+12);
            $pdf->Cell(100,10,"Cargo fijo",0,0,'');
            $pdf->SetXY(130,68+12);
            $pdf->Cell(100,10,"$/. 0.00",0,0,'');

            $pdf->SetXY(85,72+12);
            $pdf->Cell(100,10,"Alcantarillado",0,0,'');
            $pdf->SetXY(130,72+12);
            $pdf->Cell(100,10,"$/. 0.00",0,0,'');
            //nueva seccion igv y subtotal***************************************************
            //Sub total
            $pdf->SetXY(130,103.5);
            $pdf->Cell(100,10,"/S. ".number_format($subT['subt'],2),0,0,'');
            //IGV Total
            $pdf->SetXY(130,107);
            $pdf->Cell(100,10,"/S. ".number_format($subT['igvt'],2),0,0,'');
        }else{
            //primera fila de 
            $pdf->SetXY(85,64);
            $pdf->Cell(100,10,"Por consumo de agua x mes",0,0,'');
            $pdf->SetXY(130,64);
            $pdf->Cell(100,10,"$/. 3.56",0,0,'');

            //conceptos----
            $pdf->SetXY(85,68+2);
            $pdf->Cell(100,10,"Cargo fijo",0,0,'');
            $pdf->SetXY(130,68+2);
            $pdf->Cell(100,10,"$/. 0.00",0,0,'');

            $pdf->SetXY(85,72+2);
            $pdf->Cell(100,10,"Alcantarillado",0,0,'');
            $pdf->SetXY(130,72+2);
            $pdf->Cell(100,10,"$/. 0.00",0,0,'');

            //segunda fila de 
            /*
            $pdf->SetXY(85,67);
            $pdf->Cell(100,10,"Por IGV (18%)",0,0,'');
            $pdf->SetXY(130,67);
            $pdf->Cell(100,10,"$/. 0.64",0,0,'');
            */
            //nueva seccion igv y subtotal***************************************************
            //Sub total
            $pdf->SetXY(130,103.5);
            $pdf->Cell(100,10,"/S. 3.56",0,0,'');
            //IGV Total
            $pdf->SetXY(130,107);
            $pdf->Cell(100,10,"/S. 0.64",0,0,'');
        }
        $pdf->SetXY(74.3,111);
        $pdf->Cell(100,10,"Deuda Mes Actual",0,0,'');
        $pdf->SetXY(125,111);
        $pdf->Cell(20,10,"S/. ".number_format($element['monto_pagar'],2),0,0,'C');
        
        $pdf->SetFont('Arial','B',10);  
        $pdf->SetXY(118,140.5);
        $pdf->Cell(100,10,"S/. ".number_format($total_suma_deudas,2),0,0,'');
        
        //mensaje de corte
        $pdf->SetXY(2,152);
        $pdf->Cell(70,8,utf8_decode($msjCorte),0,0,'C');
        $pdf->SetFont('Arial','B',7);
        $pdf->SetXY(2,160);
        $pdf->MultiCell( 70, 5,$msjAdmin, 0,'C');
        
        
        //SECCIÓN RECORTAR -**********************************
        $pdf->SetFont('Arial','B',7); 
        $pdf->SetXY(21.5, 182.5);
        $pdf->Cell(100,10,$nombre_completo ,0,0,'');
        
        $pdf->SetXY(118, 182.5);
        $pdf->Cell(100,10,"{$mesLit} del {$selectAnio}",0,0,'');

        $pdf->SetXY(24, 188);
        $pdf->Cell(100,10,$element['direccion'] ,0,0,'');
        
        $pdf->SetFont('Arial','B',10); 
        $pdf->SetXY(117.2, 187.5);
        $pdf->Cell(100,10,"S/. ".number_format($total_suma_deudas,2),0,0,'');

        $pdf->SetFont('Arial','B',9); 
        $pdf->SetXY(0, 192.5);
        $pdf->Cell(100,10,"COD-SUMINISTRO: ".$element['cod_suministro'],0,0,'');
        
    }
    
}

$pdf->Output();


    //Funcione que retorna las formas de pago para las distintas categorias de los suministros
    function modoDePago($pdf,$element,$consumo_dif){
        $categoria = $element['categoria_suministro'];
        $x = 2;
        $val1 = 0; $val2 = 0; $val3 = 0; $resIGV=0;
        switch ($categoria) {
            case 'Domestico':
                # code...
                if($consumo_dif<=20){
                    $val1 = 3.56;
                }else{
                    $val1 = 3.56;
                    $consumo_dif-=20;
                    if($consumo_dif<=20){
                        $val2 = $consumo_dif * 0.60;                        
                    }else{
                        $val2 = 20 * 0.60;
                        $consumo_dif-=20;
                        $val3 = $consumo_dif * 0.95;
                    }
                }
                $val1 = round($val1, 1);
                $val2 = round($val2, 1);
                $val3 = round($val3, 1);

                $resIGV = ($val1+$val2+$val3)*0.18; $resIGV = round($resIGV, 1);                

                //primera fila de 
                $pdf->SetXY(85,64+0*$x);
                $pdf->Cell(100,10,"(De 0 a 20)m3 * $/ 0.18",0,0,'');
                $pdf->SetXY(130,64+0*$x);
                $pdf->Cell(100,10,"$/. ".number_format($val1,2),0,0,'');
                //segunda fila de 
                $pdf->SetXY(85,67+1*$x);
                $pdf->Cell(100,10,"(De 20 a 40)m3 * $/ 0.60",0,0,'');
                $pdf->SetXY(130,67+1*$x);
                $pdf->Cell(100,10,"$/. ".number_format($val2,2),0,0,'');
                //tercera fila de 
                $pdf->SetXY(85,70+2*$x);
                $pdf->Cell(100,10,"(De 40 a mas)m3 * $/ 0.95",0,0,'');
                $pdf->SetXY(130,70+2*$x);
                $pdf->Cell(100,10,"$/. ".number_format($val3,2),0,0,'');

                /*
                //IGV
                $pdf->SetXY(85,73+3*$x);
                $pdf->Cell(100,10,"IGV (18%)",0,0,'');
                $pdf->SetXY(130,73+3*$x);
                $pdf->Cell(100,10,"$/. {$resIGV}",0,0,'');
                */

                break;
            case 'Comercial':
                # code...    
                
                if($consumo_dif<=20){
                    $val1=20*0.50;
                }else {
                    $val1=10;                    
                    $consumo_dif-=20;
                    $val2 = $consumo_dif*0.95;
                }
                $val1 = round($val1,1);
                $val2 = round($val2,1);

                $resIGV = ($val1+$val2)*0.18; $resIGV = round($resIGV,1);

                //primera fila de 
                $pdf->SetXY(85,64+0*$x);
                $pdf->Cell(100,10,"(De 0 a 20)m3 * $/. 0.50",0,0,'');
                $pdf->SetXY(130,64+0*$x);
                $pdf->Cell(100,10,"$/. ".number_format($val1,2),0,0,'');
                //segunda fila de 
                $pdf->SetXY(85,67+1*$x);
                $pdf->Cell(100,10,"(De 20 a mas)m3 * $/ 0.95",0,0,'');
                $pdf->SetXY(130,67+1*$x);
                $pdf->Cell(100,10,"$/. ".number_format($val2,2),0,0,'');
                
                /*
                //IGV
                $pdf->SetXY(85,70+2*$x);
                $pdf->Cell(100,10,"IGV (18%)",0,0,'');
                $pdf->SetXY(130,70+2*$x);
                $pdf->Cell(100,10,"$/. {$resIGV}",0,0,'');
                */

                break;
            case 'Estatal':
                # code...
                if($consumo_dif<=20){
                    $val1=20*0.60;
                }else {
                    $val1=12;                    
                    $consumo_dif-=20;
                    $val2 = $consumo_dif*0.95;
                }
                $val1 = round($val1,1);
                $val2 = round($val2,1);

                $resIGV = ($val1+$val2)*0.18; $resIGV = round($resIGV,1);

                //primera fila de 
                $pdf->SetXY(85,64+0*$x);
                $pdf->Cell(100,10,"(De 0 a 20)m3 * $/. 0.60",0,0,'');
                $pdf->SetXY(130,64+0*$x);
                $pdf->Cell(100,10,"$/. ".number_format($val1,2),0,0,'');
                //segunda fila de 
                $pdf->SetXY(85,67+1*$x);
                $pdf->Cell(100,10,"(De 20 a mas)m3 * $/ 0.95",0,0,'');
                $pdf->SetXY(130,67+1*$x);
                $pdf->Cell(100,10,"$/. ".number_format($val2,2),0,0,'');
                
                /*
                //IGV
                $pdf->SetXY(85,70+2*$x);
                $pdf->Cell(100,10,"IGV (18%)",0,0,'');
                $pdf->SetXY(130,70+2*$x);
                $pdf->Cell(100,10,"$/. {$resIGV}",0,0,'');
                */

                break;
            case 'Industrial':
                # code...
                $val1 = $consumo_dif * 2.00;
                
                $val1 = round($val1, 1);

                $resIGV = $val1 * 0.18; $resIGV = round($resIGV, 1);

                //primera fila de 
                $pdf->SetXY(85,64+0*$x);
                $pdf->Cell(100,10,"(De 0 a mas)m3 * $/. 2.00",0,0,'');
                $pdf->SetXY(130,64+0*$x);
                $pdf->Cell(100,10,"$/. ".number_format($val1,2),0,0,'');                

                
                /*
                //IGV
                $pdf->SetXY(85,67+1*$x);
                $pdf->Cell(100,10,"IGV (18%)",0,0,'');
                $pdf->SetXY(130,67+1*$x);
                $pdf->Cell(100,10,"$/. {$resIGV}",0,0,'');
                */

                break;
            case 'Mantenimiento':
                # code...
                $val1 = 2.11;
                
                $val1 = round($val1, 1);

                $resIGV = $val1 * 0.18; $resIGV = round($resIGV, 1);

                //primera fila de 
                $pdf->SetXY(85,64+0*$x);
                $pdf->Cell(100,10,"Por mantenimiento",0,0,'');
                $pdf->SetXY(130,64+0*$x);
                $pdf->Cell(100,10,"$/. ".number_format($val1,2),0,0,'');
                
                
                /* 
                //IGV
                $pdf->SetXY(85,67+1*$x);
                $pdf->Cell(100,10,"IGV (18%)",0,0,'');
                $pdf->SetXY(130,67+1*$x);
                $pdf->Cell(100,10,"$/ {$resIGV}",0,0,'');
                */

                break;
            
            default:
                # code...
                break;
        }
        $subT = ($val1+$val2+$val3);
        return ['subt'=>$subT,'igvt'=>$resIGV];
        
    }

