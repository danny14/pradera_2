<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $descripcion = turnoTableClass::DESCRIPCION ?>
<div class="container container-fluid">
    <div class="row">
<h1><?php echo i18n::__('edit')." "; echo i18n::__('turn')." ";echo $objturno[0]->$descripcion?></h1>
<?php view::includePartial('turno/form',array('objTurno'=> $objTurno,'descripcion'=>$descripcion))?> <!-- si quiere coloca la variable nombre o descripcion para pasarlo al formulario -->
    </div>
</div>
