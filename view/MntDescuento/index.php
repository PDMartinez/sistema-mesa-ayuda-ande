
<?php

  require_once("../../config/conexion.php");

  if(isset($_SESSION["usu_id"])){ 

?>
<!DOCTYPE html>
<html>

    <?php require_once("../MainHead/head.php");?>

	<title>Sistema de Ayuda::Descuento por Tarifa</title>
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
							<h3>Mantenimiento de Descuento por Tarifa</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Mantenimiento de Descuento por Tarifa</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">

				<button type="button" id="btnnuevo" class="btn btn-inline btn-primary">Nuevo Registro</button>

				<table id="descuento_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">

					<thead>

						<tr>
							<th style="width: 20%;">Tarifa</th>
							<th style="width: 10%;">Desde</th>
							<th style="width: 10%;">Hasta</th>
							<th style="width: 10%;">Descuento</th>
							<th style="width: 10%;">Fecha Reg.</th>
							<th class="d-none d-sm-table-cell" style="width: 10%;">Estado</th>
							<th class="text-center" style="width: 2%;"></th>
							<th class="text-center" style="width: 2%;"></th>
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
	
	<script type="text/javascript" src="mntDescuento.js"></script>

</body>
</html>
<?php
  } else {
    header("Location:".Conectar::ruta()."index.php");
  }
?>