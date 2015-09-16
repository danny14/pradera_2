<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $descripcion = tipoInsumoTableClass::DESCRIPCION ?>
<?php view::includePartial('animal/menuPrincipal')?>
<div class="container container-fluid">
    <div class="row">
        <h1><i class="glyphicon glyphicon-object-align-bottom"><?php echo i18n::__('edit')." "; echo i18n::__('type_input')." ";echo $objTipoInsumo[0]->$descripcion?></i></h1>
<?php view::includePartial('tipo_insumo/form',array('objTipoInsumo'=> $objTipoInsumo))?> 
    </div>
</div>
