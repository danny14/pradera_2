<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view; ?>
<?php use mvc\config\configClass as config?>
<?php use mvc\request\requestClass as request?>
<?php use mvc\session\sessionClass as session?>
<?php $id = animalTableClass::ID ;?>
<?php $nombre = animalTableClass::NOMBRE ;?>
<?php $genero = animalTableClass::GENERO ?>
<?php $edad = animalTableClass::EDAD ?>
<?php $peso = animalTableClass::PESO; ?>
<?php $fecha_ingreso = animalTableClass::FECHA_INGRESO; ?>
<?php $numero_partos = animalTableClass::NUMERO_PARTOS ?>
<?php $id_raza = animalTableClass::ID_RAZA ?>
<?php $id_estado = animalTableClass::ID_ESTADO ?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <div class="page page-header text-center">
        <h1><i class="fa fa-paw"><?php echo i18n::__('animal') ?></i></h1>
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
                            <?php view::includeHandlerMessage()?>
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'index')?>">
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
            <!-- VENTANA MODAL PARA REPORTES CON FILTROS -->
            <div class="modal fade" id="myModalFILTROSREPORTE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('generate report')?></h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="form-horizontal" id="reportFilterForm" action="<?php  echo routing::getInstance()->getUrlWeb('animal', 'report')?>">
                                <div class="form-group <?php echo (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) ?  'has-error has-feedback' : '' ; ?> ">
                                    <label for="reportName" class="col-sm-2 control-label"><?php echo i18n::__('name')?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filterNombre" name="report[nombre]" placeholder="<?php echo i18n::__('name')?>">
                                        <?php  if (session::getInstance()->hasFlash(animalTableClass::getNameField(animalTableClass::NOMBRE, TRUE)) === TRUE) : ?><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span><?php endif ?>
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

            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteSelect') ?>" method="POST">
                <div class="botones">
                    <a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
                    <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                    <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                    <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalFILTROSREPORTE" ><i class="fa fa-file-pdf-o"><?php echo i18n::__('report')?></i></a>
                </div>
                    <?php view::includeHandlerMessage() ?>
                <table class="table table-bordered table-responsive table-condensed">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('id') ?></th>
                            <th><?php echo i18n::__('name') ?></th>
                            <th><?php echo i18n::__('gender') ?></th>
                            <th><?php echo i18n::__('age') ?></th>
                            <th><?php echo i18n::__('weight') ?></th>
                            <th><?php echo i18n::__('date_entry') ?></th>
                            <th><?php echo i18n::__('number_births') ?></th>
                            <th><?php echo i18n::__('id_raza') ?></th>
                            <th><?php echo i18n::__('id_status') ?></th>
                            <th><?php echo i18n::__('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objAnimal as $animal): ?>
                            <tr>
                                <td><input type="checkbox" name="chk[]" value="<?php echo $animal->$id ?>"></td>
                                <td><?php echo $animal->$id ?></td>
                                <td><?php echo $animal->$nombre ?></td>
                                <td><?php echo $animal->$genero ?></td>
                                <td><?php echo $animal->$edad ?></td>
                                <td><?php echo $animal->$peso ?></td>
                                <td><?php echo $animal->$fecha_ingreso ?></td>
                                <td><?php echo $animal->$numero_partos ?></td>
                                <td><?php echo animalTableClass::getNameFieldForaneaRaza($animal->$id_raza) ?></td>
                                <td><?php echo animalTableClass::getNameFieldForaneaEstado($animal->$id_estado) ?></td>
                                <td>
                                    <div class="btn btn-group btn-xs">
                                        <a href="<?php echo routing::getInstance()->getUrlWeb('animal','view', array(animalTableClass::ID => $animal->$id)) ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                        <a href="<?php echo routing::getInstance()->getUrlWeb('animal','edit', array(animalTableClass::ID => $animal->$id, animalTableClass::ID_RAZA => $animal->$id_raza, animalTableClass::ID_ESTADO => $animal->$id_estado)) ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a data-toggle="modal" data-target="#myModalDelete<?php echo $animal->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <!--Ventana MODAL ELIMINAR SIMPLE-->
                        <div class="modal fade" id="myModalDelete<?php echo $animal->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo i18n::__('Do you want to delete the record?') ?> <?php echo $animal->$nombre ?> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $animal->$id ?>, '<?php echo animalTableClass::getNameField(animalTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('animal', 'delete') ?>')"><?php echo i18n::__('confirm') ?></button>
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
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('animal', 'index')?>')">
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