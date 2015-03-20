<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18m;?>
<?php $id = razaTableClass::ID ;?>
<?php $descripcion = razaTableClass::DESCRIPCION;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('raza', ((isset($objRaza)) ? 'update' : 'create' ))?>">
    <?php if (isset($objRaza)== true):?>
    <input name="<?php echo razaTableClass::getNameField(razaTableClass::ID,TRUE)?>" value="<?php echo $objRaza[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="form-group">
   <?php echo i18m::__('description')?>: <input class="form-control" type="text" value="<?php echo ((isset($objRaza)) ? $objRaza[0]->$descripcion : '' ) ?>" name="<?php echo razaTableClass::getNameField(razaTableClass::DESCRIPCION, true )?>">
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18m::__((isset($objRaza) ? 'update': 'register'))?>">
    </div>
</form>

