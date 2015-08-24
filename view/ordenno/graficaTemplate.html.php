<?php use mvc\session\sessionClass as session?>
<?php $cantidad_leche = ordennoTableClass::CANTIDAD_LECHE?>
<?php $nombre = animalTableClass::NOMBRE?>
<?php $fecha_inicio = session::getInstance()->getAttribute('fecha_inicio')?>
<?php $fecha_fin = session::getInstance()->getAttribute('fecha_fin')?>
<?php// foreach ($objGrafia as $grafica):?>
<br>
<div class="container container-fluid">
    <div class="row">
    <div class="page page-header text-center">
    <h1><?php echo i18n::__('date')?></h1>
    <h2><?php echo $fecha_inicio.' '.$fecha_fin?></h2>
    </div>
    <?php foreach ($objGrafica as $grafica):?>
        <div class="alert <?php echo ($grafica->$cantidad_leche > 10) ? 'alert-success' : 'alert-danger' ?>" role="alert">
    <table class="table table-bordered table-responsive table-striped alert-success" >
        
        <tr>
            <td rowspan="3" >Imagen de la Vaca</td>
            <td>Fecha: <?php echo $fecha_inicio ?> Asta <?php echo $fecha_fin?></td>
        </tr>
        <tr >
            <td>Nombre: <?php echo $grafica->$nombre?></td>
        </tr>
        <tr>
            <td>Cantidad: <?php echo $grafica->cantidad_leche?></td>
        </tr>    
    </table>
            </div>
    <?php endforeach;?>
    </div>
</div>
<?php// endforeach;?>
<div id="chartdiv" style="width:300px;height:500px ;"></div>
       



