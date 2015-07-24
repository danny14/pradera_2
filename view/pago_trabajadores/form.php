<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
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

<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('pago_trabajador', ((isset($objPagoTrabajadores)) ? 'update' : 'create' ))?>">
    <?php if (isset($objPagoTrabajadores)== true):?>
    <input name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID,TRUE)?>" value="<?php echo ((isset($objPagoTrabajadores))? $objPagoTrabajadores[0]->$id : $pago_trabajadores[$id]) ?>" type="hidden">
    <?php endif ?>
   <?php echo i18n::__('xxxxxxx')?>: <input class="form-control" type="date" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$fecha_inicio : ((isset($pago_trabajadores[$fecha_inicio]))? $pago_trabajadores[$fecha_inicio] : '' ) ) ?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_INICIO, true )?>"required placeholder="<?php i18n::__('date_XXXX') ?>">
   <?php echo i18n::__('xxxxxxx')?>: <input class="form-control" type="number" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$fecha_fin : ((isset($pago_trabajadores[$fecha_fin]))? $pago_trabajadores[$fecha_fin] : '' ) ) ?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::FECHA_FIN, true )?>"required placeholder="<?php i18n::__('XXXXX') ?>">
   <?php echo i18n::__('xxxxxxx')?>: <input class="form-control" type="number" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$subtotal : ((isset($pago_trabajadores[$subtotal]))? $pago_trabajadores[$subtotal] : '' ) ) ?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::SUBTOTAL, true )?>"required placeholder="<?php i18n::__('XXXXX') ?>">
   <?php echo i18n::__('xxxxxxx')?>: <input class="form-control" type="number" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$valor_hora : ((isset($pago_trabajadores[$valor_hora]))? $pago_trabajadores[$valor_hora] : '' ) ) ?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::VALOR_HORA, true )?>"required placeholder="<?php i18n::__('XXXXX') ?>">
   <?php echo i18n::__('xxxxxxx')?>: <input class="form-control" type="number" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$horas_extras : ((isset($pago_trabajadores[$horas_extras]))? $pago_trabajadores[$horas_extras] : '' ) ) ?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::HORAS_EXTRAS, true )?>"required placeholder="<?php i18n::__('XXXXX') ?>">
   <?php echo i18n::__('xxxxxxx')?>: <input class="form-control" type="text" value="<?php echo ((isset($objPagoTrabajadores)) ? $objPagoTrabajadores[0]->$cantidad_dias : ((isset($pago_trabajadores[$cantidad_dias]))? $pago_trabajadores[$cantidad_dias] : '' ) ) ?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::CANTIDAD_DIAS, true )?>"required placeholder="<?php i18n::__('XXXXXX') ?>">
   
    <?php echo i18n::__('trabajador')?>
   <select class="form-control" id="<?php pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE)?>" name="<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID_TRABAJADOR, TRUE);?>"required placeholder="<?php i18n::__('id_trabajador') ?>">
     <option><?php echo i18n::__('selectTrabajador') ?></option>
       <?php foreach($objTrabajador as $trabajador):?>
       <option  <?php echo(( isset($objPagoTrabajadores[0]->$id_trabajador) and $objPagoTrabajadores[0]->$id_trabajador == $trabajador->$trabajador_id) ? 'selected' : '')?> value="<?php echo $trabajador->$trabajador_id?>"><?php echo $trabajador->$nombreTrabajador?></option>
       <?php endforeach;?>
   </select>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objPagoTrabajadores) ? 'update': 'register'))?>">
   <a href="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'index') ?>"class="btn btn-info btn-xs"> <i class="fa fa-hand-o-left"> <?php echo i18n::__('return') ?></i></a>
   </div>
</form>




