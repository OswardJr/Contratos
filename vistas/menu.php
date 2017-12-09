        <ul class="nav nav-pills nav-stacked" style="border-right:1px solid black">
            <!--<li class="nav-header"></li>-->
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <?php if($_SESSION['nivel']=="0") { ?>
            <li><a href="index.php?vista=nuevo"><i class="fa fa-tags"></i> Nuevo Contrato</a></li>
            <?php } ?>
    
        </ul>