<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session; ?>
<?php use mvc\request\requestClass as request;?>
<?php use mvc\view\viewClass as view; ?>
<?php $id = entradaBodegaTableClass::ID ;?>
<?php $fecha = entradaBodegaTableClass::FECHA ?>
<?php $hora = entradaBodegaTableClass::HORA ?>
<?php $id_trabajador_e = entradaBodegaTableClass::ID_TRABAJADOR; ?>
<?php $id_proveedor_e = entradaBodegaTableClass::ID_PROVEEDOR;?>
<?php $id_trabajador = trabajadorTableClass::ID;?>
<?php $nombre_trabajador = trabajadorTableClass::NOMBRE;?>
<?php $id_proveedor = proveedorTableClass::ID; ?>
<?php $nombre_proveedor = proveedorTableClass::NOMBRE;?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('entrada_bodega', ((isset($objEntradaBodega)) ? 'update' : 'create' ))?>">
    <?php if (isset($objEntradaBodega) == true):?>
    <input name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID,TRUE)?>" value="<?php echo $objEntradaBodega[0]->$id ?>" type="hidden">
    <?php endif ?>
    
   <div class="form-group <?php echo (session::getInstance()->hasFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>">
   <label class="control-label" for="date"><?php echo i18n::__('date')?>: </label>
   <input class="form-control" type="date" value="<?php echo ((isset($objEntradaBodega)) ? $objEntradaBodega[0]->$fecha : ((session::getInstance()->hasFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE)) === TRUE) ?  request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE)) : '' ) ) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, true )?>" required />
   <?php  if (session::getInstance()->hasFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
   </div>
    <!--
   <? php// echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) ?  request::getInstance()->getPost(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) : '' ; ?>
   -->
    <!-- se inclule el mensaje de error puntual -->
    <?php //view::getMessageError('errorGenero') ?>
    <!-- FIN-->
    <div class="form-group <?php echo (session::getInstance()->hasFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::HORA, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?>">
    <label class="control-label" for="time"><?php echo i18n::__('time')?>:</label>
    <input class="form-control" type="time" value="<?php echo ((isset($objEntradaBodega)) ? $objEntradaBodega[0]->$hora :  ((session::getInstance()->hasFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::HORA, TRUE)) === TRUE) ?  request::getInstance()->getPost(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::HORA, TRUE)) : '' )) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::HORA, true )?>" required placeholder="<?php echo i18n::__('enterTime')?>"/>
    <?php  if (session::getInstance()->hasFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::HORA, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
    </div>
      
    <div class="form-group <?php// echo ((isset($animal[$id_raza])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="employee"><?php echo i18n::__('employee') ?>:</label> 
   <select class="form-control" id="<?php entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, TRUE)?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, TRUE);?>" required />
   <option><?php echo i18n::__('selectEmployee')?></option>
       <?php foreach($objTrabajador as $trabajador):?>
       <option <?php echo (isset($objEntradaBodega[0]->$id_trabajador_e) === true and $objEntradaBodega[0]->$id_trabajador_e == $trabajador->$id_trabajador) ? 'selected' : '' ?> value="<?php echo $trabajador->$id_trabajador ?>" > <?php echo $trabajador->$nombre_trabajador ?> </option>
       <?php endforeach;?>
   </select>
   <?php //if (isset($animal[$id_raza])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php //endif ?>
   </div>
    
    <div class="form-group <?php // echo ((isset($animal[$id_estado])) ? 'has-error has-feedback' : '') ?>">
        <label class="control-label" for="provider"><?php echo i18n::__('provider')?></label>
        <select class="form-control" id="<?php entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, TRUE)?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, TRUE);?>" required />
   <option><?php echo i18n::__('selectEstado')?></option>
       <?php foreach($objProveedor as $proveedor):?>
       <option <?php echo (isset($objEntradaBodega[0]->$id_proveedor_e) === true and $objEntradaBodega[0]->$id_proveedor_e == $proveedor->$id_proveedor) ? 'selected' : '' ?> value="<?php echo $proveedor->$id_proveedor?>"><?php echo $proveedor->$nombre_proveedor?></option>
       <?php endforeach;?>
   </select>
        <?php // if (isset($animal[$id_estado])):?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php // endif ?>
    </div>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objEntradaBodega) ? 'update': 'register'))?>">
   <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('entrada_bodega', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
    </div>
</form>

