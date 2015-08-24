<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = entradaBodegaTableClass::ID ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <div class="row">
    
<h1><?php echo i18n::__('edit')." "; echo i18n::__('entry_detail')." ";echo $objEntradaBodega[0]->$id?></h1>
<?php view::includeHandlerMessage() ?>
<?php view::includePartial('detalle_entrada/form',array('objDetalleEntrada' => $objDetalleEntrada,'objEntradaBodega' => $objEntradaBodega,'objInsumo'=> $objInsumo,'objTipoInsumo'=>$objTipoInsumo,'idEntradaBodega' => $idEntradaBodega))?>
    </div>
</div>
