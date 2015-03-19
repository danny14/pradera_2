<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18m;?>
<?php $id = entradaBodegaTableClass::ID ;?>
<?php $fecha = entradaBodegaTableClass::FECHA;?>
<?php $hora = entradaBodegaTableClass::HORA;?>
<?php $id_tipo_doc = entradaBodegaTableClass::ID_TIPO_DOC?>
<?php $id_trabajador = entradaBodegaTableClass::ID_TRABAJADOR ?>
<?php $id_proveedor = entradaBodegaTableClass::ID_PROVEEDOR ?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('entrada_bodega', ((isset($objEntradaBodega)) ? 'update' : 'create' ))?>">
    <?php if (isset($objEntradaBodega)== true):?>
    <input name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID,TRUE)?>" value="<?php echo $objEntradaBodega[0]->$id ?>" type="hidden">
    <?php endif ?>
    <div class="form-group">
   <?php echo i18m::__('date')?>: <input class="form-control" type="text" value="<?php echo ((isset($objEntradaBodega)) ? $objEntradaBodega[0]->$fecha : '' ) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, true )?>">
   <?php echo i18m::__('time')?>: <input class="form-control" type="text" value="<?php echo ((isset($objEntradaBodega)) ? $objEntradaBodega[0]->$hora : '' ) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::HORA, true )?>">
   <?php echo i18m::__('id_type_doc')?>: <input class="form-control" type="text" value="<?php echo ((isset($objEntradaBodega)) ? $objEntradaBodega[0]->$id_tipo_doc : '' ) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TIPO_DOC, true )?>">
   <?php echo i18m::__('id_employee')?>: <input class="form-control" type="text" value="<?php echo ((isset($objEntradaBodega)) ? $objEntradaBodega[0]->$id_trabajador : '' ) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_TRABAJADOR, true )?>">
   <?php echo i18m::__('id_provider')?>: <input class="form-control" type="text" value="<?php echo ((isset($objEntradaBodega)) ? $objEntradaBodega[0]->$id_proveedor : '' ) ?>" name="<?php echo entradaBodegaTableClass::getNameField(entradaBodegaTableClass::ID_PROVEEDOR, true )?>">
   <br>
   <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18m::__((isset($objEntradaBodega) ? 'update': 'register'))?>">
    </div>
</form>

