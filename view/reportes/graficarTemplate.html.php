<br><br><br><br><br>
<?php //echo json_encode($datos) ?>
<br><br><br><br>
<?php
// $datos = array(
//  array(
//  array(1,8, array('control' => 'brix', 'proveedor' => 'Julian', 'fecha' => 'Noviembre 2 de 2015')),
//  array(2,9, array('control' => 'brix', 'proveedor' => 'Andres', 'fecha' => 'Noviembre 1 de 2015')),
//  ),
//  array(
//  array(1,4, array('control' => 'ph', 'proveedor' => 'Julian', 'fecha' => 'Noviembre 2 de 2015')),
//  array(2,6, array('control' => 'ph', 'proveedor' => 'Andres', 'fecha' => 'Noviembre 1 de 2015')),
//  ),
//  
//  array(
//  array(1,4, array('control' => 'ph', 'proveedor' => 'Julian', 'fecha' => 'Noviembre 2 de 2015')),
//  array(2,6, array('control' => 'ph', 'proveedor' => 'Andres', 'fecha' => 'Noviembre 1 de 2015')),
//  ),
//  ); 
//
?>
<?php //echo json_encode($datos) ?>





<div class="container container-fluid" id="cuerpo">
    <div class="center-block" id="cuerpo4">
        <div class="center-block" id="cuerpo2">
            <div id="chart2b"></div>
            <div id="info2c"></div>
            <script>
                $(document).ready(function () {
                    var texto = <?php echo json_encode($razaTick) ?>;
                    plot2b = $.jqplot('chart2b',
                    <?php echo json_encode($raza) ?>
//                    [
//                        [[1,100], [2,80]],
//                        [[1,30], [2,20]]
//                    ]
                    , {
                        seriesDefaults: {
                            renderer: $.jqplot.BarRenderer,
                            pointLabels: {show: true, location: 'e', edgeTolerance: -15},
                            shadowAngle: 135,
                            rendererOptions: {
                                barDirection: 'vertical'
                            },
                            pointLabels: {show: false},
                        },
                        axesDefault: {
                           pad: 1 
                        },
                        axes: {
                            xaxis: {
                                // renderer: $.jqplot.DateAxisRenderer,
                                 //min: 149,
                                 //max: 152
                            },
                            yaxis: {
                                //max: 60
                            }
                        },
                        legend: {show: true, labels: texto, location: 'nw'}

                    });
                    $('#chart2b').bind('jqplotDataClick',
                            function (ev, seriesIndex, pointIndex, data) {
                                $('#info2c').append('<div>Control de calidad: ' + data[2].control + '<br>' + 'Proveedor: ' + data[2].proveedor + '<br>' + 'Fecha: ' + data[2].fecha + '</div>' + '<div><button id="borrar" class="btn btn-sm btn-primary">' + 'Borrar' + '</button>');
                            }
                    );
                });
            </script>
            <br>
            <a class="btn btn-lg btn-success btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('reportes', 'report') ?>" ><?php echo i18n::__('printReport') ?></a>
        </div>    
    </div>    
</div>>