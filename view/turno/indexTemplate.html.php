<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view;?>
<?php $id = turnoTableClass::ID?>
<?php $descripcion = turnoTableClass::DESCRIPCION?>
<?php $inicio_turno = turnoTableClass::INICIO_TURNO ?>
<?php $fin_turno = turnoTableClass::FIN_TURNO ?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <div class="page page-header text-center">
    <h1><i class="fa fa-paw"><?php echo i18n::__('turn')?></i></h1>
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
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('turno', 'index')?>">
                                <div class="form-group">
                                    <label for="filterName" class="col-sm-2 control-label"><?php echo i18n::__('description')?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filterDescripcion" name="filter[descripcion]" placeholder="<?php echo i18n::__('description')?>">
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
            <!-- Formulario del IDIOMA -->
            <?php view::includePartial('animal/formTraductor')?>
            <!-- FIN FORMULARIO IDIOMA -->
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('turno', 'deleteSelect') ?>" method="POST">
                <div class="botones">
                <a href="<?php echo routing::getInstance()->getUrlWeb('turno', 'insert')?>" class="btn btn-success btn-xs">Nuevo</a>
                <a onclick="eliminarMasivo()" class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                <a class="btn btn-default btn-xs" href="<?php // routing::getInstance()->getUrlWeb('animal', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
            </div>
                <?php view::includeHandlerMessage() ?>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"></th>
                        <th><?php echo i18n::__('id')?></th>
                        <th><?php echo i18n::__('description')?></th>
                        <th><?php echo i18n::__('start_turn')?></th>
                        <th><?php echo i18n::__('end_turn')?></th>
                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objTurno as $turno): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php $turno->$id ?>"></td>
                        <td><?php echo $turno->$id ?></td>
                        <td><?php echo $turno->$descripcion ?></td>
                        <td><?php echo $turno->$inicio_turno ?></td>
                        <td><?php echo $turno->$fin_turno ?></td>
                        <td>
                            <div class="btn btn-group btn-xs">
                                <a href="<?php echo routing::getInstance()->getUrlWeb('turno', 'view',array(turnoTableClass::ID => $turno->$id))?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"><?php?></i></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('turno', 'edit', array(turnoTableClass::ID => $turno->$id));?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a data-toggle="modal" data-target="#myModalDelete<?php echo $turno->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!--Ventana MODAL ELIMINAR SIMPLE-->
                        <div class="modal fade" id="myModalDelete<?php echo $turno->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo i18n::__('Do you want to delete the record?') ?> <?php echo $turno->$descripcion ?> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $turno->$id ?>, '<?php echo turnoTableClass::getNameField(turnoTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('turno', 'delete') ?>')"><?php echo i18n::__('confirm') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin de la ventana MODAL -->
                    <?php endforeach; ?> 
                </tbody>
                <tfoot>
                    
                </tfoot>
                
            </table>
            </form>
            <div>
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('turno', 'index')?>')">
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
<!-- Ventana MODAL ELIMINAR MASIVO-->
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