<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session?>
<?php use mvc\request\requestClass as request?>
<?php use mvc\view\viewClass as view; ?>
<?php $id = credencialTableClass::ID ;?>
<?php $nombre = credencialTableClass::NOMBRE;?>
<?php $created_at = credencialTableClass::CREATED_AT;?>
<?php $updated_at = credencialTableClass::UPDATED_AT;?>
<?php $deleted_at = credencialTableClass::DELETED_AT;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('credencial', ((isset($objCredencial)) ? 'update' : 'create' ))?>">
    <?php if (isset($objCredencial)== true):?>
    <input name="<?php echo credencialTableClass::getNameField(credencialTableClass::ID,TRUE)?>" value="<?php echo $objCredencial[0]->$id ?>" type="hidden">
    <?php endif ?>
    <?php view::getMessageError('errorNombre')?>
   <div class="form-group <?php echo (session::getInstance()->hasFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE)) === TRUE) ? 'has-error has-feedback' : ''; ?>">
   <label class="control-label" for="name"><?php echo i18n::__('name') ?>: </label>
   <input class="form-control" type="text" value="<?php echo ((isset($objCredencial)) ? $objCredencial[0]->$nombre : ((session::getInstance()->hasFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE)) === TRUE) ?  '' :  (request::getInstance()->hasPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE))) ? request::getInstance()->getPost(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE))  : '' ) ) ?>" name="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true )?>" maxlength="80">
   <?php if (session::getInstance()->hasFlash(credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
    
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objCredencial) ? 'update': 'register'))?>">
   <a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
</form>

