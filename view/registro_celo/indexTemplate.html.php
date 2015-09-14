<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = registroCeloTableClass::ID ?>
<?php $fecha = registroCeloTableClass::FECHA?>
<?php $id_fecundador = registroCeloTableClass::ID_FECUNDADOR;?>
<?php $id_animal = registroCeloTableClass::ID_ANIMAL?>
<?php $animal_id = animalTableClass::ID ;?>
<?php $nombre = animalTableClass::NOMBRE ;?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
   <div class="page page-header text-center"> 
   <h1><i class="fa fa-github-alt"><?php echo i18n::__('register_celo')?></i></h1>

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
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'index')?>">
                                <?php view::getMessageError('errorDateCreate')?>
                                <div class="form-group">
                                    <label for="filterDate1" class="col-sm-2 control-label"><?php echo i18n::__('date').' ';echo i18n::__('start')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="filter[<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::FECHA,TRUE).'_1'?>]" class="form-control" id="filter<?php echo animalTableClass::getNameField(animalTableClass::FECHA_INGRESO,TRUE).'_1'?>" placeholder="<?php echo i18n::__('date').' ';echo i18n::__('start')?>">
                                    </div>
                                </div>
                                <?php view::getMessageError('errorDateEnd')?>
                                <div class="form-group">
                                    <label for="filterDate1" class="col-sm-2 control-label"><?php echo i18n::__('date').' ';echo i18n::__('end')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="filter[<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::FECHA,TRUE).'_2'?>]" class="form-control" id="filter<?php animalTableClass::getNameField(animalTableClass::FECHA_INGRESO,TRUE).'_2'?>" placeholder="<?php echo i18n::__('date').' ';echo i18n::__('end')?>">
                                    </div>
                                </div>
                                    
                               
                                    <div class="form-group"> <!--filtro para llamar foranea-->
                            <label for="filterAnimal" class="col-sm-2 control-label"><?php echo i18n::__('animal') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterAnimal" name="filter[Animal]">
                                    <option value=""><?php echo i18n::__('animal') ?></option>
                                     <?php foreach ($objAnimal as $nombre_animal): ?>
                                        <option value="<?php echo $nombre_animal->$animal_id ?>"><?php echo $nombre_animal->$nombre ?></option>
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
                            <form method="POST" class="form-horizontal" id="reportForm" action="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'report')?>">
                             <?php view::getMessageError('errorDateCreate')?>
                                <div class="form-group">
                                    <label for="reportDate1" class="col-sm-2 control-label"><?php echo i18n::__('date').' ';echo i18n::__('start')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="report[<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::FECHA,TRUE).'_1'?>]" class="form-control" id="filter<?php echo animalTableClass::getNameField(animalTableClass::FECHA_INGRESO,TRUE).'_1'?>" placeholder="<?php echo i18n::__('date').' ';echo i18n::__('start')?>">
                                    </div>
                                </div>
                                <?php view::getMessageError('errorDateEnd')?>
                                <div class="form-group">
                                    <label for="reportDate1" class="col-sm-2 control-label"><?php echo i18n::__('date').' ';echo i18n::__('end')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="report[<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::FECHA,TRUE).'_2'?>]" class="form-control" id="filter<?php animalTableClass::getNameField(animalTableClass::FECHA_INGRESO,TRUE).'_2'?>" placeholder="<?php echo i18n::__('date').' ';echo i18n::__('end')?>">
                                    </div>
                                </div>
                                
                                
                              <div class="form-group"> <!--filtro para llamar foranea-->
                            <label for="filterAnimal" class="col-sm-2 control-label"><?php echo i18n::__('animal') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="filterAnimal" name="filter[Animal]">
                                    <option value=""><?php echo i18n::__('animal') ?></option>
                                     <?php foreach ($objAnimal as $nombre_animal): ?>
                                        <option value="<?php echo $nombre_animal->$animal_id ?>"><?php echo $nombre_animal->$nombre ?></option>
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
            
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'deleteSelect') ?>" method="POST">
                <div>
                    <a href="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'insert') ?>" class="btn btn-success btn-xs"><?php echo i18n::__('new') ?></a>
                    <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                    <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                    <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalREPORTES"><i class=" fa fa-file-pdf-o"> <?php echo i18n::__('report')?></i></a>
                </div>
                    <?php view::includeHandlerMessage() ?>
                <table class="table table-bordered table-responsive table-condensed">
                    <thead>
                        <tr class="active">
                            <th><input type="checkbox" id="chkAll"></th>
                            <th><?php echo i18n::__('id') ?></th>
                            <th><?php echo i18n::__('date') ?></th>
                            <th><?php echo i18n::__('fecundador') ?></th>
                            <th><?php echo i18n::__('animal') ?></th>
                            <th><?php echo i18n::__('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objRegistroCelo as $registro_celo): ?>
                            <tr>
                                <td><input type="checkbox" name="chk[]" value="<?php echo $registro_celo->$id ?>"></td>
                                <td><?php echo $registro_celo->$id ?></td>
                                <td><?php echo $registro_celo->$fecha ?></td>
                                <td><?php echo registroCeloTableClass::getNameFieldForaneaFecundador($registro_celo->$id_fecundador) ?></td>
                                <td><?php echo registroCeloTableClass::getNameFieldForaneaAnimal($registro_celo->$id_animal) ?></td>
                                
                                
                                <td>
                                    <div class="btn btn-group btn-xs">
                                        <a href="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'view', array(registroCeloTableClass::ID => $registro_celo->$id)) ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                        <a href="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'edit', array(registroCeloTableClass::ID => $registro_celo->$id, registroCeloTableClass::ID_ANIMAL => $registro_celo->$id_animal, registroCeloTableClass::ID_FECUNDADOR => $registro_celo->$id_fecundador)) ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a data-toggle="modal" data-target="#myModalDelete<?php echo $registro_celo->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <!--Ventana MODAL ELIMINAR SIMPLE-->
                        <div class="modal fade" id="myModalDelete<?php echo $registro_celo->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo i18n::__('Do you want to delete the record?') ?> <?php echo $registro_celo->$fecha ?> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                        <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $registro_celo->$id ?>, '<?php echo registroCeloTableClass::getNameField(registroCeloTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'delete') ?>', '<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'index') ?>')"><?php echo i18n::__('confirm') ?></button>
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
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'index')?>')">
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
