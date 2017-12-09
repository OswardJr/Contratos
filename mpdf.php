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
?>
<?php
        $nombre = $argA['Nombre'];
        $correo = $argA['Correo'];
        $identificacion = $argA['ci'];
        $valor = $argA['valor'];
        $plan = $argA['plan'];
        $fecha = date("Y-m-d H:i");
        $contrato = $arg['contrato'];
        $contrato_id = $arg['id'];
        $titulo = $arg['title'];
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
<?php 
# Cargamos la librería dompdf.
require_once 'dompdf/dompdf_config.inc.php';


# Contenido HTML del documento que queremos generar en PDF.
$html='
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>'.$titulo.'</title>
</head>
<body>
<h2 style="text-align:center!important;">'.$titulo.'</h2>
<p style="text-align:justify;">'.$contrato_final3.'</p>

</body>
</html>';

# Instanciamos un objeto de la clase DOMPDF.
$mipdf = new DOMPDF();

# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
$mipdf ->set_paper("A4", "portrait");

# Cargamos el contenido HTML.
$mipdf ->load_html(utf8_encode($html));

# Renderizamos el documento PDF.
$mipdf ->render();

# Enviamos el fichero PDF al navegador.
# $mipdf ->stream($nombre.'_'.$fecha.'.pdf');
$pdf = $mipdf->output();
$nombre_archivo = sprintf("contratos/%s-%s.pdf",$nombre,$contrato_id);
file_put_contents($nombre_archivo, $pdf);
?>