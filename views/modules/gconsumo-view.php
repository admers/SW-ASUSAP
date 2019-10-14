<?php
    /** 
     * ----LA TABLA gconsumo (SE ACTUALIZA CUANDO SE GENERÓ RECIBO PARA ESE MES QUE SE ESTÁ ACTUALIZANDO).
     * ----funciones para modulo gestion de consumo 
     * Si el mes es diferente => 
     * evaluar (gc_con_medidor = true && gc_sin_medidor = true) =>
     * Actualizar Tabla 'estado_mes_recibo' con: mes, año actual y con_medidor=false && sin_medidor=false
     * 
     * si el mes es igual => //Se dió inicio para que se generen los consumos
     * evaluar (gc_sin_medidor && consumo_con_medidor) => Mostrar página alternativo de "YA SE REGISTRO PARA ESTE MES"
     * evaluar (gc_sin_medidor = true ) => ya no se muestra btn para generar cosumo x defect
     */
    require_once "controllers/adminController.php";

    $fechas = new adminController();

    $fecha_db = $fechas->consultar_stado_gconsumo();
    $fecha_hoy = $fechas->consultar_fecha_actual();
    
    if($fecha_hoy['mes'] == $fecha_db['mes']){
        //habilitar el inicio de generacion de consumos        
        if($fecha_db['gsn_consumo'] == 1 && $fecha_db['gcn_consumo'] == 1){
            //include de la PAGINA DE que YA SE GENERO PARA el MES!!";
            $fechaGenerado = $fecha_hoy['mes']-1;
            $FechLiteral = $fechas->obtenerNombrefecha($fecha_hoy['anio'],$fechaGenerado);
            $fechaGenerado = $FechLiteral['r_mes'];
            $anioGenerado = $FechLiteral['r_anio'];
            
            $btn_habilitarConsumo = false;
            include ("gconsumoL.php");
        }else{
            $btn_xdefct = false;
            $tabla_consumo = false;
            $FechaGConsumo = $fecha_hoy['mes']-1;//mes anterior
            $FechaGConsumoNum = $fecha_hoy['mes']-1;
            $FechLiteral = $fechas->obtenerNombrefecha($fecha_hoy['anio'],$FechaGConsumo);
            $FechaGConsumo=$FechLiteral['r_mes'];

            if($fecha_db['gsn_consumo'] == 0){
                $btn_xdefct = true; //habilita el btn de consumo x defecto
            }
            if($fecha_db['gcn_consumo'] == 0){            
                $tabla_consumo = true; // habilita la tabla de agregar consumo por suministro
            }
            
            //echo "<br> INCLUDE 'resultado página para generar cosumo'";
            include ("gconsumoH.php");
            
        }            

    }else{
        //verifcar si ya se genero CONSUMO tanto para los que tiene medidor como no, para los smi del mes anteriror
        echo "<br> Actualizar las FECHAS";
        echo "<br> MOSTRAR BTN : Habilitar MES <name_month>";
        echo "<br> No coinciden las FECHAS";
        $pagos_mes_anterior = true; // Se canceló todos los recibos?? 
        $generado_consumos_anterior = true; //se genero para todos el consumo del mes anterior??

        $fechaGenerado = date('n')-2;
        $FechLiteral = $fechas->obtenerNombrefecha($fecha_hoy['anio'],$fechaGenerado);
        $fechaGenerado = $FechLiteral['r_mes'];
        $anioGenerado = $FechLiteral['r_anio'];

        $fecha_btn_habCons = date('n')-1;
        $FechLiteral = $fechas->obtenerNombrefecha($fecha_hoy['anio'],$fecha_btn_habCons);
        $fecha_btn_habCons = $FechLiteral['r_mes'];
        $anio_btn_habCons = $FechLiteral['r_anio'];

        $btn_habilitarConsumo = true;
        //la actualización se hará a traves de un botón. Dandoles a conocer los pendientes del mes anterior
        include("gconsumoL.php");
    }