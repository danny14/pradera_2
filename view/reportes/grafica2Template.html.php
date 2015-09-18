<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view; ?>
<?php use mvc\config\myConfigClass as config?>
<?php use mvc\request\requestClass as request?>
<?php use mvc\session\sessionClass as session?>
<?php $cantidad_leche = ordennoTableClass::CANTIDAD_LECHE?>
<?php $nombre = animalTableClass::NOMBRE?>
<?php $id_animal = ordennoTableClass::ID_ANIMAL?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <div class="row">
    <div class="page page-header text-center">
    <h1><?php echo i18n::__('date')?></h1>
    <h2><?php echo $fecha_inicio.' HASTA '.$fecha_fin?></h2>
    </div>
<script class="code" type="text/javascript">
$(document).ready(function(){
  var texto = ["Cantidad Leche"];
  var line1= <?php echo json_encode($grafica) ?>;
  var plot1 = $.jqplot('chart1', [line1], {
    title:'Grafica XD Intento',
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            min:'<?php echo json_encode($fecha_inicio)?>',
            max:'<?php echo json_encode($fecha_fin)?>',
            tickInterval: "8 days",
        },
    },
    series:[{lineWidth:4, markerOptions:{style:'circle'}}],
    legend:{show:true,labels: texto,}//rendererOptions:{numberRows: 1, placement: "outside"}}
  });
});
</script>
<div id="chart1" style="width:800px;height:300px ;"></div>
    </div>
</div>