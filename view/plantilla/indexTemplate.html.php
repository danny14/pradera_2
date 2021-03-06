<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view?>
<?php $id = animalTableClass::ID?>

<?php view::includePartial('animal/menuPrincipal')?>
<div class="container container-fluid">
    <div class="page-header text-center">
    <h1>TABLA </h1>
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
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php // echo routing::getInstance()->getUrlWeb('animal', 'index')?>">
                                <div class="form-group">
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
            <form id="frmDeleteAll" action="<?php// echo routing::getInstance()->getUrlWeb('animal', 'deleteSelect') ?>" method="POST">
            <div>
                <a href="<?php //echo routing::getInstance()->getUrlWeb('animal', 'insert')?>" class="btn btn-success btn-xs"><?php i18n::__('new')?></a>
                <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                    <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                    <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
            </div>
                <?php view::includeHandlerMessage()?>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr class="active">
                        <th><input type="checkbox" id="chkAll"></th>
                        <th>CAMPOS</th>

                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objTabla as $tabla): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $table->$id?>"></td>
                        <td><?php echo $tabla->$id ?></td>
                        <td><?php echo $tabla->$campo ?></td>
                        <td>
                            <div class="btn btn-group btn-xs">
                                <a href="<?php echo routing::getInstance()->getUrlWeb('animal','view',array(animalTableClass::ID => $tabla->$id))?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"><?php?></i></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('animal','edit',array(animalTableClass::ID => $tabla->$id,  animalTableClass::ID_RAZA => $tabla->$id_raza))?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a data-toggle="modal" data-target="#myModalDelete<?php echo $table->$id?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                
                            </div>
                        </td>
                    </tr>
                    <!--Ventana MODAL ELIMINAR SIMPLE-->
                    <div class="modal fade" id="myModalDelete<?php echo $tabla->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                </div>
                                <div class="modal-body">
                                    <?php echo i18n::__('Do you want to delete the record?') ?> <?php echo $tabla->$nombre ?> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $tabla->$id ?>, '<?php echo animalTableClass::getNameField(animalTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('animal', 'delete') ?>')"><?php echo i18n::__('confirm') ?></button>
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
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('animal', 'index') ?>')">
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
<!----- FIN Ventana MODAL ELIMINAR MASIVO----------->