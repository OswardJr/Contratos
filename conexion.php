<?php

$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
$latitud = $meta['geoplugin_latitude'];
$longitud = $meta['geoplugin_longitude'];
$ciudad = $meta['geoplugin_city'];

$enlace = mysql_connect('localhost', 'efiempre_c', 'tV5h+Xa5qXI6');
if (!$enlace) {
    die('No se pudo conectar : ' . mysql_error());
}

// Hacer que foo sea la base de datos actual
$bd_seleccionada = mysql_select_db('efiempre_c', $enlace);
if (!$bd_seleccionada) {
    die ('No se puede usar foo : ' . mysql_error());
}
session_start();
?>