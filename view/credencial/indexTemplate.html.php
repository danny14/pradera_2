<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view;?>
<?php use mvc\session\sessionClass as session;?>
<?php $id = credencialTableClass::ID?>
<?php $nombre = credencialTableClass::NOMBRE?>
<?php $created_at= credencialTableClass::CREATED_AT?>
<?php $updated_at = credencialTableClass::UPDATED_AT?>
<?php $deleted_at = credencialTableClass::DELETED_AT?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <div class="page page-header text-center">
    <h1><i class="fa fa-tags"><?php echo i18n::__('credential')?></i></h1>
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
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index')?>">
                                <div class="form-group">
                                    <label for="filterName" class="col-sm-2 control-label"><?php echo i18n::__('name')?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filter<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE)?>" name="filter[<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE)?>]" placeholder="<?php echo i18n::__('name')?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="filterDateCreate1" class="col-sm-2 control-label"><?php echo i18n::__('start')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="filter<?php echo credencialTableClass::getNameField(credencialTableClass::CREATED_AT, TRUE).'_1'?>" name="filter[<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE).'_1'?>]" placeholder="<?php echo i18n::__('start')?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="filterDateCreate2" class="col-sm-2 control-label"><?php echo i18n::__('end')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="filter<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE).'_2'?>" name="filter[<?php echo credencialTableClass::getNameField(credencialTableClass::NOMBRE, TRUE).'_2'?>]" placeholder="<?php echo i18n::__('end')?>">
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
            <!-- Formulario del IDIOMA -->
            <?php view::includePartial('animal/formTraductor')?>
            <!-- FIN FORMULARIO IDIOMA -->
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('credencial', 'deleteSelect') ?>" method="POST">
                <div class="botones">
                <?php if(session::getInstance()->hasCredential('admin')):?>
                <a href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'insert')?>" class="btn btn-success btn-xs">Nuevo</a>
                <a onclick="eliminarMasivo()" class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                <?php endif;?>
                <!--<a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php // echo i18n::__('filters')?></a>
                <a class="btn btn-default btn-xs" href="<?php//  routing::getInstance()->getUrlWeb('credencial', 'deleteFilters')?>" ><?php // echo i18n::__('delete')." ";echo i18n::__('filters')?></a> -->
            </div>
                <?php view::includeHandlerMessage() ?>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"></th>
                        <th><?php echo i18n::__('name')?></th>
                        <th><?php echo i18n::__('created_at')?></th>
                        <th><?php echo i18n::__('updated_at')?></th>
                        <th><?php echo i18n::__('deleted_at')?></th>
                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objCredencial as $credencial): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $credencial->$id ?>"></td>
                        <td><?php echo $credencial->$nombre ?></td>
                        <td><?php echo $credencial->$created_at ?></td>
                        <td><?php echo $credencial->$updated_at ?></td>
                        <td><?php echo $credencial->$deleted_at ?></td>
                        <td>
                            <div class="btn btn-group btn-xs">
                                <a href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'view',array(credencialTableClass::ID => $credencial->$id))?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"><?php?></i></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'edit', array(credencialTableClass::ID => $credencial->$id));?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a data-toggle="modal" data-target="#myModalDelete<?php echo $credencial->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!--Ventana MODAL ELIMINAR SIMPLE-->
                        <div class="modal fade" id="myModalDelete<?php echo $credencial->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo i18n::__('Do you want to delete the record?') ?> <?php echo $credencial->$nombre ?> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $credencial->$id ?>, '<?php echo credencialTableClass::getNameField(credencialTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('credencial', 'delete') ?>','<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>')"><?php echo i18n::__('confirm') ?></button>
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
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('credencial', 'index')?>')">
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
