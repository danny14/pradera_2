<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18m;?>
<?php $id = tablaTableClass::ID ;?>
<?php $nombreOdescripcion = tablaTableClass::NombreODESCRIPCION;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('TABLA', ((isset($objCiudad)) ? 'update' : 'create' ))?>">
    <?php if (isset($objTabla)== true):?>
    <input name="<?php echo tablaTableClass::getNameField(tablaTableClass::ID,TRUE)?>" value="<?php echo $objTabla[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="form-group">
   <?php echo i18m::__('campo')?>: <input class="form-control" type="text" value="<?php echo ((isset($objTabla)) ? $objTabla[0]->$nombreOdescripcion : '' ) ?>" name="<?php echo tablaTableClass::getNameField(tablaTableClass::NombreODESCRIPCION, true )?>">
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18m::__((isset($objTabla) ? 'update': 'register'))?>">
    </div>
</form>

