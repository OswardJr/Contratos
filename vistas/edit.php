<?php
$id = $_GET['id'];
$res = sprintf("SELECT * FROM contratos WHERE id='%s'",$id);
$resu = mysql_query($res);
$datos = mysql_fetch_array($resu);
if(isset($_GET['editar'])) {
    $titulo = $_POST['titulo'];
    $contrato2 = $_POST['contrato'];
    $contrato = str_replace("\n", "<br>", $contrato2);    
    $session_id = $_SESSION['id'];
    $resource = sprintf("UPDATE contratos SET contrato='%s', title='%s' WHERE id='%s'",$contrato,$titulo,$id);
    mysql_query($resource);
    header("Location: ./index.php");   
}
?>

        <form action="?vista=edit&id=<?php echo $id; ?>&editar" method="POST" role="form">
            <legend>Editar Contrato</legend>
            <p>Para determinar los datos de la Persona que firma el siguiente contrato recuerde implementar las siguientes variables: <bold style="font-weight:bolder;">%nombre%, %correo%, %identificacion%, %fecha%, %valor%, %plan% <bold></p>

            <div class="form-group">
                <label for="">Titulo del Contrato</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" value="<?php echo $datos['title']; ?>">
            </div>

            <div class="form-group">
                <label for="">Contrato</label>
                <textarea name="contrato" id="input${1/(\w+)/\u\1/g}" class="form-control" rows="20" required="required"><?php echo $datos['contrato']; ?></textarea>
            </div>        

            <button type="submit" class="btn btn-primary">Añadir</button>

        </form>
