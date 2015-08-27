<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view;?>
<?php use mvc\session\sessionClass as session;?>
<?php $cantidad_leche = ordennoTableClass::CANTIDAD_LECHE?>
<?php $nombre = animalTableClass::NOMBRE?>
<?php// foreach ($objGrafia as $grafica):?>
<br>
<div class="container container-fluid">
    <div class="row">
    <div class="page page-header text-center">
    <h1><?php echo i18n::__('date')?></h1>
    <h2><?php echo $fecha_inicio.' '.$fecha_fin?></h2>
    </div>
    
    <?php foreach ($objGrafica as $grafica):?>
        <a href="<?php// echo routing::getInstance()->getUrlWeb('ordenno', 'grafica2')?>">
        <div class="alert <?php echo ($grafica->$cantidad_leche >= 5) ? 'alert-success' : 'alert-danger' ?>" role="alert">
    <table class="table table-bordered table-responsive table-striped alert-success" >
        
        <tr>
            <td rowspan="3" >Imagen de la Vaca</td>
            <td>Fecha: <?php echo $fecha_inicio ?> Hasta <?php echo $fecha_fin?></td>
        </tr>
        <tr >
            <td>Nombre: <?php echo $grafica->$nombre?></td>
        </tr>
        <tr>
            <td>Cantidad: <?php echo $grafica->cantidad_leche?></td>
        </tr>    
    </table>
            </div>
        </a>
    <?php endforeach;?>
    </div>
</div>
<?php// endforeach;?>
<script class="code" type="text/javascript">
$(document).ready(function(){
  // Some simple loops to build up data arrays.
  var cosPoints = [];
  for (var i=0; i<2*Math.PI; i+=1){ 
    cosPoints.push([i, Math.cos(i)]); 
  }
   
  var sinPoints = []; 
  for (var i=0; i<2*Math.PI; i+=0.4){ 
     sinPoints.push([i, 2*Math.sin(i-.8)]); 
  }
   
  var powPoints1 = []; 
  for (var i=0; i<2*Math.PI; i+=1) { 
      powPoints1.push([i, 2.5 + Math.pow(i/4, 2)]); 
  }
   
  var powPoints2 = []; 
  for (var i=0; i<2*Math.PI; i+=1) { 
      powPoints2.push([i, -2.5 - Math.pow(i/4, 2)]); 
  } 

  var plot3 = $.jqplot('chart3', [cosPoints, sinPoints, powPoints1, powPoints2], 
    { 
      title:'Line Style Options', 
      // Set default options on all series, turn on smoothing.
      seriesDefaults: {
          rendererOptions: {
              smooth: true
          }
      },
      // Series options are specified as an array of objects, one object
      // for each series.
      series:[ 
          {
            // Change our line width and use a diamond shaped marker.
            lineWidth:2, 
            markerOptions: { style:'dimaond' }
          }, 
          {
            // Don't show a line, just show markers.
            // Make the markers 7 pixels with an 'x' style
            showLine:false, 
            markerOptions: { size: 7, style:"x" }
          },
          { 
            // Use (open) circlular markers.
            markerOptions: { style:"circle" }
          }, 
          {
            // Use a thicker, 5 pixel line and 10 pixel
            // filled square markers.
            lineWidth:5, 
            markerOptions: { style:"filledSquare", size:10 }
          }
      ]
    }
  );
   
});
</script>
<div id="chart3" style="height:300px; width:500px;"></div>
<script class="code" type="text/javascript">
$(document).ready(function(){
  var plot1 = $.jqplot ('chart1', [[3,5,2,1,4,6,4,2,5]]);
});
</script>
<div id="chart1" style="width:300px;height:300px ;"></div>
       



