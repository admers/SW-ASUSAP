<section class="full-box cover dashboard-sideBar">
	<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
	<div class="full-box dashboard-sideBar-ct">
		<!--SideBar Title -->
		<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
			<?php echo COMPANY; ?> <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
		</div>
		<!-- SideBar User info -->
		<div class="full-box dashboard-sideBar-UserInfo">
			<figure class="full-box">
				<img src="<?php echo SERVERURL; ?>views/assets/avatars/asusap.jpg" alt="avatar">
				<figcaption class="text-center text-titles"><?php echo $_SESSION['user_name_srce']; ?></figcaption>
			</figure>
			<ul class="full-box list-unstyled text-center">
				<!-- Verificar el tipo de usuario-->

				<li>
					<a href="<?php echo $_SESSION['user_token_srce']; ?>" class="btn-exit-system"  title="Salir">
						<i class="zmdi zmdi-power"></i>
					</a>
				</li>
			</ul>
		</div>
		<!-- SideBar Menu -->
		<ul class="list-unstyled full-box dashboard-sideBar-Menu">
			<li>
				<a href="<?php echo SERVERURL; ?>dashboard/">
					<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> DASHBOARD
				</a>
			</li>
			<li>
				<a href="#!" class="btn-sideBar-SubMenu">
					<i class="zmdi zmdi-case zmdi-hc-fw"></i> GESTIÓN DE RECIBO <i class="zmdi zmdi-caret-down pull-right"></i>
				</a>
				<ul class="list-unstyled full-box">
					<li>
						<a href="<?php echo SERVERURL; ?>gconsumo/"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Generar consumo</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>erecibo/"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Emitir recibo</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>crecibo/"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Cobros recibo</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#!" class="btn-sideBar-SubMenu">
					<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> GESTIÓN SERVICIOS <i class="zmdi zmdi-caret-down pull-right"></i>
				</a>
				<ul class="list-unstyled full-box">
					<li>
						<a href="<?php echo SERVERURL; ?>generar_cosumo/"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Generar consumo</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>emitir_recibo/"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i> Emitir recibo</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>cobros_recibo/"><i class="zmdi zmdi-face zmdi-hc-fw"></i> Cobros recibo</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#!" class="btn-sideBar-SubMenu">
                    <i class="zmdi zmdi-account zmdi-hc-fw"></i>GESTIÓN DE SOCIOS <i class="zmdi zmdi-caret-down pull-right"></i>
				</a>
				<ul class="list-unstyled full-box">
					<li>
						<a href="<?php echo SERVERURL; ?>newaasociat/"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Agregar Asociado</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>payments/"><i class="zmdi zmdi-card zmdi-hc-fw"></i><i class="zmdi zmdi-money zmdi-hc-fw"></i> Periodos</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#!" class="btn-sideBar-SubMenu">
					<i class="zmdi zmdi-card zmdi-hc-fw"></i> REPORTES <i class="zmdi zmdi-caret-down pull-right"></i>
				</a>
				<ul class="list-unstyled full-box">
					<li>
						<a href="<?php echo SERVERURL; ?>registration/"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Inscripción</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>payments/"><i class="zmdi zmdi-money zmdi-hc-fw"></i> Periodos</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#!" class="btn-sideBar-SubMenu">
					<i class="zmdi zmdi-shield-security zmdi-hc-fw"></i> OTROS <i class="zmdi zmdi-caret-down pull-right"></i>
				</a>
				<ul class="list-unstyled full-box">
					<li>
						<a href="<?php echo SERVERURL; ?>year/"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i> Nuevo año escolar</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>institution/"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Datos institución</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</section>