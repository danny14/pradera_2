<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n;?>
<?php use mvc\session\sessionClass as session ;?>
<?php use mvc\view\viewClass as view?>
<?php use mvc\request\requestClass as request?>
<?php $id = detallesalidaTableClass::ID ;?>
<?php $cantidad = detallesalidaTableClass::CANTIDAD ;?>
<?php $id_salida_bodega = detallesalidaTableClass::ID_SALIDA_BODEGA ;?>
<?php $id_insumo = detallesalidaTableClass::ID_INSUMO ;?>
<?php $id_tipo_insumo = detallesalidaTableClass::ID_TIPO_INSUMO ;?>
<?php $salida_bodega_id = salidaBodegaTableClass::ID ;?>
<?php $insumo_id = insumoTableClass::ID ;?>
<?php $nombreInsumo = insumoTableClass::NOMBRE ;?>
<?php $tipo_insumo_id = tipoInsumoTableClass::ID ;?>
<?php $descripcion = tipoInsumoTableClass::DESCRIPCION ;?>

<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalle_salida', ((isset($objDetalleSalida)) ? 'update' : 'create' ))?>">
    <?php if (isset($objDetalleSalida)== true):?>
    <input name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID,TRUE)?>" value="<?php echo ((isset($objDetalleSalida))? $objDetalleSalida[0]->$id : $detalle_salida[$id]) ?>" type="hidden">
    <?php endif ?>
    
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorCantidad') ?>
   <!-- Fin de mensaje error puntual -->
   <div class="form-group <?php echo (session::getInstance()->hasFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD,true)) === TRUE ) ? 'has-error has-feedback' : '' ?>">
   <label class="control-label" for="quantity"><?php echo i18n::__('quantity')?></label>
   <input class="form-control" type="number" value="<?php echo ((isset($objDetalleSalida)) ? $objDetalleSalida[0]->$cantidad : ((session::getInstance()->hasFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, TRUE))=== TRUE )?'':(request::getInstance()->hasPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, TRUE)))?request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, TRUE)):''))?>" name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true )?>"required placeholder="<?php i18n::__('quantity') ?>">
   <?php if(session::getInstance()->hasFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif;?>
   </div>
   
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorSalidaBodega') ?>
   <!-- Fin de mensaje error puntual -->
     <?php echo i18n::__('salida_bodega') ?>: 
   <select class="form-control" id="<?php detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_SALIDA_BODEGA, TRUE)?>" name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_SALIDA_BODEGA, TRUE);?>"required placeholder="<?php i18n::__('id_salida_bodega') ?>">
     <option value=""> <?php echo i18n::__('selectSalidaBodega') ?></option>
       <?php foreach($objSalidaBodega as $salida_bodega):?>
       <option <?php echo ((isset($objDetalleSalida[0]->$id_salida_bodega) and $objDetalleSalida[0]->$id_salida_bodega === $salida_bodega->$salida_bodega_id ) ? 'selected' : ((session::getInstance()->hasFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_SALIDA_BODEGA, TRUE))===TRUE)? '' :(request::getInstance()->hasPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_SALIDA_BODEGA, TRUE))and request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_SALIDA_BODEGA, TRUE))== $salida_bodega-> $salida_bodega_id) ? 'selected' : ''))?> value="<?php echo $salida_bodega->$salida_bodega_id?>"><?php echo $salida_bodega->$salida_bodega_id?></option>
       <?php endforeach;?>
   </select>
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorInsumo') ?>
   <!-- Fin de mensaje error puntual -->
   <?php echo i18n::__('input')?>
   <select class="form-control" id="<?php detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_INSUMO, TRUE)?>" name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_INSUMO, TRUE);?>"required placeholder="<?php i18n::__('id_input') ?>">
     <option><?php echo i18n::__('selectInput') ?></option>
       <?php foreach($objInsumo as $insumo):?>
       <option  <?php echo(( isset($objDetalleSalida[0]->$id_insumo) and $objDetalleSalida[0]->$id_insumo == $insumo->$insumo_id) ? 'selected' : ((session::getInstance()->hasFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_INSUMO, TRUE))===TRUE)? '' :(request::getInstance()->hasPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_INSUMO, TRUE))and request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_INSUMO, TRUE))== $insumo-> $insumo_id)  ? 'selected' : ''))?> value="<?php echo $insumo->$insumo_id?>"><?php echo $insumo->$nombreInsumo?></option>
       <?php endforeach;?>
   </select>
   <!--este  es para el mensaje de error puntual -->
   <?php view::getMessageError('errorTipoInsumo') ?>
   <!-- Fin de mensaje error puntual -->
     <?php echo i18n::__('type_input')?>
   <select class="form-control" id="<?php detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_TIPO_INSUMO, TRUE)?>" name="<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_TIPO_INSUMO, TRUE);?>"required placeholder="<?php i18n::__('id_type_input') ?>">
     <option><?php echo i18n::__('selectTypeInput') ?></option>
       <?php foreach($objTipoInsumo as $tipo_insumo):?>
       <option  <?php echo(( isset($objDetalleSalida[0]->$id_tipo_insumo) and $objDetalleSalida[0]->$id_tipo_insumo == $tipo_insumo->$tipo_insumo_id) ? 'selected' : ((session::getInstance()->hasFlash(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_TIPO_INSUMO, TRUE))===TRUE)? '' :(request::getInstance()->hasPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_TIPO_INSUMO, TRUE))and request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID_TIPO_INSUMO, TRUE))== $tipo_insumo-> $tipo_insumo_id)  ? 'selected' : ''))?> value="<?php echo $tipo_insumo->$tipo_insumo_id?>"><?php echo $tipo_insumo->$descripcion?></option>
       <?php endforeach;?>
   </select>
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objDetalleSalida) ? 'update': 'register'))?>">
   <a href="<?php echo routing::getInstance()->getUrlWeb('detalle_salida', 'index') ?>"class="btn btn-info btn-xs"> <i class="fa fa-hand-o-left"> <?php echo i18n::__('return') ?></i></a>
   </div>
</form>


