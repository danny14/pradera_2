<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session ;?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\request\requestClass as request?>
<?php $id = pagoTrabajadoresTableClass::ID ;?>
<?php $fecha_inicio = pagoTrabajadoresTableClass::FECHA_INICIO ;?>
<?php $fecha_fin = pagoTrabajadoresTableClass::FECHA_FIN ;?>
<?php $subtotal = pagoTrabajadoresTableClass::SUBTOTAL ;?>
<?php $valor_hora= pagoTrabajadoresTableClass::VALOR_HORA ;?>
<?php $id_trabajador = pagoTrabajadoresTableClass::ID_TRABAJADOR ;?>
<?php $horas_extras = pagoTrabajadoresTableClass::HORAS_EXTRAS ;?>
<?php $cantidad_dias = pagoTrabajadoresTableClass::CANTIDAD_DIAS ;?>
<?php $trabajador_id= trabajadorTableClass::ID?>
<?php $nombreTrabajador = trabajadorTableClass::NOMBRE;?>

<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', ((isset($objPagoTrabajadores)) ? 'update' : 'create' ))?>">
    <?php if (isset($objPagoTrabajadores)== true):?>
    <input name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID,TRUE)?>" value="<?php echo ((isset($objPagoTrabajadores))? $objPagoTrabajadores[0]->$id : $pago_trabajadores[$id]) ?>" type="hidden">
    <?php endif ?>
    
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorFechaInicio') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="start_date"><?php echo i18n::__('start_date')?></label>
   <input class="form-control" type="date" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$fecha_inicio : ((session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE)))?request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE)):''))?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, true )?>" min="2014-01-01" required placeholder="<?php i18n::__('start_date') ?>">
   <?php if(session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorFechaFin') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="end_date"><?php echo i18n::__('end_date')?></label>
   <input class="form-control" type="date" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$fecha_fin : ((session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, TRUE)))?request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, TRUE)):''))?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, true )?>" min="2014-01-01"required placeholder="<?php i18n::__('end_date') ?>">
   <?php if(session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorSubtotal') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="subtotal"><?php echo i18n::__('subtotal')?></label>
   <input class="form-control" type="number" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$subtotal : ((session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, TRUE)))?request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, TRUE)):''))?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, true )?>"required placeholder="<?php i18n::__('subtotal') ?>">
   <?php if(session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorValorHora') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="time_value"><?php echo i18n::__('time_value')?></label>
   <input class="form-control" type="number" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$valor_hora : ((session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, TRUE)))?request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, TRUE)):''))?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, true )?>"required placeholder="<?php i18n::__('time_value') ?>">
   <?php if(session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorHorasExtras') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="extra_time"><?php echo i18n::__('extra_time')?></label>
   <input class="form-control" type="number" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$horas_extras : ((session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, TRUE)))?request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, TRUE)):''))?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, true )?>"required placeholder="<?php i18n::__('extra_time') ?>">
   <?php if(session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorCantidadDias') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="number of days"><?php echo i18n::__('number of days')?></label>
   <input class="form-control" type="number" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$cantidad_dias : ((session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, TRUE)))?request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, TRUE)):''))?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, true )?>"required placeholder="<?php i18n::__('number of days') ?>">
   <?php if(session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorTrabajador') ?>
   <!-- Fin de mensaje error puntual -->
   <?php echo i18n::__('employee')?>
   <select class="form-control" id="<?php pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE)?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE);?>"required placeholder="<?php i18n::__('id_employee') ?>">
     <option><?php echo i18n::__('selectEmployee') ?></option>
       <?php foreach($objTrabajador as $trabajador):?>
       <option  <?php echo (isset($objPagoTrabajadores[0]->$id_trabajador) === TRUE and $objPagoTrabajadores[0]->$id_trabajador == $trabajador->$trabajador_id) ? 'selected' : ((session::getInstance()->hasFlash(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE))===TRUE)? '' : (request::getInstance()->hasPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE))and request::getInstance()->getPost(pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE))=== $trabajador->$trabajador_id) ? 'selected' : '')?> value="<?php echo $trabajador->$trabajador_id?>"><?php echo $trabajador->$nombreTrabajador?></option>
       <?php endforeach;?>
   </select>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objPagoTrabajadores) ? 'update': 'register'))?>">
   <a href="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'index') ?>"class="btn btn-info btn-xs"> <i class="fa fa-hand-o-left"> <?php echo i18n::__('return') ?></i></a>
   </div>
</form>




