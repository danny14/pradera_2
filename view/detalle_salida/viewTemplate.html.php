<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = detalleSalidaTableClass::ID ?>
<?php $cantidad= detalleSalidaTableClass::CANTIDAD ?>
<?php $id_salida_bodega = detalleSalidaTableClass::ID_SALIDA_BODEGA ?>
<?php $id_insumo = detalleSalidaTableClass::ID_INSUMO ?>
<?php $id_tipo_insumo = detalleSalidaTableClass::ID_TIPO_INSUMO ?>
<?php $nombre_insumo = insumoTableClass::NOMBRE ?>
<?php $salida_bodega_id = salidaBodegaTableClass::ID ?>
<?php $insumo_id = insumoTableClass::ID ?>
<?php $nombre = insumoTableClass::NOMBRE ?>
<?php $idS = salidaBodegaTableClass::ID ?>
<?php $fecha = salidaBodegaTableClass::FECHA ?>
<?php $id_trabajador = salidaBodegaTableClass::ID_TRABAJADOR ?>

<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
<h1><i class="fa fa-paw"><?php echo i18n::__('Output_bodega')?></i></h1>
<div class="container container-fluid">
  <div class="page page-header text-center">
    <table class="table table-bordered table-responsive table-condensed">
                <thead>
                    <tr class="active">
                       
                      
                        <th><?php echo i18n::__('date')?></th>
                        <th><?php echo i18n::__('id_employee')?></th>              
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objSalidaBodega as $salida_bodega): ?>
                    <tr>
                        
                     
                        <td><?php echo $salida_bodega->$fecha ?></td>
                        <td><?php echo salidaBodegaTableClass::getNameFieldForaneaTrabajador($salida_bodega->$id_trabajador) ?></td>
                               
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
    <h1><i class="fa fa-paw"><?php echo i18n::__('output_of_cellars_details') ?></i></h1>
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
              <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('detalle_salida', 'index') ?>">

                <div class="form-group"> <!--filtro para llamar foranea-->
                  <label for="filterSalidaBodega" class="col-sm-2 control-label"><?php echo i18n::__('salida_bodega') ?></label>
                  <div class="col-sm-10">
                    <select class="form-control" id="filterSalidaBodega" name="filter[Salida_bodega]">
                      <option value=""><?php echo i18n::__('salida_bodega') ?></option>
<?php foreach ($objSalidaBodega as $id_salida): ?>
                        <option value="<?php echo $id_salida->$salida_bodega_id ?>"><?php echo $id_salida->$salida_bodega_id ?></option>
<?php endforeach; ?>
                    </select>
                  </div>
                </div> <!--fin de filtro foranea-->
<div class="form-group"> <!--filtro para llamar foranea-->
                  <label for="filterInput" class="col-sm-2 control-label"><?php echo i18n::__('input') ?></label>
                  <div class="col-sm-10">
                    <select class="form-control" id="filterInsumo" name="filter[Input]">
                      <option value=""><?php echo i18n::__('input') ?></option>
<?php foreach ($objInsumo as $nombre_insumo): ?>
                        <option value="<?php echo $nombre_insumo->$insumo_id ?>"><?php echo $nombre_insumo->$nombre ?></option>
<?php endforeach; ?>
                    </select>
                  </div>
                </div> <!--fin de filtro-->


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
              <form method="POST" class="form-horizontal" id="reportForm" action="<?php echo routing::getInstance()->getUrlWeb('detalle_salida', 'report') ?>">

                 <div class="form-group"> <!--filtro para llamar foranea-->
                  <label for="filterSalidaBodega" class="col-sm-2 control-label"><?php echo i18n::__('salida_bodega') ?></label>
                  <div class="col-sm-10">
                    <select class="form-control" id="filterSalidaBodega" name="filter[Salida_bodega]">
                      <option value=""><?php echo i18n::__('salida_bodega') ?></option>
<?php foreach ($objSalidaBodega as $id_salida): ?>
                        <option value="<?php echo $id_salida->$salida_bodega_id ?>"><?php echo $id_salida->$id_salida_bodega ?></option>
<?php endforeach; ?>
                    </select>
                  </div>
                </div> <!--fin de filtro foranea-->
<div class="form-group"> <!--filtro para llamar foranea-->
                  <label for="filterInsumo" class="col-sm-2 control-label"><?php echo i18n::__('input') ?></label>
                  <div class="col-sm-10">
                    <select class="form-control" id="filterInsumo" name="filter[Insumo]">
                      <option value=""><?php echo i18n::__('input') ?></option>
<?php foreach ($objInsumo as $nombre_insumo): ?>
                        <option value="<?php echo $nombre_insumo->$insumo_id ?>"><?php echo $nombre_insumo->$nombre ?></option>
<?php endforeach; ?>
                    </select>
                  </div>
                </div> <!--fin de filtro-->


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

      <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('detalle_salida', 'deleteSelect') ?>" method="POST">
        <div>
          <a href="<?php echo routing::getInstance()->getUrlWeb('detalle_salida', 'insert',array(salidaBodegaTableClass::ID => $salida_bodega->$idS)) ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
          <!--<a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php // echo i18n::__('delete') ?></a>-->
          <!--<a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php // echo i18n::__('filters') ?></a>-->
         <!-- <a class="btn btn-default btn-xs" href="<?php // echo routing::getInstance()->getUrlWeb('detalle_salida', 'deleteFilters') ?>" ><?php // echo i18n::__('delete') . " ";
//        echo i18n::__('filters') ?></a>-->
          <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalREPORTES"><i class=" fa fa-file-pdf-o"> <?php echo i18n::__('report') ?></i></a>
          <a class="btn btn-info btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'index')?>"><i class="fa fa-hand-o-left"> </i> <?php echo i18n::__('return')?></a>
        </div>
        
<?php view::includeHandlerMessage() ?>
        <table class="table table-bordered table-responsive table-condensed">
          <thead>
            <tr class="active">
              <th><input type="checkbox" id="chkAll"></th>
              
              <th><?php echo i18n::__('quantity') ?></th>
              <th><?php echo i18n::__('id_salida_bodega') ?></th>
              <th><?php echo i18n::__('id_input') ?></th>
              <th><?php echo i18n::__('id_type_input') ?></th>
              <th><?php echo i18n::__('action') ?></th>
            </tr>
          </thead>
          <tbody>
<?php foreach ($objDetalleSalida as $detalle_salida): ?>
              <tr>
                <td><input type="checkbox" name="chk[]" value="<?php echo $detalle_salida->$id ?>"></td>
                
                <td><?php echo $detalle_salida->$cantidad ?></td>
                <td><?php echo detalleSalidaTableClass::getNameFieldForaneaSalidaBodega($detalle_salida->$id_salida_bodega) ?></td>
                <td><?php echo detalleSalidaTableClass::getNameFieldForaneaInsumo($detalle_salida->$id_insumo) ?></td>
                <td><?php echo detalleSalidaTableClass::getNameFieldForaneaTipoInsumo($detalle_salida->$id_tipo_insumo) ?></td>

                <td>
                  <div class="btn btn-group btn-xs">
<!--                    <a href="<?php echo routing::getInstance()->getUrlWeb('detalle_salida', 'view', array(detalleSalidaTableClass::ID => $detalle_salida->$id_salida_bodega)) ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>-->
                    <a href="<?php echo routing::getInstance()->getUrlWeb('detalle_salida', 'edit', array(detalleSalidaTableClass::ID => $detalle_salida->$id_salida_bodega)) ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                    <a data-toggle="modal" data-target="#myModalDelete<?php echo $detalle_salida->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                  
              
                   
                  </div>   
                </td>
              </tr>
                 
              <!--Ventana MODAL ELIMINAR SIMPLE-->
            <div class="modal fade" id="myModalDelete<?php echo $detalle_salida->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $detalle_salida->$id ?>, '<?php echo detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('detalle_salida', 'delete') ?>')"><?php echo i18n::__('confirm') ?></button>
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
        Pagina<select id="sqlPaginador" onchange="paginador(this, '<?php echo routing::getInstance()->getUrlWeb('detalle_salida', 'index') ?>')">
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
</div>