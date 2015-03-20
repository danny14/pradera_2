<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $NombreOdescripcion = TABLATableClass::NOMBREODESCRIPCION ?>
<div class="container container-fluid">
    <div class="row">
<h1><?php echo i18n::__('edit')." "; echo i18n::__('TABLA')." ";echo $objTabla[0]->$NombreODescripcion?></h1>
<?php view::includePartial('ciudad/form',array('objTabla'=> $objTabla,'NombreOdescripcion'=>$NombreOdescripcion))?> <!-- si quiere coloca la variable nombre o descripcion para pasarlo al formulario -->
    </div>
</div>
