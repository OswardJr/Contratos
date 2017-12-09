<?php
if(isset($_GET['registrar'])) {
    $titulo = $_POST['titulo'];
    $contrato2 = $_POST['contrato'];
    $contrato = str_replace("\n", "<br>", $contrato2);    
    $session_id = $_SESSION['id'];
    $resource = sprintf("INSERT INTO `contratos` (`id`, `admin_id`, `contrato`, `title`) VALUES (NULL, '%s', '%s', '%s');",$session_id,$contrato,$titulo);
    mysql_query($resource);
    header("Location: ./index.php");   
}
?>

        <form action="?vista=nuevo&registrar" method="POST" role="form">
            <legend>Nuevo Contrato</legend>
            <p>Para determinar los datos de la Persona que firma el siguiente contrato recuerde implementar las siguientes variables: <bold style="font-weight:bolder;">%nombre%, %correo%, %identificacion%, %fecha%, %valor%, %plan% <bold></p>

            <div class="form-group">
                <label for="">Titulo del Contrato</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo">
            </div>

            <div class="form-group">
                <label for="">Contrato</label>
                <textarea name="contrato" id="input${1/(\w+)/\u\1/g}" class="form-control" rows="20" required="required"></textarea>
            </div>        

            <button type="submit" class="btn btn-primary">Añadir</button>

        </form>
