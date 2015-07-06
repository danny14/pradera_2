<?php use mvc\routing\routingClass as routing?>
<?php use mvc\i18n\i18nClass as i18n?>
<?php use mvc\request\requestClass as request ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = proveedorTableClass::ID?>
<?php $nombre = proveedorTableClass::NOMBRE?>
<?php $apellido = proveedorTableClass::APELLIDO?>
<?php $direccion = proveedorTableClass::DIRECCION?>
<?php $telefono = proveedorTableClass::TELEFONO?>
<?php $correo = proveedorTableClass::CORREO?>
<?php $id_ciudad = proveedorTableClass::ID_CIUDAD?>
<?php $idCiudad = ciudadTableClass::ID ?>
<?php $descripcionciudad = ciudadTableClass::DESCRIPCION?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', ((isset($objProveedor)) ? 'update' : 'create')) ?>">
    <?php if (isset($objProveedor) == TRUE): ?>
    <input type="hidden" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID,TRUE)?>" value="<?php echo $objProveedor[0]->$id ?>">
    <?php endif ;?>
    
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="name"><?php echo i18n::__('name')?>:</label> 
        <input class="form-control" type="text" value="<?php echo ((isset($objProveedor)) ? $objProveedor[0]->$nombre : ((session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE)) === TRUE ) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE,TRUE)) : '') )?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE)?>" required placeholder="<?php echo i18n::__('enterName')?>">
        <?php if(session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
    
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="last_name">
           <?php echo i18n::__('last_name')?>: 
        </label>
        <input class="form-control" type="text" value="<?php echo ((isset($objProveedor)) ? $objProveedor[0]->$apellido : ((session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE)) === TRUE ) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO,TRUE)) : ''))?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE)?>" required placeholder="<?php echo i18n::__('enterLastName')?>">
        <?php if(session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
    
    <div class="form-group" <?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="Address">
             <?php echo i18n::__('address')?>:
            
        </label>
            <input class="form-control" type="text" value="<?php echo ((isset($objProveedor))? $objProveedor[0]->$direccion : ((session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, TRUE)) === TRUE ) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION,TRUE)) : ''))?>"name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, TRUE)?>" required placeholder="<?php echo i18n::__('enterAddress')?>">
            <?php if(session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
        <div class="form-group" <?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="phone">
            <?php echo i18n::__('phone')?>:
            
        </label>
            <input class="form-control" type="text" value="<?php echo ((isset($objProveedor))? $objProveedor[0]->$telefono :((session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE)) === TRUE ) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO,TRUE)) : '') )?>"name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE)?>" required placeholder="<?php echo i18n::__('enterPhone')?>">
            <?php if(session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
        <div class="form-group" <?php echo (session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE)) === TRUE )? 'has-error has-feedback' : '' ;?>>
        <label class="control-label" for="mail">
            <?php echo i18n::__('mail')?>:
            
        </label>
            <input class="form-control" type="text" value="<?php echo ((isset($objProveedor))? $objProveedor[0]->$correo :((session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE)) === TRUE ) ? request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::MAIL,TRUE)) : '') )?>"name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE)?>" required placeholder="<?php echo i18n::__('enterMail')?>">
            <?php if(session::getInstance()->hasFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO,TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif?>
    </div>
        <div class="form-group">
        <label class="control-label" for="id_ciudad">
               <?php echo i18n::__('id_city')?>:
            
        </label>
            <select class="form-control" id="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, TRUE)?>" name="<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID_CIUDAD, TRUE)?>" required>
                <option><?php echo i18n::__('selectCity')?></option>
                  <?php foreach($objCiudad as $ciudad):?>
         <option value="<?php echo $ciudad->$idCiudad?>"><?php echo $ciudad->$descripcionciudad?></option>
         <?php endforeach;?>
     </select>
    </div>
      <br>
     <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objProveedor)? 'update': 'register'))?>">
     <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'index')?>"><i class="fa fa-hand-o-left"><?php echo i18n::__('return')?></i></a>
</form>



