<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo COMPANY; ?></title>
	<?php require_once "./views/sections/links.php"; ?>
	<style>
		/*BTN CERRAR Y ABRIR SLIDER*/
		.btn-slider-xd{
			position:fixed;			
			top:0px;			
			z-index:1000;			
			height:50px;
			width:45px;
			background:orange;					
			border-radius:0 50px 50px 0;				
			padding-top:2px;
		}
		.btn-slider-xd a{								
			color:white;			
			height:50px;
			width:45px;			
			display:block;
			text-decoration:none;			
			background: url("http://www.certificacionpm.com/wp-content/uploads/2019/04/punta-de-flecha-a-la-derecha.png");
			background-repeat: no-repeat;
			background-size: 40px 45px ;
		}
	</style>
</head>
<body>
	
	<?php
		$AjaxRequest=false;

		$tp = new viewsController(); 
		$response = $tp->getViewsController();

		if($response=="login" || $response=="404"){
			require_once "./views/modules/".$response."-view.php";
		}else{
			session_start(['name'=>'ASUSAP']);

			/*----------  Check Access  ----------*/
            require_once "./controllers/loginController.php";
            $sc = new loginController();
            if(!isset($_SESSION['user_token_srce']) || !isset($_SESSION['user_name_srce'])){
            	echo $sc->force_close_session_controller();	
            }
	?>
	<!-- SideBar -->
	<?php require_once "./views/sections/sideBar.php"; ?>

	<!-- Content page-->
	<section class="full-box dashboard-contentPage">
		<!-- NavBar -->
		<?php require_once "./views/sections/navBar.php"; ?>
		
		<!--BTN CERRAR/ABRIR SLIDER-->
		<div class="btn-slider-xd" id="btn-slider-xd">
			<a href="#!" class="btn-menu-dashboard"></a>
		</div>

		<!-- Content -->
		<?php 
			require_once $response;
		?>
	</section>
	<?php 
			//Notifications area
			//require_once "./views/sections/notificationArea.php";

			// Modal help
			require_once "./views/sections/modalHelp.php";

			//Scripts JS 
			require_once "./views/sections/scriptLogOut.php"; 
		}
	?>
	<script>
		$.material.init();
	</script>

</body>
</html>