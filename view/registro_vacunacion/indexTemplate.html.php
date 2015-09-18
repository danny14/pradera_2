<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\session\sessionClass as session?>
<?php use mvc\request\requestClass as request?>
<?php $id = registroVacunacionTableClass::ID ?>
<?php $fecha_registro =registroVacunacionTableClass::FECHA_REGISTRO ?>
<?php $id_trabajador =registroVacunacionTableClass::ID_TRABAJADOR ?>
<?php $dosis_vacuna =registroVacunacionTableClass::DOSIS_VACUNA ?>
<?php $hora_vacuna =registroVacunacionTableClass::HORA_VACUNA ?>
<?php $id_animal =registroVacunacionTableClass::ID_ANIMAL ?>
<?php $id_insumo =registroVacunacionTableClass::ID_INSUMO ?>
<?php $idAnimal = animalTableClass::ID?>
<?php $nombreAnimal = animalTableClass::NOMBRE?>
<?php $idInsumo = insumoTableClass::ID ?>
<?php $nombreInsumo = insumoTableClass::NOMBRE?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
     <div class="page page-header text-center">
   <h1><i class="fa fa-eyedropper"><?php echo i18n::__('register_vacunacion')?></i></h1>
   
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
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'index') ?>">
                                <?php view::getMessageError('errorDateCreate')?>
                                <div class="form-group">
                                    <label for="filterDate1" class="col-sm-2 control-label"><?php echo i18n::__('date').' ';echo i18n::__('start')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="filter[<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO,TRUE).'_1'?>]" class="form-control" id="filter<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO,TRUE).'_1'?>" placeholder="<?php echo i18n::__('date').' ';echo i18n::__('start')?>">
                                    </div>
                                </div>
                                
                                <?php view::getMessageError('errorDateEnd')?>
                                <div class="form-group">
                                    <label for="filterDate1" class="col-sm-2 control-label"><?php echo i18n::__('date').' ';echo i18n::__('end')?></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="filter[<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO,TRUE).'_2'?>]" class="form-control" id="filter<?php registroVacunacionTableClass::getNameField(registroVacunacionTableClass::FECHA_REGISTRO,TRUE).'_2'?>" placeholder="<?php echo i18n::__('date').' ';echo i18n::__('end')?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="id_animal">
                                        <?php echo i18n::__('id_animal') ?>:
                                    </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="filter<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE) ?>" name="filter[<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE) ?>]" required>
                                            <option><?php echo i18n::__('selectAnimal') ?></option>
                                            <?php foreach ($objAnimal as $animal): ?>
                                                <option <?php echo ((session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) and request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) == $animal->$idAnimal) ? 'selected' : '') ?> value="<?php echo $animal->$idAnimal ?>"><?php echo $animal->$nombreAnimal ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="id_insumo"><?php echo i18n::__('id_input') ?></label>
                                    <div class="col-sm-10">
                                    <select class="form-control" id="filter<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_INSUMO, TRUE) ?>" name="filter[<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_INSUMO, TRUE) ?>]" required>
                                        <option><?php echo i18n::__('selectInput') ?></option>
                                        <?php foreach ($objInsumo as $insumo): ?>
                                            <option <?php echo ((session::getInstance()->hasFlash(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) === TRUE) ? '' : (request::getInstance()->hasPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) and request::getInstance()->getPost(registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID_ANIMAL, TRUE)) == $insumo->$idInsumo) ? 'selected' : '') ?> value="<?php echo $insumo->$idInsumo ?>"><?php echo $insumo->$nombreInsumo ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
                            <form method="POST" class="form-horizontal" id="reportForm" action="<?php// echo routing::getInstance()->getUrlWeb('registro_vacunacion ', 'report') ?>">
                                <div class="form-group">
                                    <label for="reportDate_register" class="col-sm-2 control-label"><?php echo i18n::__('date_register') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reportFecha_registro" name="report[fecha_registro]" placeholder="<?php echo i18n::__('date_register') ?>">
                                    </div>
                       
                                    </div>
                                 
                                <div class="form-group">
                                    <label for="reportDose_vaccine" class="col-sm-2 control-label"><?php echo i18n::__('dose_vaccine') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reportDosis_vacuna" name="report[dosis_vacuna]" placeholder="<?php echo i18n::__('dose_vaccine') ?>">
                                    </div>
                       
                                    </div>
                                     
                                        
                                <div class="form-group">
                                    <label for="reportTime_vaccine" class="col-sm-2 control-label"><?php echo i18n::__('time_vaccine') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reportHora_vacuna" name="report[hora_vacuna]" placeholder="<?php echo i18n::__('time_vaccine') ?>">
                                    </div>
                       
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
            <!-- -->
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'deleteSelect') ?>" method="POST">
                <div id="botones">
                <a href="<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'insert')?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                    <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalREPORTES" ><i class="fa fa-file-pdf-o"> <?php echo i18n::__('report')?></i></a>
            </div>
            <?php view::includeHandlerMessage() ?>
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"</th>
                        <th><?php echo i18n::__('id')?></th>
                        <th><?php echo i18n::__('date_register')?></th>
                        <th><?php echo i18n::__('id_employee')?></th>
                        <th><?php echo i18n::__('dose_vaccine')?></th>
                        <th><?php echo i18n::__('time_vaccine')?></th>
                        <th><?php echo i18n::__('id_animal')?></th>
                        <th><?php echo i18n::__('id_input')?></th>
                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objRegistroVacunacion as $registro_vacunacion): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $registro_vacunacion->$id?>"></td>
                        <td><?php echo $registro_vacunacion->$id?></td>
                        <td><?php echo $registro_vacunacion->$fecha_registro?></td>
                       <td><?php echo $registro_vacunacion->$id_trabajador?></td>
                       <td><?php echo $registro_vacunacion->$dosis_vacuna?></td>
                       <td><?php echo $registro_vacunacion->$hora_vacuna?></td>
                       <td><?php echo $registro_vacunacion->$id_animal?></td>
                       <td><?php echo $registro_vacunacion->$id_insumo?></td>
                        <td>
                            <div>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'view',array(registroVacunacionTableClass::ID => $registro_vacunacion->$id));?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'edit',array(registroVacunacionTableClass::ID => $registro_vacunacion->$id));?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a data-toggle="modal" data-target="#myModalDelete<?php echo $registro_vacunacion->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!--Ventana MODAL ELIMINAR SIMPLE-->
                    <div class="modal fade" id="myModalDelete<?php echo $registro_vacunacion->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                </div>
                                <div class="modal-body">
                                    <?php echo i18n::__('Do you want to delete the record?') ?> <?php echo $registro_vacunacion->$fecha_registro ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $registro_vacunacion->$id ?>, '<?php echo registroVacunacionTableClass::getNameField(registroVacunacionTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'delete') ?>')"><?php echo i18n::__('confirm') ?></button>
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
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('registro_vacunacion', 'index') ?>')">
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
