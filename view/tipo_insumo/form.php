<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18m;?>
<?php $id = tipoInsumoTableClass::ID ;?>
<?php $descripcion = tipoInsumoTableClass::DESCRIPCION;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('tipo_insumo', ((isset($objTipoInsumo)) ? 'update' : 'create' ))?>">
    <?php if (isset($objTipoInsumo)== true):?>
    <input name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID,TRUE)?>" value="<?php echo $objTipoInsumo[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="form-group">
   <?php echo i18m::__('description')?>: <input class="form-control" type="text" value="<?php echo ((isset($objTipoInsumo)) ? $objTipoInsumo[0]->$descripcion : '' ) ?>" name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESCRIPCION, true )?>">
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18m::__((isset($objTipoInsumo) ? 'update': 'register'))?>">
    </div>
</form>

