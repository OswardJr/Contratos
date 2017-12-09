<?php include("conexion.php"); ?>
<?php
if(isset($_GET['start'])) {
    $usr = $_POST['mail'];
    $pw = $_POST['password'];
    $resource = sprintf("SELECT * FROM admin WHERE mail='%s' AND password='%s'",$usr,$pw);
    $result = mysql_query($resource);
    $nro = mysql_num_rows($result);
    $data = mysql_fetch_array($result);
    if($nro=="0") {
        echo "Usuario no existe";
    } elseif($nro=="1") {
        $_SESSION['id'] = $data['id'];
        $_SESSION['nivel'] = $data['nivel'];
        header("Location: ./index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Administracion</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="overflow: hidden;">

    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display:flex;height:40vh!important;padding-top:12vh;">
        
        <div class="col-md-4 col-lg-4">
            
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            
            <form action="?start" method="POST" role="form">
                <legend>Administracion</legend>
            
                <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control" id="mail" name="mail" placeholder="Nombre de Usuario">
                </div>

                <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                </div>
            
                
            
                <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
            </form>
            
        </div>
        
        <div class="col-md-4 col-lg-4">
            
        </div>
        </div>
    </div>
    

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    </body>
</html>
