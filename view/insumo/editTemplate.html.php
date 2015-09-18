<?php use mvc\routing\routingClass as routing?>
<?php use mvc\i18n\i18nClass as i18n?>
<?php use mvc\view\viewClass as view ?>
<div class="container container-fluid">
    <div class="row">
        <h1><i class="fa fa-beer"><?php echo i18n::__('edit'). " "; echo i18n::__('input')?></i></h1>
        <?php view::includeHandlerMessage()?>
        <?php view::includePartial('insumo/form', array('objInsumo'=>$objInsumo,'objTipoInsumo' => $objTipoInsumo))?>
    </div>
</div>




