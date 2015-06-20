<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session?>
<?php use mvc\request\requestClass as request?>
<?php $id = razaTableClass::ID ;?>
<?php $descripcion = razaTableClass::DESCRIPCION;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('raza', ((isset($objRaza)) ? 'update' : 'create' ))?>">
    <?php if (isset($objRaza)== true):?>
    <input name="<?php echo razaTableClass::getNameField(razaTableClass::ID,TRUE)?>" value="<?php echo $objRaza[0]->$id ?>" type="hidden">
    <?php endif ?>
   <div class="form-group <?php echo (session::getInstance()->hasFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE)) === TRUE) ? 'has-error has-feedback' : ''; ?>">
   <label class="control-label" for="description"><?php echo i18n::__('description') ?>: </label>
   <input class="form-control" type="text" value="<?php echo ((isset($objRaza)) ? $objRaza[0]->$descripcion : '' ) ?>" name="<?php echo razaTableClass::getNameField(razaTableClass::DESCRIPCION, true )?>">
   <?php if (session::getInstance()->hasFlash(razaTableClass::getNameField(razaTableClass::DESCRIPCION, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objRaza) ? 'update': 'register'))?>">
   <a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('raza', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
</form>

