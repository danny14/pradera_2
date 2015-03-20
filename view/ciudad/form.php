<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18m;?>
<?php $id = ciudadTableClass::ID ;?>
<?php $descripcion = ciudadTableClass::DESCRIPCION;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('ciudad', ((isset($objCiudad)) ? 'update' : 'create' ))?>">
    <?php if (isset($objCiudad)== true):?>
    <input name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::ID,TRUE)?>" value="<?php echo $objCiudad[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="form-group">
   <?php echo i18m::__('name')?>: <input class="form-control" type="text" value="<?php echo ((isset($objCiudad)) ? $objCiudad[0]->$descripcion : '' ) ?>" name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, true )?>">
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18m::__((isset($objCiudad) ? 'update': 'register'))?>">
    </div>
</form>

