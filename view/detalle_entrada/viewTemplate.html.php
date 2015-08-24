<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view; ?>
<?php use mvc\config\configClass as config?>
<?php use mvc\request\requestClass as request?>
<?php use mvc\session\sessionClass as session?>
<?php $id = detalleEntradaTableClass::ID ;?>
<?php $valor = detalleEntradaTableClass::VALOR ;?>
<?php $id_entrada_bodega = detalleEntradaTableClass::ID_ENTRADA_BODEGA ?>
<?php $id_insumo = detalleEntradaTableClass::ID_INSUMO; ?>
<?php $id_tipo_insumo = detalleEntradaTableClass::ID_TIPO_INSUMO; ?>
<!-- ENTRADA BODEGA -->
<?php $idE = entradaBodegaTableClass::ID ;?>
<?php $fecha = entradaBodegaTableClass::FECHA ;?>
<?php $hora = entradaBodegaTableClass::HORA ?>
<?php $id_trabajador = entradaBodegaTableClass::ID_TRABAJADOR ?>
<?php $id_proveedor = entradaBodegaTableClass::ID_PROVEEDOR; ?>
<!-- FIN ENTRADA BODEGA -->
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <!-- ENTRADA BODEGA -->
    <div class="page page-header text-center">
        <h3><i class="fa fa-paw"><?php echo i18n::__('entry_cellar') ?></i></h3>
    </div>
            <table class="table table-bordered table-responsive table-condensed">
                <thead>
                    <tr class="active">
                        <th><?php echo i18n::__('id') ?></th>
                        <th><?php echo i18n::__('date') ?></th>
                        <th><?php echo i18n::__('time') ?></th>
                        <th><?php echo i18n::__('id_employee') ?></th>
                        <th><?php echo i18n::__('id_provider') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objEntradaBodega as $entrada_bodega): ?>
                        <tr>
                            <td><?php echo $entrada_bodega->$idE ?></td>
                            <td><?php echo $entrada_bodega->$fecha ?></td>
                            <td><?php echo $entrada_bodega->$hora ?></td>
                            <td><?php echo entradaBodegaTableClass::getNameFieldForaneaTrabajador($entrada_bodega->$id_trabajador) ?></td>
                            <td><?php echo entradaBodegaTableClass::getNameFieldForaneaProveedor($entrada_bodega->$id_proveedor) ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
    <!-- FIN DE ENTRADA BODEGA -->
    <div class="page page-header text-center">
        <h3><i class="fa fa-paw"><?php echo i18n::__('entry_detail') ?></i></h3>
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
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('detalle_entrada', 'index')?>">
                                <?php view::getMessageError('errorValueCreate')?>
                                <div class="form-group">
                                    <label for="filterValue1" class="col-sm-2 control-label"><?php echo i18n::__('value').' ';echo i18n::__('start')?></label>
                                    <div class="col-sm-10">
                                        <input type="number" name="filter[valorInicio1]" class="form-control" id="filterValorInicio1" placeholder="<?php echo i18n::__('value').' ';echo i18n::__('start')?>">
                                    </div>
                                </div>
                                <?php view::getMessageError('errorValueEnd')?>
                                <div class="form-group">
                                    <label for="filterValue2" class="col-sm-2 control-label"><?php echo i18n::__('value').' ';echo i18n::__('end')?></label>
                                    <div class="col-sm-10">
                                        <input type="number" name="filter[valorInicio2]" class="form-control" id="filterValorInicio2" placeholder="<?php echo i18n::__('value').' ';echo i18n::__('end')?>">
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
            <?php if(session::getInstance()->hasFlash('modalFilter')): ?>
            <script>
                $(document).ready(function(){
                    $('#myModalFILTROS').modal('toggle');
                });
            </script>
            <?php endif ?>
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
                            <form method="POST" class="form-horizontal" id="reportFilterForm" action="<?php  echo routing::getInstance()->getUrlWeb('detalle_entrada', 'report')?>">
                                <div class="form-group">
                                    <label for="reportValor1" class="col-sm-2 control-label"><?php echo i18n::__('value').' ';echo i18n::__('start')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="report[valorInicio1]" class="form-control" id="filterValor1" placeholder="<?php echo i18n::__('value').' ';echo i18n::__('start')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reportValor2" class="col-sm-2 control-label"><?php echo i18n::__('value').' ';echo i18n::__('end')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="report[valorInicio2]" class="form-control" id="filterValor2" placeholder="<?php echo i18n::__('value').' ';echo i18n::__('end')?>">
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

            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('detalle_entrada', 'deleteSelect') ?>" method="POST">
                <div class="botones">
                    <!-- Permisos para los diferentes Usuarios -->
                    <?php if(session::getInstance()->hasCredential('admin')):?>
                    <a href="<?php echo routing::getInstance()->getUrlWeb('detalle_entrada', 'insert',array(entradaBodegaTableClass::ID => $entrada_bodega->$idE)) ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
                    <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                    <?php endif;?>
                    <!-- Fin -->
                    <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                    <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('detalle_entrada', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalFILTROSREPORTE" ><i class="fa fa-file-pdf-o"><?php echo i18n::__('report')?></i></a>
                </div>
                    <?php view::includeHandlerMessage() ?>
                <table class="table table-bordered table-responsive table-condensed">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('id') ?></th>
                            <th><?php echo i18n::__('value') ?></th>
                            <th><?php echo i18n::__('id_entry_cellar') ?></th>
                            <th><?php echo i18n::__('id_input') ?></th>
                            <th><?php echo i18n::__('id_type_input') ?></th>
                            <th><?php echo i18n::__('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $objDetalleEntrada as $detalle_entrada ): ?>
                            <tr>
                                <td><input type="checkbox" name="chk[]" value="<?php echo $detalle_entrada->$id ?>"></td>
                                <td><?php echo $detalle_entrada->$id ?></td>
                                <td><?php echo $detalle_entrada->$valor ?></td>
                                <td><?php echo $detalle_entrada->$id_entrada_bodega ?></td>
                                <td><?php echo detalleEntradaTableClass::getNameFieldForaneaInsumo($detalle_entrada->$id_insumo) ?></td>
                                <td><?php echo detalleEntradaTableClass::getNameFieldForaneaTipoInsumo($detalle_entrada->$id_tipo_insumo) ?></td>
                                <td>
                                    <div class="btn btn-group btn-xs">
                                        <a href="<?php echo routing::getInstance()->getUrlWeb('detalle_entrada','view', array(detalleEntradaTableClass::ID => $detalle_entrada->$id)) ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                       <!-- PErmisos para los Usuarios-->
                                       <?php if(session::getInstance()->hasCredential('admin')) : ?>
                                       <a href="<?php echo routing::getInstance()->getUrlWeb('detalle_entrada','edit', array(detalleEntradaTableClass::ID => $detalle_entrada->$id,entradaBodegaTableClass::ID => $entrada_bodega->$idE)) ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a data-toggle="modal" data-target="#myModalDelete<?php echo $detalle_entrada->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                        <?php endif;?>
                                        <!-- -->
                                    </div>
                                </td>
                            </tr>
                            <!--Ventana MODAL ELIMINAR SIMPLE-->
                        <div class="modal fade" id="myModalDelete<?php echo $detalle_entrada->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo i18n::__('Do you want to delete the record?') ?> <?php echo $detalle_entrada->$id ?> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $detalle_entrada->$id ?>, '<?php echo detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('detalle_entrada', 'delete') ?>', '<?php echo routing::getInstance()->getUrlWeb('detalle_entrada', 'index') ?>')"><?php echo i18n::__('confirm') ?></button>
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
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('detalle_entrada', 'view',array(entradaBodegaTableClass::ID => $entrada_bodega->$idE))?>')">
                    <?php for($x = 1;$x <= $cntPages;$x++):?>
                    <option <?php echo (isset($page) and $page == $x)? 'selected': '' ?> value="<?php echo $x?>"><?php echo $x?></option>
                    <?php endfor; ?>
                </select> de <?php echo $cntPages?>
                <!--
                <nav>
                <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li><a id="sqlPaginador" href="#" onclick="paginador(this)" value="1">1</a></li>
                        <li><a id="sqlPaginador" href="#" onclick="paginador(this)" value="2">2</a></li>
                        <li><a id="sqlPaginador" href="#" onclick="paginador(this)">3</a></li>
                        <li><a id="sqlPaginador" href="#" onclick="paginador(this)">4</a></li>
                        <li><a id="sqlPaginador" href="#" onclick="paginador(this)">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                    </nav>
                -->
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