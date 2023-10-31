<!DOCTYPE html>
<html>

<head lang="es">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sistema de Ayuda::Acceso</title>

    <link rel="stylesheet" href="../../public/css/lib/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="../../public/css/separate/vendor/sweet-alert-animations.min.css">

    <link href="img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
    <link href="img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
    <link href="img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
    <link href="img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
    <link href="img/favicon.png" rel="icon" type="image/png">
    <link href="img/favicon.ico" rel="shortcut icon">

    <link rel="stylesheet" href="../../public/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="../../public/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="../../public/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/main.css">
</head>
<body>

    <div class="page-center">
        <div class="page-center-in">
            <div class="container-fluid">

                <form class="sign-box" id="registrarse_form">

                    <div class="sign-avatar no-photo">&plus;</div>

                    <header class="sign-title">Registrarse</header>

                    <input type="hidden" name="rol_id" id="rol_id" value="1"><!-- Rol del Usuario-->
                    <input type="hidden" name="usu_id" id="usu_id" value="">

                    <div class="form-group">
                        <input type="text" class="form-control" id="usu_nom" name="usu_nom" placeholder="Nombre" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="usu_ape" name="usu_ape" placeholder="Apellido" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="usu_telf" name="usu_telf" placeholder="Telefono" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="usu_correo" name="usu_correo" placeholder="Usuario" required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" id="usu_pass" name="usu_pass" placeholder="Contraseña" required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" id="usu_passrep" name="usu_passrep" placeholder="Repetir Contraseña" required>
                    </div>

                    <button type="submit" class="btn btn-rounded btn-success sign-up">Registrar</button>
                    <p class="sign-note">¿Ya tienes una cuenta? <a href="../../index.php">Iniciar Sesión</a></p>

                </form>
            </div>
        </div>
    </div><!--.page-center-->

<script src="../../public/js/lib/jquery/jquery.min.js"></script>
<script src="../../public/js/lib/tether/tether.min.js"></script>
<script src="../../public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../../public/js/plugins.js"></script>
<script type="text/javascript" src="../../public/js/lib/match-height/jquery.matchHeight.min.js"></script>

    <script>
        $(function() {
            $('.page-center').matchHeight({
                target: $('html')
            });

            $(window).resize(function(){
                setTimeout(function(){
                    $('.page-center').matchHeight({ remove: true });
                    $('.page-center').matchHeight({
                        target: $('html')
                    });
                },100);
            });
        });
    </script>
<script src="../../public/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
<script src="../../public/js/app.js"></script>
<script type="text/javascript" src="registrarse.js"></script>
</body>
</html>