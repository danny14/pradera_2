<?php

use mvc\routing\routingClass as routing; ?>
<?php

use mvc\i18n\i18nClass as i18n; ?>
<?php

use mvc\view\viewClass as view ?>
<?php $id = salidaBodegaTableClass::ID ?>
<?php $fecha = salidaBodegaTableClass::FECHA ?>
<?php $id_trabajador = salidaBodegaTableClass::ID_TRABAJADOR ?>
<?php $trabajador_id = trabajadorTableClass::ID ?>
<?php $nombre = trabajadorTableClass::NOMBRE ?>

<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
  <div class="page page-header text-center">
    <h1><?php echo i18n::__('Output_bodega') ?></h1>
  </div>
  <div class="row">
    <header>

    </header>
    <nav>

    </nav>
    <section>
      <!-- Ventana Modal para los Filtros -->
      <div class="modal fade" id="myModalFILTROS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filters') ?></h4>
            </div>
            <div class="modal-body">
              <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'index') ?>">

                <div class="form-group">
                  <label for="filterDate" class="col-sm-2 control-label"><?php echo i18n::__('date') ?></label>
                  <div class="col-sm-10">
                    <input type="date" name="filter[Fecha]" class="form-control" id="filterFecha" placeholder="<?php echo i18n::__('date') ?>">
                  </div>
                </div>

                <div class="form-group"> <!--filtro para llamar foranea-->
                  <label for="filterEmployee" class="col-sm-2 control-label"><?php echo i18n::__('employee') ?></label>
                  <div class="col-sm-10">
                    <select class="form-control" id="filterTrabajador" name="filter[Trabajador]">
                      <option value=""><?php echo i18n::__('selectEmployee') ?></option>
<?php foreach ($objTrabajador as $nombre_trabajador): ?>
                        <option value="<?php echo $nombre_trabajador->$trabajador_id ?>"><?php echo $nombre_trabajador->$nombre ?></option>
<?php endforeach; ?>
                    </select>
                  </div>
                </div><!--fin de filtro-->


              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
              <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary"><?php echo i18n::__('filter') ?></button>
            </div>
          </div>
        </div>
      </div>
      <!--Fin Ventana Modal Filtros-->

      <!-- Ventana Modal para los Reportes -->
      <div class="modal fade" id="myModalREPORTES" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('generate report') ?></h4>
            </div>
            <div class="modal-body">
              <form method="POST" class="form-horizontal" id="reportForm" action="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'report') ?>">

                <div class="form-group">
                  <label for="reportDate" class="col-sm-2 control-label"><?php echo i18n::__('date') ?></label>
                  <div class="col-sm-10">
                    <input type="date" name="report[fecha]" class="form-control" id="reportFecha" placeholder="<?php echo i18n::__('date') ?>">
                  </div>
                </div>
                
                <div class="form-group"><!--filtro para llamar foranea-->
                  <label for="filterEmployee" class="col-sm-2 control-label"><?php echo i18n::__('employee') ?></label>
                  <div class="col-sm-10">
                    <select class="form-control" id="filterTrabajador" name="filter[Trabajador]">
                      <option value=""><?php echo i18n::__('trabajador') ?></option>
<?php foreach ($objTrabajador as $nombre_trabajador): ?>
                        <option value="<?php echo $nombre_trabajador->$trabajador_id ?>"><?php echo $nombre_trabajador->$nombre ?></option>
<?php endforeach; ?>
                    </select>
                  </div>
                </div><!--fin de filtro-->


              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
              <button type="button" onclick="$('#reportForm').submit()" class="btn btn-primary"><?php echo i18n::__('generate report') ?></button>
            </div>
          </div>
        </div>
      </div>
      <!--Fin Ventana Modal Reportes-->

      <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'deleteSelect') ?>" method="POST">
        <div>
          <a href="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
          <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
          <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters') ?></a>
          <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'deleteFilters') ?>" ><?php echo i18n::__('delete') . " ";
        echo i18n::__('filters') ?></a>
          <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalREPORTES"><i class=" fa fa-file-pdf-o"> <?php echo i18n::__('report') ?></i></a>
        </div>
<?php view::includeHandlerMessage() ?>
        <table class="table table-bordered table-responsive table-condensed">
          <thead>
            <tr class="active">
              <th><input type="checkbox" id="chkAll"></th>
              <th><?php echo i18n::__('id') ?></th>
              <th><?php echo i18n::__('date') ?></th>
              <th><?php echo i18n::__('id_employee') ?></th> 
              <th><?php echo i18n::__('action') ?></th>
            </tr>
          </thead>
          <tbody>
<?php foreach ($objSalidaBodega as $salida_bodega): ?>
              <tr>
                <td><input type="checkbox" name="chk[]" value="<?php echo $salida_bodega->$id ?>"></td>
                <td><?php echo $salida_bodega->$id ?></td>
                <td><?php echo $salida_bodega->$fecha ?></td>
                <td><?php echo salidaBodegaTableClass::getNameFieldForaneaTrabajador($salida_bodega->$id_trabajador) ?></td>

                <td>
                  <div class="btn btn-group btn-xs">
                    <a href="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'view', array(salidaBodegaTableClass::ID => $salida_bodega->$id)) ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'edit', array(salidaBodegaTableClass::ID => $salida_bodega->$id, salidaBodegaTableClass::ID_TRABAJADOR => $salida_bodega->$id_trabajador)) ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                    <a data-toggle="modal" data-target="#myModalDelete<?php echo $salida_bodega->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                  </div>
                </td>
              </tr>
              <!--Ventana MODAL ELIMINAR SIMPLE-->
            <div class="modal fade" id="myModalDelete<?php echo $salida_bodega->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                  </div>
                  <div class="modal-body">
  <?php // echo i18n::__('Do you want to delete the record?')  ?> <?php // echo $salida_bodega->$  ?> 
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $salida_bodega->$id ?>, '<?php echo salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'delete') ?>')"><?php echo i18n::__('confirm') ?></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Fin de la ventana MODAL -->
          <?php endforeach; ?> 
          </tbody>
        </table>
      </form>
      <div>
        Pagina<select id="sqlPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'index') ?>')">
<?php for ($x = 1; $x <= $cntPages; $x++): ?>
            <option <?php echo (isset($page) and $page == $x) ? 'selected' : '' ?> value="<?php echo $x ?>"><?php echo $x ?></option>
<?php endfor; ?>
        </select> de <?php echo $cntPages ?>
      </div>
    </section>
    <footer>

    </footer>
  </div>
</div>
<!-- Ventana MODAL ELIMINAR MASIVO -->
<div class="modal fade" id="myModalDeleteMasivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') . " ";
echo i18n::__('selected_items')
?></h4>
      </div>
      <div class="modal-body">
<?php echo i18n::__('Do you want to remove the selected records?') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
        <button type="button" class="btn btn-danger" onclick="$('#frmDeleteAll').submit()"><?php echo i18n::__('confirm') ?></button>
      </div>
    </div>
  </div>
</div>
