<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session?>
<?php use mvc\request\requestClass as request?>
<?php $id = ciudadTableClass::ID ;?>
<?php $descripcion = ciudadTableClass::DESCRIPCION;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('ciudad', ((isset($objCiudad)) ? 'update' : 'create' ))?>">
    <?php if (isset($objCiudad)== true):?>
    <input name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::ID,TRUE)?>" value="<?php echo $objCiudad[0]->$id ?>" type="hidden">
    <?php endif ?>
   <div class="form-group <?php echo (session::getInstance()->hasFlash(ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, TRUE)) === TRUE) ? 'has-error has-feedback' : ''; ?>">
   <label class="control-label" for="description"><?php echo i18n::__('description') ?>: </label>
   <input class="form-control" type="text" value="<?php echo ((isset($objCiudad)) ? $objCiudad[0]->$descripcion : '' ) ?>" name="<?php echo ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, true )?>">
   <?php if (session::getInstance()->hasFlash(ciudadTableClass::getNameField(ciudadTableClass::DESCRIPCION, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objCiudad) ? 'update': 'register'))?>">
   <a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ciudad', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
</form>

