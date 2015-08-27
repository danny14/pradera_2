<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view;?>
<?php use mvc\session\sessionClass as session;?>
<?php $cantidad_leche = ordennoTableClass::CANTIDAD_LECHE?>
<?php $nombre = animalTableClass::NOMBRE?>
<pre><?php print_r($arrayDatos);?></pre>
<pre><?php echo json_encode($arrayDatos);?></pre>
<script class="code" type="text/javascript">
$(document).ready(function(){
  var line1=[['2008-08-12 4:00PM',4], ['2008-09-12 4:00PM',6.5], ['2008-10-12 4:00PM',5.7], ['2008-11-12 4:00PM',9], ['2008-12-12 4:00PM',8.2],['2008-12-12 4:00PM',8.2],['2008-12-12 4:00PM',8.2],['2008-12-12 4:00PM',8.2]];
  var plot1 = $.jqplot('chart1', [line1], {
    title:'Default Date Axis',
    axes:{
        xaxis:{
            renderer:$.jqplot.DateAxisRenderer,
            min:'<?php echo json_encode($fecha_inicio)?>',
            max:'<?php echo json_encode($fecha_fin)?>',
            tickInterval: "8 days",
        },
    },
    series:[{lineWidth:4, markerOptions:{style:'circle'}}]
  });
});
</script>
<div id="chart1" style="width:500px;height:300px ;"></div>
       



