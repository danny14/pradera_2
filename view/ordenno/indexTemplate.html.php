<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session ?>
<?php $id = ordennoTableClass::ID ?>
<?php $fecha_ordenno =ordennoTableClass::FECHA_ORDENNO ?>
<?php $cantidad_leche =ordennoTableClass::CANTIDAD_LECHE ?>
<?php $id_trabajador =ordennoTableClass::ID_TRABAJADOR ?>
<?php $id_animal =ordennoTableClass::ID_ANIMAL ?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
  <div class="page page-header text-center">  
  <h1><i class="fa fa-ship"><?php echo i18n::__('ordenno')?></i></h1>
   
    </div>
    <div class="row" >
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
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php //echo routing::getInstance()->getUrlWeb('ordenno', 'index') ?>">
                                <div class="form-group">
                                    <label for="filterdate_ordenno" class="col-sm-2 control-label"><?php echo i18n::__('date_ordenno') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filterFecha_ordenno" name="filter[fecha_ordenno]" placeholder="<?php echo i18n::__('date_ordenno') ?>">
                                    </div>
                                </div>
                                   <div class="form-group">
                                    <label for="filterquantity_milk" class="col-sm-2 control-label"><?php echo i18n::__('quantity_milk') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filterCantidad_leche" name="filter[cantidad_leche]" placeholder="<?php echo i18n::__('quantity_milk') ?>">
                                    </div>
                                </div>
                               
                              </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                            <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary"><?php echo i18n::__('filter') ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(session::getInstance()->hasFlash('modalFilter')): ?>
            <script>
                $(document).ready(function(){
                    $('#myModalFILTROS').modal('toggle');
                });
            </script>
            <?php endif ?>
            <!--Fin Ventana Modal Filtros-->
            
             <!-- Ventana Modal para los reportes -->
            <div class="modal fade" id="myModalREPORTES" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('generate report') ?></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form-horizontal" id="reportForm" action="<?php // echo routing::getInstance()->getUrlWeb('ordenno', 'report') ?>">
                                <div class="form-group">
                                    <label for="reportDate_ordenno" class="col-sm-2 control-label"><?php echo i18n::__('date_ordenno') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reportFecha_ordenno" name="report[fecha_ordenno]" placeholder="<?php echo i18n::__('date_ordenno') ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reportQuantity_milk" class="col-sm-2 control-label"><?php echo i18n::__('quantity_milk') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reportCantidad_leche" name="report[cantidad_leche]" placeholder="<?php echo i18n::__('quantity_milk') ?>">
                                    </div>
                            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                            <button type="button" onclick="$('#reportForm').submit()" class="btn btn-primary"><?php echo i18n::__('generate report') ?></button>
                        </div>
                    </div>
                </div>
            </div>
                </div></div>
            <!--Fin Ventana Modal reportes-->
            
            <!--Formulario del Traductor -->
            <?php view::includePartial('animal/formTraductor')?>
            <!--Fin Formulario del traductor -->
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('ordenno', 'deleteSelect') ?>" method="POST">
                <div id="botones">
                <a href="<?php echo routing::getInstance()->getUrlWeb('ordenno', 'insert')?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                    <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('ordenno', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalREPORTES" ><i class="fa fa-file-pdf-o"> <?php echo i18n::__('report')?></i></a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalGrafica" ><i class="fa fa-file-pdf-o"> Graficas </i></a>
            </div>
            <?php view::includeHandlerMessage() ?>
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"</th>
                        <th><?php echo i18n::__('date_ordenno')?></th>
                        <th><?php echo i18n::__('quantity_milk')?></th>
                        <th><?php echo i18n::__('id_employee')?></th>
                        <th><?php echo i18n::__('id_animal')?></th>
                        <th><?php echo i18n::__('action')?></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objOrdenno as $ordenno): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $ordenno->$id?>"></td>
                        <td><?php echo $ordenno->$fecha_ordenno?></td>
                        <td><?php echo $ordenno->$cantidad_leche?></td>
                        <td><?php echo ordennoTableClass::getNameFieldForaneaTrabajador($ordenno->$id_trabajador) ?></td>
                        <td><?php echo ordennoTableClass::getNameFieldForaneaAnimal($ordenno->$id_animal) ?></td>
                        
                        <td>
                            <div>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('ordenno', 'view',array(ordennoTableClass::ID => $ordenno->$id));?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('ordenno', 'edit',array(ordennoTableClass::ID => $ordenno->$id));?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a data-toggle="modal" data-target="#myModalDelete<?php echo $ordenno->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!--Ventana MODAL ELIMINAR SIMPLE-->
                    <div class="modal fade" id="myModalDelete<?php echo $ordenno->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                </div>
                                <div class="modal-body">
                                    <?php echo i18n::__('Do you want to delete the record?') ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $ordenno->$id ?>, '<?php echo ordennoTableClass::getNameField(ordennoTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('ordenno', 'delete') ?>','<?php echo routing::getInstance()->getUrlWeb('ordenno', 'index') ?>')"><?php echo i18n::__('confirm') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin de la ventana MODAL -->
                    <?php endforeach;?>
                </tbody>
                <tfoot></tfoot>
                
            </table>
            </form>
            <div>
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('ordenno', 'index') ?>')">
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
                echo i18n::__('selected_items') ?></h4>
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
<!------------------------------------->
<!-----------------Ventana Modal de Error Eliminar Individual----------------------->
<div class="modal fade" id="myModalErrorDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo "Este es un mensaje de error "?>;
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
            </div>
        </div>
    </div>
</div>
<!-----------------------------FIN-------------------------------------->
<!----------------- Ventana Modal  para el Grafico --------------------->
<div class="modal fade" id="myModalGrafica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Grafica</h4>
      </div>
      <div class="modal-body">
          <form  id="graficaForm" class="form-group" method="POST" action="<?php echo routing::getInstance()->getUrlWeb('ordenno', 'grafica')?>">
              <div class="form-group" >
                  <label class="control-label" for="start_date"><?php echo i18n::__('start_date') ?>:</label> 
                  <input name="start_date" class="form-control" type="date" value="" min="2014-01-01" step="1" required placeholder="<?php echo i18n::__('enterDateStart') ?>">
                  <?php if (session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
              </div>
              <div class="form-group" >
                  <label class="control-label" for="end_date"><?php echo i18n::__('end_date') ?>:</label> 
                  <input name="end_date" class="form-control" type="date" value="" min="2014-01-01" step="1" required placeholder="<?php echo i18n::__('enterDateEnd') ?>">
                  <?php if (session::getInstance()->hasFlash(ordennoTableClass::getNameField(ordennoTableClass::FECHA_ORDENNO, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="$('#graficaForm').submit()" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>
<!-----------------------------FIN-------------------------------------->