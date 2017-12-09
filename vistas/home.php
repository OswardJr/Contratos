<?php
$resource = sprintf("SELECT * FROM contratos");
$result = mysql_query($resource);
?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th style="text-align:center!important;">Nombre de Contrato</th>
                <th style="text-align:center!important;">Editar Contrato</th>
                <th style="text-align:center!important;">Ver Personas Subscritas</th>
                <th style="text-align:center!important;">Añadir Nuevas Personas</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysql_fetch_array($result)){ ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td align="center"><a href="<?php echo "./index.php?vista=edit&id=".$row['id'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                <td align="center"><a href="<?php echo "./index.php?vista=ver_p&id=".$row['id'] ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                <td align="center"><a href="<?php echo "./index.php?vista=add_p&id=".$row['id'] ?>" target="_blank"><i class="fa fa-plus" aria-hidden="true"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>