<?php

use mvc\routing\routingClass as routing; ?>
<?php

use mvc\i18n\i18nClass as i18n; ?>
<?php

use mvc\view\viewClass as view ?>
<?php $id = pagoTrabajadoresTableClass::ID; ?>
<?php $fecha_inicio = pagoTrabajadoresTableClass::FECHA_INICIO; ?>
<?php $fecha_fin = pagoTrabajadoresTableClass::FECHA_FIN; ?>
<?php $subtotal = pagoTrabajadoresTableClass::SUBTOTAL; ?>
<?php $valor_hora = pagoTrabajadoresTableClass::VALOR_HORA; ?>
<?php $id_trabajador = pagoTrabajadoresTableClass::ID_TRABAJADOR; ?>
<?php $horas_extras = pagoTrabajadoresTableClass::HORAS_EXTRAS; ?>
<?php $cantidad_dias = pagoTrabajadoresTableClass::CANTIDAD_DIAS; ?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
  <h1<i class="fa fa-diamond"><?php echo i18n::__('payment of employee') ?></i></h1>
  <div class="row">
    <header>
    </header>
    <nav>
    </nav>
    <section>
<?php view::includeHandlerMessage() ?>
      <table class="table table-bordered table-responsive table-condensed">
        <thead>
          <tr class="active">
            <th><?php echo i18n::__('id') ?></th>
            <th><?php echo i18n::__('start_date') ?></th>
            <th><?php echo i18n::__('end_date') ?></th>
            <th><?php echo i18n::__('subtotal') ?></th>
            <th><?php echo i18n::__('time_value') ?></th>
            <th><?php echo i18n::__('extra_time') ?></th>
            <th><?php echo i18n::__('id_employee') ?></th>
            <th><?php echo i18n::__('number of days') ?></th>
          </tr>
        </thead>
        <tbody>
<?php foreach ($objPagoTrabajadores as $pago_trabajadores): ?>
            <tr>
              <td><?php echo $pago_trabajadores->$id ?></td>
              <td><?php echo $pago_trabajadores->$fecha_inicio ?></td>
              <td><?php echo $pago_trabajadores->$fecha_fin ?></td>
              <td><?php echo $pago_trabajadores->$subtotal ?></td>
              <td><?php echo $pago_trabajadores->$valor_hora ?></td>
              <td><?php echo $pago_trabajadores->$horas_extras ?></td>
              <td><?php echo pagoTrabajadoresTableClass::getNameFieldForaneaTrabajador($pago_trabajadores->$id_trabajador) ?></td>
              <td><?php echo $pago_trabajadores->$cantidad_dias ?></td>       
            </tr>
<?php endforeach; ?> 
        </tbody>
      </table>
      <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'index') ?>"><i class="fa fa-hand-o-left"> </i> <?php echo i18n::__('return') ?></a>
    </section>
    <footer>
    </footer>
  </div>
</div>