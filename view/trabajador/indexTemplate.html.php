<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view; ?>
<?php use mvc\config\configClass as config?>
<?php use mvc\request\requestClass as request?>
<?php use mvc\session\sessionClass as session?>
<?php $id = trabajadorTableClass::ID ;?>
<?php $nombre = trabajadorTableClass::NOMBRE ;?>
<?php $apellido = trabajadorTableClass::APELLIDO ?>
<?php $direccion = trabajadorTableClass::DIRECCION ?>
<?php $telefono = trabajadorTableClass::TELEFONO; ?>
<?php $id_turno = trabajadorTableClass::ID_TURNO ?>
<?php $id_credencial = trabajadorTableClass::ID_CREDENCIAL ?>
<?php $id_ciudad = trabajadorTableClass::ID_CIUDAD ?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <div class="page page-header text-center">
        <h1><i class="fa fa-paw"><?php echo i18n::__('employee') ?></i></h1>
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
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index')?>">
                                <div class="form-group" >
                                    <label for="filterName" class="col-sm-2 control-label"><?php echo i18n::__('name')?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filterNombre" name="filter[nombre]" placeholder="<?php echo i18n::__('name')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="filterDate1" class="col-sm-2 control-label"><?php echo i18n::__('date').' ';echo i18n::__('start')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="filter[fechaCreacion1]" class="form-control" id="filterCreacion1" placeholder="<?php echo i18n::__('date').' ';echo i18n::__('start')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="filterDate1" class="col-sm-2 control-label"><?php echo i18n::__('date').' ';echo i18n::__('end')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="filter[fechaCreacion2]" class="form-control" id="filterCreacion2" placeholder="<?php echo i18n::__('date').' ';echo i18n::__('end')?>">
                                    </div>
                                </div>
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
            <!-- VENTANA MODAL PARA REPORTES CON FILTROS -->
            <div class="modal fade" id="myModalFILTROSREPORTE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('generate report')?></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form-horizontal" id="reportFilterForm" action="<?php  echo routing::getInstance()->getUrlWeb('trabajador', 'report')?>">
                                <div class="form-group ">
                                    <label for="reportName" class="col-sm-2 control-label"><?php echo i18n::__('name')?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filterNombre" name="report[nombre]" placeholder="<?php echo i18n::__('name')?>">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reportDate1" class="col-sm-2 control-label"><?php echo i18n::__('date').' ';echo i18n::__('start')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="report[fechaCreacion1]" class="form-control" id="filterCreacion1" placeholder="<?php echo i18n::__('date').' ';echo i18n::__('start')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reportDate1" class="col-sm-2 control-label"><?php echo i18n::__('date').' ';echo i18n::__('end')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="report[fechaCreacion2]" class="form-control" id="filterCreacion2" placeholder="<?php echo i18n::__('date').' ';echo i18n::__('end')?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close')?></button>
                            <button type="button" onclick="$('#reportFilterForm').submit()" class="btn btn-primary"><?php echo i18n::__('generate')?></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN DE LOS FILTROS PARA REPORTE -->
            
            <!--Formulario para el Cambio de Idiomas-->
            <?php view::includePartial('animal/formTraductor')?>
            <!-- Fin del Formulario de Cambio de Idiomas-->

            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'deleteSelect') ?>" method="POST">
                <div class="botones">
                    <a href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
                    <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                    <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                    <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalFILTROSREPORTE" ><i class="fa fa-file-pdf-o"><?php echo i18n::__('report')?></i></a>
                </div>
                    <?php view::includeHandlerMessage() ?>
                <table class="table table-bordered table-responsive table-condensed">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('id') ?></th>
                            <th><?php echo i18n::__('name') ?></th>
                            <th><?php echo i18n::__('last_name') ?></th>
                            <th><?php echo i18n::__('address') ?></th>
                            <th><?php echo i18n::__('phone') ?></th>
                            <th><?php echo i18n::__('id_turn') ?></th>
                            <th><?php echo i18n::__('id_credential') ?></th>
                            <th><?php echo i18n::__('id_city') ?></th>
                            <th><?php echo i18n::__('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objTrabajador as $trabajador): ?>
                            <tr>
                                <td><input type="checkbox" name="chk[]" value="<?php echo $trabajador->$id ?>"></td>
                                <td><?php echo $trabajador->$id ?></td>
                                <td><?php echo $trabajador->$nombre ?></td>
                                <td><?php echo $trabajador->$apellido ?></td>
                                <td><?php echo $trabajador->$direccion ?></td>
                                <td><?php echo $trabajador->$telefono ?></td>
                                <td><?php echo trabajadorTableClass::getNameFieldForaneaRaza($trabajador->$id_turno) ?></td>
                                <td><?php echo trabajadorTableClass::getNameFieldForaneaRaza($trabajador->$id_credencial) ?></td>
                                <td><?php echo trabajadorTableClass::getNameFieldForaneaEstado($trabajador->$id_ciudad) ?></td>
                                <td>
                                    <div class="btn btn-group btn-xs">
                                        <a href="<?php echo routing::getInstance()->getUrlWeb('trabajador','view', array(trabajadorTableClass::ID => $trabajador->$id)) ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                        <a href="<?php echo routing::getInstance()->getUrlWeb('trabajador','edit', array(trabajadorTableClass::ID => $trabajador->$id, trabajadorTableClass::ID_TURNO => $trabajador->$id_turno, trabajadorTableClass::ID_CREDENCIAL => $trabajador->$id_credencial, trabajadorTableClass::ID_CIUDAD => $trabajador->$id_ciudad)) ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a data-toggle="modal" data-target="#myModalDelete<?php echo $trabajador->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <!--Ventana MODAL ELIMINAR SIMPLE-->
                        <div class="modal fade" id="myModalDelete<?php echo $trabajador->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo i18n::__('Do you want to delete the record?') ?> <?php echo $trabajador->$nombre ?> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $trabajador->$id ?>, '<?php echo trabajadorTableClass::getNameField(trabajadorTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('trabajador', 'delete') ?>', '<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index') ?>')"><?php echo i18n::__('confirm') ?></button>
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
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index')?>')">
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
<!------------------------------------->