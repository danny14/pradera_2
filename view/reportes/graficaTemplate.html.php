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
    <?php if($idReporte == 1 ):?>
    <!-- VENTANAS O TAP ------------->
    <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Buenas</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Regulares</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Malas</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">...</div>
    <div role="tabpanel" class="tab-pane" id="profile">...</div>
    <div role="tabpanel" class="tab-pane" id="messages">...</div>
    <div role="tabpanel" class="tab-pane" id="settings">...</div>
  </div>

</div>
    <!-- FIN DE VENTANAS-->
    <?php foreach ($objOrdenno as $ordenno):?>
        <a href="<?php  echo routing::getInstance()->getUrlWeb('reportes', 'grafica2',array('id_animal'=>$ordenno->$id_animal,'fecha_inicio' => $fecha_inicio,'fecha_fin' =>$fecha_fin)) ?>">
            <div class="alert <?php echo ($ordenno->$cantidad_leche >= config::getCantidad() ) ? 'alert-success' : 'alert-danger' ?>" role="alert">
    <table class="table table-bordered table-responsive table-striped alert-success" >
        
        <tr>
            <td rowspan="3" ><img src="<?php echo routing::getInstance()->getUrlImg('carga1.png')?>"></img></td>
            <td>Fecha: <?php echo $fecha_inicio ?> Hasta <?php echo $fecha_fin?></td>
        </tr>
        <tr >
            <td>Nombre: <?php echo $ordenno->$nombre?></td>
        </tr>
        <tr>
            <td>Cantidad: <?php echo $ordenno->$cantidad_leche?></td>
        </tr>    
    </table>
            </div>
        </a>
    <?php endforeach;?>
   
    <?php elseif($idReporte == 2): ?>
        
    <?php endif; ?>
    </div>
</div>