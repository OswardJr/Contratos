<?php include("conexion.php"); ?>
<?php if(isset($_SESSION['id'])) {
} else {
    header("Location: ./login.php");    
}
?>
<?php
$resource = sprintf("SELECT * FROM contratos");
$result = mysql_query($resource);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Gestion de Contratos | Tablero</title>

        <!-- Bootstrap CSS -->
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="/css/style.css">
        
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <style>
    f {
        font-weight:bolder;
    }
    </style>
    <body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    
    <?php include("vistas/topmenu.php"); ?>

    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
    
    <?php include("vistas/menu.php"); ?>

    </div>
    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
    <?php
                if(isset($_GET['vista'])) {
                    $vista = $_GET['vista'];
                    include("vistas/".$vista.".php");
                } else {
                    include("vistas/home.php");
                }
    ?>
    </div>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script src="/js/style.js"></script>

        <script>
                    $(function() {
                        $('#Check').click(function() {
                            if ($(this).is(':checked')) {
                                $('#Send').removeAttr('disabled');
                            } else {
                                $('#Send').attr('disabled', 'disabled');
                            }
                        });
                    });
        </script>
    </body>
</html>
