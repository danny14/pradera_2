<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = fecundadorTableClass::ID ?>
<?php $nombre =fecundadorTableClass::NOMBRE ?>
<?php $edad =fecundadorTableClass::EDAD ?>
<?php $peso =fecundadorTableClass::PESO ?>
<?php $observacion =fecundadorTableClass::OBSERVACION ?>
<?php $id_raza =fecundadorTableClass::ID_RAZA ?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <div class="page page-header text-center">
    <h1><?php echo i18n::__('fecundador')?></h1>
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
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'index') ?>">
                                <div class="form-group">
                                    <label for="filterName" class="col-sm-2 control-label"><?php echo i18n::__('name') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filterNombre" name="filter[nombre]" placeholder="<?php echo i18n::__('name') ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="filterAge" class="col-sm-2 control-label"><?php echo i18n::__('age') ?></label>
                                    <div class="col-sm-10">
                                        <input type="number" name="filter[edad]" class="form-control" id="filterEdad" placeholder="<?php echo i18n::__('age') ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="filterWeight" class="col-sm-2 control-label"><?php echo i18n::__('weight') ?></label>
                                    <div class="col-sm-10">
                                        <input type="number" name="filter[peso]" class="form-control" id="filterPeso" placeholder="<?php echo i18n::__('weight')?>">
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
                            <form method="POST" class="form-horizontal" id="reportForm" action="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'report') ?>">
                                <div class="form-group">
                                    <label for="reportName" class="col-sm-2 control-label"><?php echo i18n::__('name') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reportNombre" name="report[nombre]" placeholder="<?php echo i18n::__('name') ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reportAge" class="col-sm-2 control-label"><?php echo i18n::__('age') ?></label>
                                    <div class="col-sm-10">
                                        <input type="number" name="report[edad]" class="form-control" id="reportEdad" placeholder="<?php echo i18n::__('age') ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reportWeight" class="col-sm-2 control-label"><?php echo i18n::__('weight') ?></label>
                                    <div class="col-sm-10">
                                        <input type="number" name="report[peso]" class="form-control" id="reportPeso" placeholder="<?php echo i18n::__('weight')?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                            <button type="button" onclick="$('#reportForm').submit()" class="btn btn-primary"><?php echo i18n::__('generate report') ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fin Ventana Modal reportes-->
            <?php view::includePartial('animal/formTraductor')?>
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'deleteSelect') ?>" method="POST">
                <div id="botones">
                <a href="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'insert')?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                    <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalREPORTES" ><i class="fa fa-file-pdf-o"> <?php echo i18n::__('report')?></i></a>
            </div>
            <?php view::includeHandlerMessage() ?>
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"</th>
                        <th><?php echo i18n::__('id')?></th>
                        <th><?php echo i18n::__('name')?></th>
                        <th><?php echo i18n::__('age')?></th>
                        <th><?php echo i18n::__('weight')?></th>
                        <th><?php echo i18n::__('observation')?></th>
                        <th><?php echo i18n::__('id_raza')?></th>
                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objFecundador as $fecundador): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $fecundador->$id?>"></td>
                        <td><?php echo $fecundador->$id?></td>
                        <td><?php echo $fecundador->$nombre?></td>
                        <td><?php echo $fecundador->$edad?></td>
                        <td><?php echo $fecundador->$peso?></td>
                        <td><?php echo $fecundador->$observacion?></td>
                        <td><?php echo $fecundador->$id_raza?></td>
                        <td>
                            <div>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'view',array(fecundadorTableClass::ID => $fecundador->$id));?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'edit',array(fecundadorTableClass::ID => $fecundador->$id));?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a data-toggle="modal" data-target="#myModalDelete<?php echo $fecundador->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!--Ventana MODAL ELIMINAR SIMPLE-->
                    <div class="modal fade" id="myModalDelete<?php echo $fecundador->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                </div>
                                <div class="modal-body">
                                    <?php echo i18n::__('Do you want to delete the record?') ?> <?php echo $fecundador->$nombre ?> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $fecundador->$id ?>, '<?php echo fecundadorTableClass::getNameField(fecundadorTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('fecundador', 'delete') ?>')"><?php echo i18n::__('confirm') ?></button>
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
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('fecundador', 'index') ?>')">
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
