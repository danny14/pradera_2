<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18m;?>
<?php $id = credencialTableClass::ID ;?>
<?php $nombre = credencialTableClass::NOMBRE;?>
<?php $created_at = credencialTableClass::CREATED_AT;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('credencial', ((isset($objCiudad)) ? 'update' : 'create' ))?>">
    <?php if (isset($objCredencial)== true):?>
    <input name="<?php echo credencialTableClass::getNameField(credencialTableClass::ID,TRUE)?>" value="<?php echo $objCredencial[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="form-group">
   <?php echo i18m::__('name')?>: <input class="form-control" type="text" value="<?php echo ((isset($objCredencial)) ? $objCredencial[0]->$nombre : '' ) ?>" name="<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, true )?>">
    <?php echo i18m::__('created_at')?>: <input class="form-control" type="text" value="<?php echo ((isset($objCredencial)) ? $objCredencial[0]->$created_at : '' ) ?>" name="<?php echo credencialTableClass::getNameField(credencialTableClass::CREATED_AT, true )?>">
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18m::__((isset($objCredencial) ? 'update': 'register'))?>">
    </div>
</form>

