<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $nombre = trabajadorTableClass::NOMBRE ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <div class="row">
    
        <h1><i class="fa fa-child"><?php echo i18n::__('edit')." "; echo i18n::__('employee')." ";echo $objTrabajador[0]->$nombre?></i></h1>
<?php view::includeHandlerMessage() ?>
<?php view::includePartial('trabajador/form',array('objTrabajador'=> $objTrabajador,'objTurno'=>$objTurno,'objCredencial' => $objCredencial,'objCiudad'=> $objCiudad))?>
    </div>
</div>
