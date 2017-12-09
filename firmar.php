<?php 
include("conexion.php"); 
error_reporting(0);
?>
<?php
$id = $_GET['id'];
$u_id = $_GET['u_id'];
/* Seleccion de Contrato */
$resource = sprintf("SELECT * FROM contratos WHERE id='%s'",$id);
$result = mysql_query($resource);
$arg = mysql_fetch_array($result);
/* Seleccion de Data */
$resourceA = sprintf("SELECT * FROM firmas WHERE id='%s' AND id_contrato='%s'",$u_id,$id);
$resultA = mysql_query($resourceA);
$argA = mysql_fetch_array($resultA);
/* Actualizacion de Data */

$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
$latitud = $meta['geoplugin_latitude'];
$longitud = $meta['geoplugin_longitude'];
$ciudad = $meta['geoplugin_city'];

if(isset($_GET['send'])) {
$resourceD = sprintf("UPDATE `firmas` SET `ubication` = '%s', `ip` = '%s', `date` = '%s', `firmado` = '1' WHERE `firmas`.`id` = '%s';",$cuidad,$_SERVER['REMOTE_ADDR'],date("Y-m-d H:i"),$u_id);
mysql_query($resourceD);
echo '<script>alert("Su contrato a sido firmado exitosamente.");</script>';
include("mpdf.php?id=".$id."&u_id=".$u_id);
}
$firmado = $argA['firmado'];
if($firmado=="1") {
    echo '<script>alert("El presente contrato ya se encuentra firmado");</script>';
    header('Location: http://google.com/'); 
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $arg['title']; ?></title>

        <!-- Bootstrap CSS -->
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
<div class="row" style="margin-top:3%!important;">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        $nombre = $argA['Nombre'];
        $correo = $argA['Correo'];
        $identificacion = $argA['ci'];
        $valor = $argA['valor'];
        $plan = $argA['plan'];
        $fecha = date("Y-m-d H:i");
        $contrato = $arg['contrato'];
        if($plan=="0"){
            $plan_f = "Basico";
        } elseif($plan=="1") {
            $plan_f = "Tecnico";
        } elseif($plan=="2") {
            $plan_f = "Profesional";
        }
        ?>
        <?php
            $filtro_uno = str_replace('%nombre%','<f>'.$nombre.'</f>',$contrato);
            $filtro_dos = str_replace('%correo%','<f>'.$correo.'</f>',$filtro_uno);
            $filtro_tres = str_replace('%identificacion%','<f>'.$identificacion.'</f>',$filtro_dos);
            $contrato_final = str_replace('%fecha%','<f>'.$fecha.'</f>',$filtro_tres);
            $contrato_final2 = str_replace('%valor%','<f>'.$valor.'</f>',$contrato_final);
            $contrato_final3 = str_replace('%plan%','<f>'.$plan_f.'</f>',$contrato_final2);
            
        ?>
    </div>
    
    <div class="col-md-3 col-lg-3">
        
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="row" style="border: solid #000 3px;margin-bottom:20px!important;padding:25px!important;">
        <div class="row" style="text-align:center!important;">
            <h1><?php echo $arg['title']; ?></h1>
        </div>
        
        <div class="row">
            <p style="text-align:justify;padding:20px!important;"><?php echo $contrato_final3; ?></p>
        </div>
        
        <div class="row" style="text-align:center;margin-bottom:25px!important;">
        <form action="?id=<?php echo $id; ?>&u_id=<?php echo $u_id; ?>&send" method="post">
            <label><input type="checkbox" value="1" style="margin-right:5px!important;" id="Check">Acepto los Terminos y Condiciones del Contrato</label><br/>
            <button type="submit" class="btn btn-default" style="margin-top:20px!important;" id="Send" disabled onclick="enviar();">Firmar Contrato</button>
        </form>         
        </div>
    </div>
    <div class="col-md-3 col-lg-3">
        
    </div>

</div>


        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        <script>
        function enviar() {        
        $.ajax({
                method: "GET",
                url: "confirmar.php?id=<?php echo $id; ?>&u_id=<?php echo $u_id; ?>"
        })
        .done(function( msg ) {
                  alert( msg );
        });
    }
        </script>
    </body>
</html>