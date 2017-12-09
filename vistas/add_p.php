<?php
$id = $_GET['id'];
if(isset($_GET['registrar'])) {
    $nombre = $_POST['Nombre'];
    $correo = $_POST['Correo'];
    $ci = $_POST['ci'];
    $date = $_POST['date'];
    $ip = $_POST['ip'];
    $ubication = $_POST['ubication'];
    $firmado = $_POST['firmado'];
    $valor = $_POST['valor'];
    $plan = $_POST['plan'];
    $session_id = $_SESSION['id'];
    $resource = sprintf("INSERT INTO `firmas` (`id`, `id_contrato`, `Nombre`, `Correo`, `ci`,`date`, `ip`, `ubication`, `firmado`, `valor`, `plan` ,`admin_id`) VALUES (NULL, '%s', '%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s');",$id,$nombre,$correo,$ci,$date,$ip,$ubication,$firmado,$valor,$plan,$session_id);
    mysql_query($resource);
    header("Location: ./index.php");   
}
?>
        <form action="?vista=add_p&id=<?php echo $id; ?>&registrar" method="POST" role="form">
            <legend>Nueva Persona</legend>
            
            <div class="form-group">
                <label for="">Nombre:</label>
                <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Su nombre y apellido">
            </div>
            <div class="form-group">
                <label for="">Correo Electronico:</label>
                <input type="text" class="form-control" id="Correo" name="Correo" placeholder="Su Correo Electronico">
            </div>
            <div class="form-group">
                <label for="">Documento de Identificacion:</label>
                <input type="text" class="form-control" id="ci" name="ci" placeholder="Ingrese el Numero">
            </div>
            <div class="form-group">
                <label for="">Valor:</label>
                <input type="text" class="form-control" id="valor" name="valor" placeholder="Ingrese el Monto">
            </div>
            <div class="form-group">
                <label for="">Plan:</label>
                <select name="plan" id="plan" class="form-control" required="required">
                    <option value="0">Basico</option>
                    <option value="1">Tecníco</option>
                    <option value="2">Profesional</option>
                    
                </select>
                
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d H:i"); ?>">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="ip" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="ubication" name="ubication" value="<?php $meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));$latitud = $meta['geoplugin_latitude'];$longitud = $meta['geoplugin_longitude'];$ciudad = $meta['geoplugin_city']; echo $ciudad; ?>">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="firmado" name="firmado" value="0">
            </div>
            
        
            <button type="submit" class="btn btn-primary">Añadir</button>
        </form>