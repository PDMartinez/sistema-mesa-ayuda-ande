
<?php

  require_once("../../config/conexion.php");

  if(isset($_SESSION["usu_id"])){ 

?>
<!DOCTYPE html>
<html>

    <?php require_once("../MainHead/head.php");?>

	<title>Sistema de Ayuda::Faja de Consumo</title>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

    <div class="mobile-menu-left-overlay"></div>
    
    <?php require_once("../MainNav/nav.php");?>

	<!-- Contenido -->
	<div class="page-content">
		<div class="container-fluid">
			<header class="section-header">
				<div class="tbl">
					<div class="tbl-row">
						<div class="tbl-cell">
							<h3>Mantenimiento de Consumo</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Mantenimiento de Consumo</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">

				<div class="row">

					<div class="col-lg-12">

						<button type="button" id="btnnuevo" class="btn btn-inline btn-primary">Nuevo Registro</button>

						<button type="button" id="btnVerEstadistica" class="btn btn-inline btn-warning float-right" onClick="verEstadistica(<?php echo $_SESSION["usu_id"] ?>)";>

							<i class="fa fa-bar-chart"></i>

								<font style="vertical-align: inherit;">
									Ver Estadística
								</font>

						</button>

					</div>

				</div>

				<table id="consumo_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">

					<thead>

						<tr>

							<th class="text-center" style="width: 2%;">#</th>
							<th class="text-center" style="width: 2%;"></th>
							<th class="text-center" style="width: 2%;"></th>
							<th style="width: 20%;">Tarifa</th>
							<!-- <th style="width: 30%;">Usuario</th> -->
							<th style="width: 5%;">Per. Inicial</th>
							<th style="width: 5%;">Per. Final</th>
							<th style="width: 5%;">Lec. Anterior</th>
							<th style="width: 5%;">Lec. Actual</th>
							<th style="width: 5%;">Consumo</th>
							<th style="width: 5%;">Precio kWh</th>
							<th style="width: 5%;">Desc</th>
							<th style="width: 5%;">Monto Desc.</th>
							<th style="width: 5%;">Total sin Desc</th>
							<th style="width: 5%;">Total con Desc</th>
							<th style="width: 5%;">Fecha Reg.</th>
							<!-- <th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th> -->
							
						</tr>

					</thead>

					<tbody>

					</tbody>

				</table>

			</div>

		</div>

	</div>
	<!-- Contenido -->

	<?php require_once("modalMantenimiento.php");?>

	<?php require_once("../MainJs/js.php");?>
	
	<script type="text/javascript" src="mntConsumo.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>