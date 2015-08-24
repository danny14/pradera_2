<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<div class="container container-fluid">
    <div class="row">
<h1><?php echo i18n::__('new')." "; echo i18n::__('output_of_cellars_details')?></h1>
<?php view::includePartial('detalle_salida/form',array('idSalidaBodega'=>$idSalidaBodega,'objSalidaBodega' => $objSalidaBodega,'objInsumo' => $objInsumo,'objTipoInsumo' => $objTipoInsumo))?>
    </div>
</div>