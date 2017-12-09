<?php
$id = $_GET['id'];
$resource = sprintf("SELECT * FROM contratos WHERE id='%s'",$id);
$result = mysql_query($resource);
$arg = mysql_fetch_array($result);
?>
<div class="row" style="margin-top:3%!important;">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <legend>Vista Previa de Contrato</legend>

        <p>En el siguiente formato puede visualizar como se vera el contrato para el cliente y / o empleado que firme. <br/> <br/> Nombre: <x style="font-weight:bolder;">Pablo Escobar</x> <br/> E-Mail: <x style="font-weight:bolder;">pablitoescobar@gmail.com</x> <br/> Identificacion #: <x style="font-weight:bolder;">132156464</x> <br/> Fecha: <x style="font-weight:bolder;"><?php echo date("Y-m-d H:i"); ?></x> </p>
        <?php
        $nombre = "Pablo Escobar";
        $correo = "pablitoescobar@gmail.com";
        $identificacion = "132156464";
        $fecha = date("Y-m-d H:i");
        $contrato = $arg['contrato'];
        $valor = "300.000COL$";
        $plan = "Basico";
        ?>
        <?php
            $filtro_uno = str_replace('%nombre%','<f>'.$nombre.'</f>',$contrato);
            $filtro_dos = str_replace('%correo%','<f>'.$correo.'</f>',$filtro_uno);
            $filtro_tres = str_replace('%identificacion%','<f>'.$identificacion.'</f>',$filtro_dos);
            $contrato_final = str_replace('%fecha%','<f>'.$fecha.'</f>',$filtro_tres);
            $contrato_final2 = str_replace('%valor%','<f>'.$valor.'</f>',$contrato_final);
            $contrato_final3 = str_replace('%plan%','<f>'.$plan.'</f>',$contrato_final2);
        ?>
    </div>
    
    <div class="col-md-2 col-lg-2">
        
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="border: solid #000 3px;margin-bottom:20px!important;">
        
        <div class="row" style="text-align:center!important;">
            <h1><?php echo $arg['title']; ?></h1>
        </div>
        
        <div class="row">
            <p style="text-align:justify;padding:20px!important;"><?php echo $contrato_final3; ?></p>
        </div>
        
        <div class="row" style="text-align:center;margin-bottom:25px!important;">
            <label><input type="checkbox" value="1" style="margin-right:5px!important;" id="Check">Acepto los Terminos y Condiciones del Contrato</label><br/>
            <button type="button" class="btn btn-default" style="margin-top:20px!important;" disabled id="Send">Acepto</button>          
        </div>
    
    <div class="col-md-2 col-lg-2">
        
    </div>

</div>