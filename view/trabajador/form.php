<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session; ?>
<?php use mvc\request\requestClass as request;?>
<?php $id = trabajadorTableClass::ID ;?>
<?php $nombre= trabajadorTableClass::NOMBRE;?>
<?php $apellido = trabajadorTableClass::APELLIDO;?>
<?php $direccion = trabajadorTableClass::DIRECCION ;?>
<?php $telefono = trabajadorTableClass::TELEFONO?>
<?php $id_turno_t = trabajadorTableClass::ID_TURNO; ?>
<?php $id_credencial_t = trabajadorTableClass::ID_CREDENCIAL;?>
<?php $id_ciudad_t = trabajadorTableClass::ID_CIUDAD; ?>
<?php $id_turno = turnoTableClass::ID;?>
<?php $descripcionturno = turnoTableClass::DESCRIPCION;?>
<?php $id_credencial = credencialTableClass::ID; ?>
<?php $nombrecredencial = credencialTableClass::NOMBRE;?>
<?php $id_ciudad = ciudadTableClass::ID; ?>
<?php $descripcionciudad = ciudadTableClass::DESCRIPCION;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('trabajador', ((isset($objTrabajador)) ? 'update' : 'create' ))?>">
    <?php if (isset($objTrabajador)== true):?>
    <input name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID,TRUE)?>" value="<?php echo $objTrabajador[0]->$id ?>" type="hidden">
    <?php endif ?>
    
   <div class="form-group <?php echo (session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>">
   <label class="control-label" for="name"><?php echo i18n::__('name')?>: </label>
   <input class="form-control" type="text" value="<?php echo ((isset($objTrabajador)) ? $objTrabajador[0]->$nombre : ((session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE)) === TRUE) ?  request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE)) : '' ) ) ?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, true )?>" required placeholder="<?php echo i18n::__('enterName')?>" />
   <?php  if (session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
    <!--
   <? php// echo (session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE)) === TRUE) ?  request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::NOMBRE, TRUE)) : '' ; ?>
   -->
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>"">
    <label class="control-label" for="last_name"><?php echo i18n::__('last_name')?>:</label>
    <input class="form-control" type="text" value="<?php echo ((isset($objTrabajador)) ? $objTrabajador[0]->$apellido :  ((session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, TRUE)) === TRUE) ?  request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, TRUE)) : '' )) ?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, true )?>" required placeholder="<?php echo i18n::__('enterLastName')?>"/>
    <?php  if (session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::APELLIDO, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
    </div>
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>"">
    <label class="control-label" for="address"><?php echo i18n::__('address')?>: </label>
    <input class="form-control" type="text" value="<?php echo ((isset($objTrabajador)) ? $objTrabajador[0]->$direccion : ((session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, TRUE)) === TRUE) ?  request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, TRUE)) : '' ) )  ?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, true )?>" required placeholder="<?php echo i18n::__('enterAddress')?>"/>
    <?php  if (session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::DIRECCION, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
    </div>
    
    <div class="form-group <?php echo (session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>"">
        <label class="control-label" for="weight"><?php echo i18n::__('phone')?>: </label>
        <input class="form-control" type="text" value="<?php echo ((isset($objTrabajador)) ? $objTrabajador[0]->$telefono : ((session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, TRUE)) === TRUE) ?  request::getInstance()->getPost(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, TRUE)) : '' ))  ?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, true )?>" required placeholder="<?php echo i18n::__('enterPhone')?>">
   <?php  if (session::getInstance()->hasFlash(trabajadorTableClass::getNameField(trabajadorTableClass::TELEFONO, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
    
    <div class="form-group <?php// echo ((isset($trabajador[$id_raza])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="turn"><?php echo i18n::__('turn') ?>:</label> 
   <select class="form-control" id="<?php trabajadorTableClass::getNameField(trabajadorTableClass::ID_TURNO, TRUE)?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_TURNO, TRUE);?>" required />
   <option><?php echo i18n::__('selectTurn')?></option>
       <?php foreach($objTurno as $turno):?>
       <option <?php echo (isset($objTrabajador[0]->$id_turno_t) === true and $objTrabajador[0]->$id_turno_t == $turno->$id_turno) ? 'selected' : ''?> value="<?php echo $turno->$id_turno?>"><?php echo $turno->$descripcionturno?></option>
       <?php endforeach;?>
   </select>
   <?php //if (isset($trabajador[$id_raza])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php //endif ?>
   </div>

    <div class="form-group <?php// echo ((isset($trabajador[$id_raza])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="credential"><?php echo i18n::__('credential') ?>:</label> 
   <select class="form-control" id="<?php trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, TRUE)?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_CREDENCIAL, TRUE);?>" required />
   <option><?php echo i18n::__('selectCredential')?></option>
       <?php foreach($objCredencial as $credencial):?>
       <option <?php echo (isset($objTrabajador[0]->$id_credencial_t) === true and $objTrabajador[0]->$id_credencial_t == $credencial->$id_credencial) ? 'selected' : ''?> value="<?php echo $credencial->$id_credencial?>"><?php echo $credencial->$nombrecredencial?></option>
       <?php endforeach;?>
   </select>
   <?php //if (isset($trabajador[$id_raza])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php //endif ?>
   </div>
    
    <div class="form-group <?php // echo ((isset($trabajador[$id_estado])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="city"><?php echo i18n::__('city')?></label>
   <select class="form-control" id="<?php trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, TRUE)?>" name="<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID_CIUDAD, TRUE);?>" required />
   <option><?php echo i18n::__('selectCity')?></option>
       <?php foreach($objCiudad as $ciudad):?>
       <option <?php echo (isset($objTrabajador[0]->$id_ciudad_t) === true and $objTrabajador[0]->$id_ciudad_t == $ciudad->$id_ciudad) ? 'selected' : '' ?> value="<?php echo $ciudad->$id_ciudad?>"><?php echo $ciudad->$descripcionciudad?></option>
       <?php endforeach;?>
   </select>
        <?php // if (isset($trabajador[$id_estado])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php // endif ?>
    </div>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objTrabajador) ? 'update': 'register'))?>">
   <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
    </div>
</form>

