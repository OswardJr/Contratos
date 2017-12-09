<?
function returnMacAddress() {
// This code is under the GNU Public Licence
// Written by michael_stankiewicz {don't spam} at yahoo {no spam} dot com
// Tested only on linux, please report bugs

// WARNING: the commands 'which' and 'arp' should be executable
// by the apache user; on most linux boxes the default configuration
// should work fine

// Get the arp executable path
$location = `which arp`;
// Execute the arp command and store the output in $arpTable
$arpTable = `$location`;
// Split the output so every line is an entry of the $arpSplitted array
$arpSplitted = split("\\n",$arpTable);
// Get the remote ip address (the ip address of the client, the browser)
$remoteIp = $GLOBALS['REMOTE_ADDR'];
// Cicle the array to find the match with the remote ip address
foreach ($arpSplitted as $value) {
         // Split every arp line, this is done in case the format of the arp
         // command output is a bit different than expected
       $valueSplitted = split(" ",$value);
       foreach ($valueSplitted as $spLine) {
           if (preg_match("/$remoteIp/",$spLine)) {
               $ipFound = true;
           }
 // The ip address has been found, now rescan all the string
// to get the mac address
if ($ipFound) {
      // Rescan all the string, in case the mac address, in the string
      // returned by arp, comes before the ip address
      // (you know, Murphy's laws)
         reset($valueSplitted);
      foreach ($valueSplitted as $spLine) {
          if (preg_match("/[0-9a-f][0-9a-f][:-]".
                 "[0-9a-f][0-9a-f][:-]".
                 "[0-9a-f][0-9a-f][:-]".
                  "[0-9a-f][0-9a-f][:-]".
                  "[0-9a-f][0-9a-f][:-]".
                 "[0-9a-f][0-9a-f]/i",$spLine)) {
              return $spLine;
             }
          }
     }
      $ipFound = false;
      }
     }
       return false;
    }
?>
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
        $mac = returnMacAddress();
        $ip = $argA['ip'];
        $ubicacion = $argA['ubication'];
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
<p style="text-align:justify;">'.$contrato_final3.'</p><br/>
<br/>
Nombre: '.$nombre.'<br/>
Correo: '.$correo.'<br/>
Fecha: '.$fecha.'<br/>
Identificacion: '.$identificacion.'<br/>
IP: '.$ip.'<br/>
MAC: '.$mac.'<br/>
Ubicacion: '.$ubicacion.'<br/>
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
$nombre_archivo = sprintf("%s.pdf",$contrato_id);
file_put_contents($nombre_archivo, $pdf);
sleep(5);
?>
<?php

require './PHPMailer/PHPMailerAutoload.php';
?>
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
        if($plan=="0"){
            $plan_f = "Basico";
        } elseif($plan=="1") {
            $plan_f = "Tecnico";
        } elseif($plan=="2") {
            $plan_f = "Profesional";
        }
        
        ?>
        <?php
            $filtro_uno = str_replace('%nombre%',$nombre,$contrato);
            $filtro_dos = str_replace('%correo%',$correo,$filtro_uno);
            $filtro_tres = str_replace('%identificacion%',$identificacion,$filtro_dos);
            $contrato_final = str_replace('%fecha%',$fecha,$filtro_tres);
            $contrato_final2 = str_replace('%valor%',$valor,$contrato_final);
            $contrato_final3 = str_replace('%plan%',$plan_f,$contrato_final2);
            
        ?>
<?php
    
    $mail = new PHPMailer(true);
    try {
    
    $mail-> charSet = "UTF8";
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.yandex.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contratos@efiempresa.com';
    $mail->Password = 'Efiempresa123@';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    
        $mail->setFrom('contratos@efiempresa.com', 'Administracion');
        $mail->addAddress($correo,$nombre);
        $mail->addReplyTo('contratos@efiempresa.com', 'Administracion');
    
        $mail->isHTML(true);
        $mail->Subject = 'Contrato Firmado';
        $mail->Body    = "<p style='text-align:justify;'>En señal de expresa conformidad y aceptación de los términos recogidos en el presente
Acuerdo, lo firman las partes por duplicado ejemplar y a un solo efecto en el lugar y fecha al
comienzo indicados.</p>";
        $mail->AltBody = "<p style='text-align:justify;'>En señal de expresa conformidad y aceptación de los términos recogidos en el presente
Acuerdo, lo firman las partes por duplicado ejemplar y a un solo efecto en el lugar y fecha al
comienzo indicados.</p>";
        $mail->addAttachment($nombre_archivo,"contrato.pdf");
    
        $mail->send();
        echo 'Copias Enviadas';
    } catch (Exception $e) {
        echo 'Copias no Enviadas';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
?>