<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\config\configClass as config?>
<?php use mvc\request\requestClass as request?>
<?php use mvc\session\sessionClass as session?>
<?php $id = pagoTrabajadoresTableClass::ID ;?>
<?php $fecha_inicio = pagoTrabajadoresTableClass::FECHA_INICIO ;?>
<?php $fecha_fin = pagoTrabajadoresTableClass::FECHA_FIN ;?>
<?php $subtotal = pagoTrabajadoresTableClass::SUBTOTAL;?>
<?php $valor_hora= pagoTrabajadoresTableClass::VALOR_HORA ;?>
<?php $id_trabajador = pagoTrabajadoresTableClass::ID_TRABAJADOR ;?>
<?php $horas_extras = pagoTrabajadoresTableClass::HORAS_EXTRAS ;?>
<?php $cantidad_dias = pagoTrabajadoresTableClass::CANTIDAD_DIAS ;?>
<?php $trabajador_id = trabajadorTableClass::ID ;?>
<?php $nombre = trabajadorTableClass::NOMBRE ;?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <div class="page page-header text-center">
    <h1><?php echo i18n::__('payment of employee') ?></h1>
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
                            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('filters')?></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'index')?>">
                                
                                <div class="form-group">
                                    <label for="filterStart_date" class="col-sm-2 control-label"><?php echo i18n::__('start_date')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="filter[fecha_inicio]" class="form-control" id="filterFecha" placeholder="<?php echo i18n::__('start_date')?>">
                                    </div>
                                </div>
                              
                              <div class="form-group">
                                    <label for="filterNumber of days" class="col-sm-2 control-label"><?php echo i18n::__('number of days')?></label>
                                    <div class="col-sm-10">
                                      <input type="number" name="filter[Cantidad_dias]" class="form-control" id="filter[Cantidad_dias]" placeholder="<?php echo i18n::__('number of days')?>">
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
                        </div> <!--fin de filtro-->

                              
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close')?></button>
                            <button type="button" onclick="$('#filterForm').submit()" class="btn btn-primary"><?php echo i18n::__('filter')?></button>
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
                            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('generate report')?></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form-horizontal" id="reportForm" action="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'report')?>">
                             <div class="form-group">
                                    <label for="filterStart_date" class="col-sm-2 control-label"><?php echo i18n::__('start_date')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="filter[fecha_inicio]" class="form-control" id="filterFecha" placeholder="<?php echo i18n::__('start_date')?>">
                                    </div>
                                </div>
                              
                              <div class="form-group">
                                    <label for="filterNumber of days" class="col-sm-2 control-label"><?php echo i18n::__('number of days')?></label>
                                    <div class="col-sm-10">
                                      <input type="number" name="filter[Cantidad_dias]" class="form-control" id="filter[Cantidad_dias]" placeholder="<?php echo i18n::__('number of days')?>">
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
                        </div> <!--fin de filtro-->
                        
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close')?></button>
                            <button type="button" onclick="$('#reportForm').submit()" class="btn btn-primary"><?php echo i18n::__('generate report')?></button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fin Ventana Modal Reportes-->
            <!--Formulario para el Cambio de Idiomas-->
            <?php view::includePartial('animal/formTraductor')?>
            <!-- Fin del Formulario de Cambio de Idiomas-->
            
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'deleteSelect') ?>" method="POST">
                <div>
                    <a href="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
                    <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                    <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                    <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalREPORTES"><i class=" fa fa-file-pdf-o"> <?php echo i18n::__('report')?></i></a>
                </div>
                    <?php view::includeHandlerMessage() ?>
                <table class="table table-bordered table-responsive table-condensed">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('start_date') ?></th>
                            <th><?php echo i18n::__('end_date') ?></th>
                            <th><?php echo i18n::__('subtotal') ?></th>
                            <th><?php echo i18n::__('time_value') ?></th>
                            <th><?php echo i18n::__('employee') ?></th>
                            <th><?php echo i18n::__('extra_time') ?></th>
                            <th><?php echo i18n::__('number of days') ?></th>
                         
                            <th><?php echo i18n::__('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objPagoTrabajadores as $pago_trabajadores): ?>
                            <tr>
                                <td><input type="checkbox" name="chk[]" value="<?php echo $pago_trabajadores->$id ?>"></td>
                                <td><?php echo $pago_trabajadores->$fecha_inicio ?></td>
                                <td><?php echo $pago_trabajadores->$fecha_fin ?></td>
                                <td><?php echo '$' . number_format($pago_trabajadores->$subtotal, 0, ',', '.') ?></td>
                                <td><?php echo '$' . number_format($pago_trabajadores->$valor_hora,0, ',', '.') ?></td>
                                <td><?php echo pagoTrabajadoresTableClass::getNameFieldForaneaTrabajador($pago_trabajadores->$id_trabajador) ?></td>
                                <td><?php echo $pago_trabajadores->$horas_extras ?></td>
                                <td><?php echo $pago_trabajadores->$cantidad_dias?></td>
                                
                                <td>
                                    <div class="btn btn-group btn-xs">
                                        <a href="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'view', array(pagoTrabajadoresTableClass::ID => $pago_trabajadores->$id)) ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                        <a href="<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'edit', array(pagoTrabajadoresTableClass::ID => $pago_trabajadores->$id, pagoTrabajadoresTableClass::ID_TRABAJADOR => $pago_trabajadores->$id_trabajador)) ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a data-toggle="modal" data-target="#myModalDelete<?php echo $pago_trabajadores->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <!--Ventana MODAL ELIMINAR SIMPLE-->
                        <div class="modal fade" id="myModalDelete<?php echo $pago_trabajadores->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php // echo i18n::__('Do you want to delete the record?') ?> <?php // echo $repote_parto->$fecha_fin ?> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $pago_trabajadores->$id ?>, '<?php echo pagoTrabajadoresTableClass::getNameField(pagoTrabajadoresTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'delete') ?>', '<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'index') ?>')"><?php echo i18n::__('confirm') ?></button>
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
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('pago_trabajadores', 'index')?>')">
                    <?php for($x = 1;$x <= $cntPages;$x++):?>
                    <option <?php echo (isset($page) and $page == $x)? 'selected': '' ?> value="<?php echo $x?>"><?php echo $x?></option>
                    <?php endfor; ?>
                </select> de <?php echo $cntPages?>
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
