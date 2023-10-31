<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
?>
  <!DOCTYPE html>
  <html>

  <?php require_once("../MainHead/head.php"); ?>

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

  <title>Sistema de Ayuda::Estadística</title>

  </head>

  <body class="with-side-menu">

    <?php require_once("../MainHeader/header.php"); ?>

    <div class="mobile-menu-left-overlay"></div>

    <?php require_once("../MainNav/nav.php"); ?>

    <!-- Contenido -->
    <div class="page-content">

      <div class="container-fluid">

        <header class="section-header">

          <div class="tbl">

            <div class="tbl-row">

              <div class="tbl-cell">

                <h3 id="lblnomidticket">Estadística de Consumo</h3>

                <div id="lblestado"></div>

                <span class="label label-pill label-primary" id="lblnomusuario"></span>
                <span class="label label-pill label-default" id="lblfechcrea"></span>

                <ol class="breadcrumb breadcrumb-simple">
                  <li><a href="#">Home</a></li>
                  <li class="active">Estadística de Consumo</li>
                </ol>

              </div>

            </div>

          </div>

        </header>


        <section class="card">

          <header class="card-header">
            Estadística de Consumo Mensual
          </header>

          <div class="card-block">
            <div id="graficoEstadistico" style="height: 250px;"></div>
          </div>

        </section>

        <section class="activity-line" id="lbldetalle">

        </section>

        <div class="box-typical box-typical-padding" id="pnldetalle">

          <div class="row">

              <div class="col-lg-12">

                <a href="..\MntConsumo\"><button type="button" id="btncerrarticket" class="btn btn-rounded btn-inline btn-warning">Cerrar</button></a>

              </div>

          </div>

			  </div>

      </div>

    </div>
    <!-- Contenido -->

    <?php require_once("../MainJs/js.php"); ?>

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript" src="estadistica.js"></script>

  </body>

  </html>
<?php
} else {
  header("Location:" . Conectar::ruta() . "index.php");
}
?>