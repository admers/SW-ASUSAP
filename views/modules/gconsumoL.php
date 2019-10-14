
<!-- Este btn actualiza la tabla de los meses y años en la tabla 'estado_gconsumo'-->
<?php 
    if($btn_habilitarConsumo){    
?>
    <button id="btn_updGC" class="btn btn-danger btn-lg btn-block p-5 ">
        HABILITAR CONSUMO PARA MES <?php echo "$fecha_btn_habCons del año $anio_btn_habCons"; ?>
    </button>   
<?php } ?>

<h1 class="text-center"> YA SE GENERÓ EL CONSUMO PARA EL MES <?php echo "$fechaGenerado del año $anioGenerado";?></h1>
