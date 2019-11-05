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
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {

        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

//function mainClass(){
//}
//mainClass();

//pdf
$pdf = new PDF('P','mm','A5');

if(!$resConsult['res']){
    //cUANDO NO HAY REGISTRO
    $pdf->AddPage();    
    $pdf->Image($_POST['urlimg'] ,0,0,148,210);

    $pdf->SetFont('Arial','B',20);
    $pdf->SetXY(5,7);
    $pdf->Cell(30,12,'ASUSAP',0,0,'C');

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(21,4.5);
    $pdf->Cell(100,10,"REGISTRO VACIO PARA {$mesLit} del {$selectAnio}",0,0,'C');

}else{
    //CUANDO HAY REGISTROS

    $dataQuery = $resConsult['data'];

    while($element = $dataQuery->fetch(PDO::FETCH_ASSOC)){

        $medidor = $element['tiene_medidor']?'Si':'No';    
        $cortado = $element['estado_corte']?'Si':'No';
        $esta_cancelado = $element['esta_cancelado']?'RECIBO CANCELADO':'FALTA PAGAR RECIBO';

        //verifica que sea una institución para solo imprimir el nombre
        $nombre_completo = ($element['categoria_suministro']=='Estatal')?utf8_decode($element['nombre']):utf8_decode($element['apellido']." ".$element['nombre']); 
        $_POST['urlimg'] = $element['estado_corte']?'img/corte.jpg':'img/reciboAgua.jpg';
        $msjCorte = ($element['contador_deuda']>=2)?'EN CORTE':'no está en corte';

        //recuperar los meses de las deudas anteriores
        $deudasMes = $objDirec->consultaDeudasMes($element['cod_suministro']);


        $pdf->AddPage();    
        $pdf->Image($_POST['urlimg'] ,0,0,148,210);

        $pdf->SetFont('Arial','B',20);
        $pdf->SetXY(5,7);
        $pdf->Cell(30,12,'ASUSAP',0,0,'C');
        
        $pdf->SetFont('Arial','B',7);        
        //fecha seleccionado para el recibo 
        $pdf->SetXY(5,12);
        $pdf->Cell(30,12,"{$mesLit} del {$selectAnio}",0,0,'C');

        $pdf->SetXY(57,7);
        $pdf->Cell(50,5,$nombre_completo ,0,0,'');
        $pdf->SetXY(57,10.4);
        $pdf->Cell(50,5,$selectDireccion,0,0,'');    

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
        $pdf->SetXY(10,103);        
        for ($i=0; $i < count($deudasMes); $i++) { 
            # code...
            $nombreMes =  $objDirec->obtenerNombrefecha($deudasMes[$i]['anio'],$deudasMes[$i]['mes']);
            $pdf->SetX(10);
            $pdf->Cell(30,3,$nombreMes['r_mes']." del ".$nombreMes['r_anio'],1,0,'');
            $pdf->ln();
        }

        $pdf->SetXY(10,150);
        $pdf->Cell(0,10,utf8_decode($msjCorte),0,0,'');
    }
    
}

$pdf->Output();
