<?php
$id = $_GET['id'];
$resource = sprintf("SELECT * FROM firmas WHERE id_contrato='%s'",$id);
$result = mysql_query($resource);
?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
            <?php while($row = mysql_fetch_array($result)){ ?>
                <th style="text-align:center!important;">Nombre</th>
                <th style="text-align:center!important;">Correo</th>
                <th style="text-align:center!important;">Identificacion</th>
                <th style="text-align:center!important;">Fecha de Firma</th>
                <th style="text-align:center!important;">Visualizar</th>
                <?php if($row['firmado']=="0") { ?><th style="text-align:center!important;">Editar Datos</th><?php } ?>
                <th style="text-align:center!important;">Firma</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center;"><?php echo $row['Nombre']; ?></td>
                <td style="text-align:center;"><?php echo $row['Correo']; ?></td>
                <td style="text-align:center;"><?php echo $row['ci']; ?></td>
                <td style="text-align:center;"><?php echo $row['date']; ?></td>
                <td style="text-align:center;"><a href="firmar.php?id=<?php echo $row['id_contrato']; ?>&u_id=<?php echo $row['id']; ?>"><i class="fa fa-link" aria-hidden="true"></i></a></td>
                <?php if($row['firmado']=="0") { ?><th style="text-align:center;"><a href="?vista=edit_p&id=<?php echo $row['id']; ?>"><i class="fa fa-edit" aria-hidden="true"></i></th></a><?php } ?>
                <td style="text-align:center;"><?php if($row['firmado']=="0") {
                    $firma = $row['id'];
                    echo "<button type='submit' class='btn btn-primary' onclick='enviar(".$firma.");'>Enviar Solicitud de Firma</button>";
                }elseif($row['firmado']=="1"){
                    echo "FIRMADO";
                } ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script>
    function enviar(nro) {        
        $.ajax({
          method: "GET",
          url: "mail.php?id="+nro
        })
        .done(function( msg ) {
            alert( msg );
        });
        }
</script>