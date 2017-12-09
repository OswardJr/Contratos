<?php

require './PHPMailer/PHPMailerAutoload.php';

include("conexion.php");
$id = $_GET['id'];
$resourceA = sprintf("SELECT * FROM firmas WHERE id='%s'",$id);
$resultA = mysql_query($resourceA);
$argA = mysql_fetch_array($resultA);


$mail = new PHPMailer(true);
try {
    $mail-> charSet = "UTF8";
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'efiempresa.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'contratos@efiempresa.com';
    $mail->Password = '*hp#C^z}M6+}';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('contratos@efiempresa.com', 'Administracion');
    $mail->addAddress($argA['Correo'],$argA['Nombre']);
    $mail->addReplyTo('contratos@efiempresa.com', 'Administracion');

    $bd = sprintf("<p style='text-align:justify;'>Buen día,<br/>Es grato para nosotros comunicarnos con usted<br/>De acuerdo a lo solicitado, le estamos remitiendo el Contrato celebrado con  EFIEMPRESA S.A.S.<br/>Si desea puede revisarlo, es necesario que nos haga llegar su firma en el contrato para poder hacer los trámites legales con la empresa.<br/>Para ello <a href='http://%s/contratos/firmar.php?id=%s&u_id=%s'>Haga Clic Aqui</a><br/>Esperamos que esta información sea de su interés y poder contar con su presencia en nuestro selecto equipo de trabajo.<br/>Cualquier información adicional que requiera, no dude en contactarnos por este mismo medio o vía telefónica donde gustosamente le atenderemos.<br/>Saludos cordiales</p>",$_SERVER['HTTP_HOST'],$argA['id_contrato'],$argA['id']);

    $mail->isHTML(true);
    $mail->Subject = 'Firma de Contrato';
    $mail->Body    = $bd;
    $mail->AltBody = $bd;

    $mail->send();
    echo 'Solicitud Enviada';
} catch (Exception $e) {
    echo 'Solicitud no Enviada';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>