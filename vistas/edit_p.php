<?php
$id = $_GET['id'];
$res = sprintf("SELECT * FROM firmas WHERE id='%s'",$id);
$resu = mysql_query($res);
$datos = mysql_fetch_array($resu);
if(isset($_GET['editar'])) {
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
    $resource = sprintf("UPDATE firmas SET Nombre='%s', Correo='%s', ci='%s', valor='%s' WHERE id='%s'",$nombre,$correo,$ci,$valor,$id);
    mysql_query($resource);
    header("Location: ./index.php");   
}
?>
        <form action="?vista=edit_p&id=<?php echo $id; ?>&editar" method="POST" role="form">
            <legend>Nueva Persona</legend>
            
            <div class="form-group">
                <label for="">Nombre:</label>
                <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Su nombre y apellido" value="<?php echo $datos['Nombre']; ?>">
            </div>
            <div class="form-group">
                <label for="">Correo Electronico:</label>
                <input type="text" class="form-control" id="Correo" name="Correo" placeholder="Su Correo Electronico" value="<?php echo $datos['Correo']; ?>">
            </div>
            <div class="form-group">
                <label for="">Documento de Identificacion:</label>
                <input type="text" class="form-control" id="ci" name="ci" placeholder="Ingrese el Numero" value="<?php echo $datos['ci']; ?>">
            </div>
            <div class="form-group">
                <label for="">Valor:</label>
                <input type="text" class="form-control" id="valor" name="valor" placeholder="Ingrese el Monto" value="<?php echo $datos['valor']; ?>">
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
            
        
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>