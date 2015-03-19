<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $descripcion = tipoInsumoTableClass::DESCRIPCION ?>
<div class="container container-fluid">
    <div class="row">
<h1><?php echo i18n::__('edit')." "; echo i18n::__('input_type')." ";echo $objTipoInsumo[0]->$descripcion?></h1>
<?php view::includePartial('tipo_insumo/form',array('objTipoInsumo'=> $objTipoInsumo,'descripcion'=>$descripcion))?>
    </div>
</div>
