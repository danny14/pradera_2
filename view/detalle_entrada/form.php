<?php

use mvc\routing\routingClass as routing; ?>
<?php

use mvc\i18n\i18nClass as i18n; ?>
<?php

use mvc\session\sessionClass as session; ?>
<?php

use mvc\request\requestClass as request; ?>
<?php

use mvc\view\viewClass as view; ?>
<?php $id = detalleEntradaTableClass::ID; ?>
  <?php $valor = detalleEntradaTableClass::VALOR ?>
  <?php $id_entrada_d = detalleEntradaTableClass::ID_ENTRADA_BODEGA; ?>
  <?php $id_insumo_d = detalleEntradaTableClass::ID_INSUMO; ?>
  <?php $id_tipo_insumo_d = detalleEntradaTableClass::ID_TIPO_INSUMO; ?>
<?php $id_entrada = entradaBodegaTableClass::ID; ?>
<?php $id_insumo = insumoTableClass::ID; ?>
<?php $nombre_insumo = insumoTableClass::NOMBRE; ?>
    <?php $id_tipo_insumo = tipoInsumoTableClass::ID; ?>
    <?php $descripcion_tipo_insumo = tipoInsumoTableClass::DESCRIPCION; ?>
<?php $idE = request::getInstance()->getGet(entradaBodegaTableClass::ID) ?>
<form method="POST" action="<?php echo routing::getInstance()->getUrlWeb('detalle_entrada', ((isset($objDetalleEntrada)) ? 'update' : 'create')) ?>">
<?php if (isset($objDetalleEntrada) == true): ?>
    <input name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, TRUE) ?>" value="<?php echo $objDetalleEntrada[0]->$id ?>" type="hidden">
<?php endif ?>

  <div class="form-group <?php echo (session::getInstance()->hasFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE)) === TRUE) ? 'has-error has-feedback' : ''; ?>">
    <label class="control-label" for="value"><?php echo i18n::__('value') ?>: </label>
    <input class="form-control" type="number" value="<?php echo ((isset($objDetalleEntrada)) ? $objDetalleEntrada[0]->$valor : ((session::getInstance()->hasFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, TRUE)) === TRUE) ? request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, TRUE)) : '' ) ) ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true) ?>" required />
    <?php if (session::getInstance()->hasFlash(entradaBodegaTableClass::getNameField(entradaBodegaTableClass::FECHA, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
  </div>


  <div class="form-group">
    <label class="control-label" for="entry_cellalr"><?php echo i18n::__('entry_cellar') ?>:</label> 
    <select class="form-control" id="<?php detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_ENTRADA_BODEGA, TRUE) ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_ENTRADA_BODEGA, TRUE); ?>" required />
    <option><?php echo i18n::__('selectEntryCellar') ?></option>
    <?php foreach ($objEntradaBodega as $entrada_bodega): ?>
      <option <?php echo (isset($objDetalleEntrada[0]->$id_entrada_d) === true and $objDetalleEntrada[0]->$id_entrada_d == $idEntradaBodega) ? 'selected' : '' ?><?php echo($idE == $entrada_bodega->$id_entrada) ? 'selected' : '' ?> value="<?php echo $entrada_bodega->$id_entrada ?>" > <?php echo $entrada_bodega->$id_entrada ?> </option>
    <?php endforeach; ?>
    </select>
    <?php //if (isset($animal[$id_raza])): ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php //endif  ?>
  </div>    

  <div class="form-group <?php // echo ((isset($animal[$id_raza])) ? 'has-error has-feedback' : '')  ?>">
    <label class="control-label" for="input"><?php echo i18n::__('input') ?>:</label> 
    <select class="form-control" id="<?php detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_INSUMO, TRUE) ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_INSUMO, TRUE); ?>" required />
    <option><?php echo i18n::__('selectInput') ?></option>
    <?php foreach ($objInsumo as $insumo): ?>
      <option <?php echo (isset($objDetalleEntrada[0]->$id_insumo_d) === true and $objDetalleEntrada[0]->$id_insumo_d == $insumo->$id_insumo) ? 'selected' : '' ?> value="<?php echo $insumo->$id_insumo ?>" > <?php echo $insumo->$nombre_insumo ?> </option>
    <?php endforeach; ?>
    </select>
    <?php //if (isset($animal[$id_raza])): ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php //endif  ?>
  </div>

  <div class="form-group <?php // echo ((isset($animal[$id_estado])) ? 'has-error has-feedback' : '')  ?>">
    <label class="control-label" for="type_input"><?php echo i18n::__('type_input') ?></label>
    <select class="form-control" id="<?php detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_TIPO_INSUMO, TRUE) ?>" name="<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID_TIPO_INSUMO, TRUE); ?>" required />
    <option><?php echo i18n::__('selectTypeInput') ?></option>
<?php foreach ($objTipoInsumo as $tipo_insumo): ?>
      <option <?php echo (isset($objDetalleEntrada[0]->$id_tipo_insumo_d) === true and $objDetalleEntrada[0]->$id_tipo_insumo_d == $tipo_insumo->$id_tipo_insumo) ? 'selected' : '' ?> value="<?php echo $tipo_insumo->$id_tipo_insumo ?>"><?php echo $tipo_insumo->$descripcion_tipo_insumo ?></option>
<?php endforeach; ?>
    </select>
<?php // if (isset($animal[$id_estado])): ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php // endif  ?>
  </div>

  <br>
  <input class="btn btn-primary btn-xs" type="submit" value="<?php echo i18n::__((isset($objDetalleEntrada) ? 'update' : 'register')) ?>">
  <a href="<?= $_SERVER["HTTP_REFERER"] ?>" class="btn btn-info btn-xs"><?php echo i18n::__('return') ?></a>
</div>
</form>

