<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18m;?>
<?php $id = estadoTableClass::ID ;?>
<?php $descripcion = estadoTableClass::DESCRIPCION;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('estado', ((isset($objEstado)) ? 'update' : 'create' ))?>">
    <?php if (isset($objEstado) == true):?>
    <input name="<?php echo estadoTableClass::getNameField(estadoTableClass::ID,TRUE)?>" value="<?php echo $objEstado[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="form-group">
   <?php echo i18m::__('description')?>: <input class="form-control" type="text" value="<?php echo ((isset($objEstado)) ? $objEstado[0]->$descripcion : '' )?>" name="<?php echo estadoTableClass::getNameField(estadoTableClass::DESCRIPCION,TRUE)?>">
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18m::__((isset($objEstado) ? 'update': 'register'))?>">
    </div>
</form>