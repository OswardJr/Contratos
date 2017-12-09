    <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Sistema de Gestion de Contratos</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a style="color:#FFF!important;">Conectado como <?php $resource = sprintf("SELECT * FROM admin WHERE id='%s'",$_SESSION['id']); $result = mysql_query($resource); $data = mysql_fetch_array($result); echo "<bold style='font-weight:bolder;'>".$data['nombre']."</bold>"; ?></a></li>
                    <li><a href="?vista=cierre"><i class="fa fa-sign-out"></i> Cerrar Sesion</a></li>
                </ul>
            </div>
        </div>
        <!-- /container -->
    </div>