<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php $id = salidaBodegaTableClass::ID; ?>
<?php $fecha = salidaBodegaTableClass::FECHA; ?>
<?php $id_trabajador = salidaBodegaTableClass::ID_TRABAJADOR; ?>
<?php $trabajador_id = trabajadorTableClass::ID; ?>
<?php $nombreTrabajador = trabajadorTableClass::NOMBRE; ?>

<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', ((isset($objSalidaBodega)) ? 'update' : 'create')) ?>">
  <?php if (isset($objSalidaBodega) == true): ?>
    <input name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, TRUE) ?>" value="<?php echo ((isset($objSalidaBodega)) ? $objSalidaBodega[0]->$id : $salida_bodega[$id]) ?>" type="hidden">
  <?php endif ?>

<?php echo i18n::__('date') ?>: <input class="form-control" type="date" value="<?php echo ((isset($objSalidaBodega)) ? $objSalidaBodega[0]->$fecha : ((isset($salida_bodega[$fecha])) ? $salida_bodega[$fecha] : '' ) ) ?>" name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::FECHA, true) ?>"required placeholder="<?php i18n::__('date') ?>">


<?php echo i18n::__('trabajador') ?>
  <select class="form-control" id="<?php salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE) ?>" name="<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID_TRABAJADOR, TRUE); ?>"required placeholder="<?php i18n::__('id_employee') ?>">
    <option><?php echo i18n::__('selectTrabajador') ?></option>
<?php foreach ($objTrabajador as $trabajador): ?>
      <option  <?php echo(( isset($objSalidaBodega[0]->$id_trabajador) and $objSalidaBodega[0]->$id_trabajador == $trabajador->$trabajador_id) ? 'selected' : '') ?> value="<?php echo $trabajador->$trabajador_id ?>"><?php echo $trabajador->$nombreTrabajador ?></option>
<?php endforeach; ?>
  </select>
  <br>
  <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objSalidaBodega) ? 'update' : 'register')) ?>">
  <a href="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'index') ?>"class="btn btn-info btn-xs"> <i class="fa fa-hand-o-left"> <?php echo i18n::__('return') ?></i></a>
</div>
</form>


