<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18m;?>
<?php $id = proveedorTableClass::ID ;?>
<?php $nombre = proveedorTableClass::NOMBRE?>
<?php $apellido = proveedorTableClass::APELLIDO?>
<?php $direccion = proveedorTableClass::DIRECCION?>
<?php $telefono = proveedorTableClass::TELEFONO?>
<?php $correo = proveedorTableClass::CORREO?>
<?php $id_ciudad = proveedorTableClass::ID_CIUDAD?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', ((isset($objProveedor)) ? 'update' : 'create' ))?>">
    <?php if (isset($objProveedor)== true):?>
    <input name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID,TRUE)?>" value="<?php echo $objProveedor[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="form-group">
   <?php echo i18m::__('name')?>: <input class="form-control" type="text" value="<?php echo ((isset($objProveedor)) ? $objProveedor[0]->$nombre : '' ) ?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true )?>">
   <?php echo i18m::__('last_name')?>: <input class="form-control" type="text" value="<?php echo ((isset($objProveedor)) ? $objProveedor[0]->$apellido : '' ) ?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true )?>">
   <?php echo i18m::__('address')?>: <input class="form-control" type="text" value="<?php echo ((isset($objProveedor)) ? $objProveedor[0]->$direccion : '' ) ?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true )?>">
   <?php echo i18m::__('phone')?>: <input class="form-control" type="text" value="<?php echo ((isset($objProveedor)) ? $objProveedor[0]->$telefono : '' ) ?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true )?>">
   <?php echo i18m::__('mail')?>: <input class="form-control" type="text" value="<?php echo ((isset($objProveedor)) ? $objProveedor[0]->$correo : '' ) ?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CORREO, true )?>">
   <?php echo i18m::__('id_city')?>: <input class="form-control" type="text" value="<?php echo ((isset($objProveedor)) ? $objProveedor[0]->$id_ciudad : '' ) ?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, true )?>">
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18m::__((isset($objProveedor) ? 'update': 'register'))?>">
    </div>
</form>

