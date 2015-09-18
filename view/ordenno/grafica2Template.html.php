<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view;?>
<?php use mvc\session\sessionClass as session;?>
<?php $cantidad_leche = ordennoTableClass::CANTIDAD_LECHE?>
<?php $nombre = animalTableClass::NOMBRE?>
<pre><?php print_r($arrayDatos);?></pre>
<pre><?php echo json_encode($arrayDatos);?></pre>
<pre><?php echo json_encode($arrayDatos2);?></pre>
<pre><?php echo json_encode($arrayDatos3);?></pre>
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
       



