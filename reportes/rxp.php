<?php
    //Permite incluir los archivos necesarios para las funciones de consulta.
    $AjaxRequest=true;

    require_once "../controllers/adminController.php";
    require "fpdf/fpdf.php";

    $cod_sum = $_GET['codigoSum'];
    $anio = $_GET['anio'];
    $mes = $_GET['mes'];

    $dataObj = new adminController();
    $arrData = $dataObj->recibosObtenerDataSumXCod($cod_sum,$anio,$mes);
    $fechaL = $dataObj->obtenerNombrefecha($anio,$mes);
    $mesLit = $fechaL['r_mes'];
    //var_dump($arrData['data']->fetch());

    $_POST['urlimg'] = $arrData['res']?'img/reciboAgua.jpg':'img/sinResultado.jpg';

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial','B',20);
        $this->SetXY(5,7);
        $this->Cell(30,12,'ASUSAP',0,0,'C');
        $this->Ln(20);
    }
    function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
    }
}

    //pdf
    $pdf = new PDF('P','mm','A5');

    if(!$arrData['res']){
        $pdf->AddPage();    
        $pdf->Image($_POST['urlimg'] ,0,0,148,210);

        $pdf->SetFont('Arial','B',20);
        $pdf->SetXY(5,7);
        $pdf->Cell(30,12,'ASUSAP',0,0,'C');

        $pdf->SetFont('Arial','B',8);
        $pdf->SetXY(21,4.5);
        $pdf->Cell(100,10,"REGISTRO VACIO PARA {$mesLit} del {$anio}",0,0,'C');
    }else{
        $dataQuery = $arrData['data'];
        header('Content-Type: text/html; charset=UTF-8');
        while($element = $dataQuery->fetch(PDO::FETCH_ASSOC)){   

            $esta_cancelado = $element['esta_cancelado']?'RECIBO CANCELADO':'FALTA PAGAR RECIBO';
            
            
        //verifica que sea una institución para solo imprimir el nombre        
        $_POST['urlimg'] = $element['estado_corte']?'img/corte.jpg':'img/reciboAgua.jpg';

        //recuperar los meses de las deudas anteriores
        $deudasMes = $dataObj->consultaDeudasMes($element['cod_suministro']);


            $medidor = $element['tiene_medidor']?'Si':'No';    
            $cortado = $element['estado_corte']?'Si':'No';
            $nombre_completo = $element['categoria_suministro']=='Estatal'?utf8_decode($element['nombre']):utf8_decode($element['apellido']." ".$element['nombre']); 
            $msjCorte = ($element['contador_deuda']>=2)?'EN CORTE':'no está en corte';

            $pdf->AddPage();    
            $pdf->Image($_POST['urlimg'] ,0,0,148,210);
            
            $pdf->SetFont('Arial','B',20);
            $pdf->SetXY(5,7);
            $pdf->Cell(30,12,'ASUSAP',0,0,'C');

            $pdf->SetFont('Arial','B',7);        
            //fecha seleccionado para el recibo 
            $pdf->SetXY(5,12);
            $pdf->Cell(30,12,"{$mesLit} del {$anio}",0,0,'C');

            $pdf->SetXY(57,7);
            $pdf->Cell(60,5,"$nombre_completo",0,0,'');//
            $pdf->SetXY(57,8);
            $pdf->Cell(60,10,$element['direccion'],0,0,'');
        
            $pdf->SetXY(27,95);
            $pdf->Cell(100,10,$esta_cancelado,0,0,'C');
            $pdf->SetXY(27,100);
            $pdf->Cell(100,10,$element['monto_pagar'],0,0,'C');
            $pdf->SetXY(27,105);
            $pdf->Cell(100,10,$element['cod_suministro'],0,0,'C');
            $pdf->SetXY(27,110);
            $pdf->Cell(100,10,$element['categoria_suministro'],0,0,'C');
            $pdf->SetXY(27,115);
            $pdf->Cell(100,10,"Tiene medidor:".$medidor,0,0,'C');
            $pdf->SetXY(10,99);
            $pdf->Cell(100,5,"Cantidad deudas: {$element['contador_deuda']}",0,0,'');

        //Imprime los meses endeudados
        $pdf->SetXY(10,104);     
        foreach ($deudasMes as $value) {
            # code...
            $nombreMes =  $dataObj->obtenerNombrefecha($value['anio'],$value['mes']);
            $pdf->SetX(10);
            $pdf->Cell(30,3,$nombreMes['r_mes']." del ".$nombreMes['r_anio'],1,0,'');
            $pdf->ln();
        }   

            $pdf->SetXY(10,150);
            $pdf->Cell(0,10,utf8_decode($msjCorte),0,0,'');

        }        
    }
    
    $pdf->Output();
