<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = proveedorTableClass::ID ?>
<?php $nombre =proveedorTableClass::NOMBRE ?>
<?php $apellido =proveedorTableClass::APELLIDO ?>
<?php $direccion =proveedorTableClass::DIRECCION ?>
<?php $telefono =proveedorTableClass::TELEFONO ?>
<?php $correo =proveedorTableClass::CORREO ?>
<?php $id_ciudad =proveedorTableClass::ID_CIUDAD ?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <div class="page page-header text-center">
    <h1><?php echo i18n::__('provider')?></h1>
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
                            <form method="POST" class="form-horizontal" id="filterForm" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'index') ?>">
                                <div class="form-group">
                                    <label for="filterName" class="col-sm-2 control-label"><?php echo i18n::__('name') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filterNombre" name="filter[nombre]" placeholder="<?php echo i18n::__('name') ?>">
                                    </div>
                                </div>
                                   <div class="form-group">
                                    <label for="filterLast_name" class="col-sm-2 control-label"><?php echo i18n::__('last_name') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filterApellido" name="filter[apellido]" placeholder="<?php echo i18n::__('last_name') ?>">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label for="filterAddress" class="col-sm-2 control-label"><?php echo i18n::__('address') ?></label>
                                    <div class="col-sm-10">
                                        <input type="number" name="filter[direccion]" class="form-control" id="filterDireccion" placeholder="<?php echo i18n::__('address')?>">
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="filterPhone" class="col-sm-2 control-label"><?php echo i18n::__('phone') ?></label>
                                    <div class="col-sm-10">
                                        <input type="number" name="filter[telefono]" class="form-control" id="filterPeso" placeholder="<?php echo i18n::__('phone')?>">
                                    </div>
                                  </div>
                                 <div class="form-group">
                                    <label for="filterMail" class="col-sm-2 control-label"><?php echo i18n::__('mail') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="filterCorreo" name="filter[correo]" placeholder="<?php echo i18n::__('mail') ?>">
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
                            <form method="POST" class="form-horizontal" id="reportForm" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'report') ?>">
                                <div class="form-group">
                                    <label for="reportName" class="col-sm-2 control-label"><?php echo i18n::__('name') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reportNombre" name="report[nombre]" placeholder="<?php echo i18n::__('name') ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reportLast_name" class="col-sm-2 control-label"><?php echo i18n::__('last_name') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reportApellido" name="report[apellido]" placeholder="<?php echo i18n::__('last_name') ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reportAddress" class="col-sm-2 control-label"><?php echo i18n::__('address') ?></label>
                                    <div class="col-sm-10">
                                        <input type="number" name="report[direccion]" class="form-control" id="reportDireccion" placeholder="<?php echo i18n::__('address') ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reportPhone" class="col-sm-2 control-label"><?php echo i18n::__('phone') ?></label>
                                    <div class="col-sm-10">
                                        <input type="number" name="report[telefono]" class="form-control" id="reportTelefono" placeholder="<?php echo i18n::__('phone')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reportMail" class="col-sm-2 control-label"><?php echo i18n::__('mail') ?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="reportCorreo" name="report[correo]" placeholder="<?php echo i18n::__('mail') ?>">
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
            
            <!--Formulario del Traductor -->
            <?php view::includePartial('animal/formTraductor')?>
            <!--Fin Formulario del traductor -->
            <form id="frmDeleteAll" action="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'deleteSelect') ?>" method="POST">
                <div id="botones">
                <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'insert')?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="javascript:eliminarMasivo()" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDeleteMasivo" id="btnDeleteMasivo"><?php echo i18n::__('delete') ?></a>
                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalFILTROS"><?php echo i18n::__('filters')?></a>
                    <a class="btn btn-default btn-xs" href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'deleteFilters')?>" ><?php echo i18n::__('delete')." ";echo i18n::__('filters')?></a>
                    <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalREPORTES" ><i class="fa fa-file-pdf-o"> <?php echo i18n::__('report')?></i></a>
            </div>
            <?php view::includeHandlerMessage() ?>
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"</th>
                        <th><?php echo i18n::__('id')?></th>
                        <th><?php echo i18n::__('name')?></th>
                        <th><?php echo i18n::__('last_name')?></th>
                        <th><?php echo i18n::__('address')?></th>
                        <th><?php echo i18n::__('phone')?></th>
                        <th><?php echo i18n::__('mail')?></th>
                        <th><?php echo i18n::__('id_city')?></th>
                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objProveedor as $proveedor): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php echo $proveedor->$id?>"></td>
                        <td><?php echo $proveedor->$id?></td>
                        <td><?php echo $proveedor->$nombre?></td>
                        <td><?php echo $proveedor->$apellido?></td>
                        <td><?php echo $proveedor->$direccion?></td>
                        <td><?php echo $proveedor->$telefono?></td>
                        <td><?php echo $proveedor->$correo?></td>
                        <td><?php echo $proveedor->$id_ciudad?></td>
                        <td>
                            <div>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'view',array(proveedorTableClass::ID => $proveedor->$id));?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'edit',array(proveedorTableClass::ID => $proveedor->$id));?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a data-toggle="modal" data-target="#myModalDelete<?php echo $proveedor->$id ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!--Ventana MODAL ELIMINAR SIMPLE-->
                    <div class="modal fade" id="myModalDelete<?php echo $proveedor->$id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><?php echo i18n::__('confirm_delete') ?></h4>
                                </div>
                                <div class="modal-body">
                                    <?php echo i18n::__('Do you want to delete the record?') ?> <?php echo $proveedor->$nombre ?> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo i18n::__('close') ?></button>
                                    <button type="button" class="btn btn-danger" onclick="eliminar(<?php echo $proveedor->$id ?>, '<?php echo proveedorTableClass::getNameField(proveedorTableClass::ID, TRUE) ?>', '<?php echo routing::getInstance()->getUrlWeb('proveedor', 'delete') ?>','<?php echo routing::getInstance()->getUrlWeb('proveedor', 'index') ?>')"><?php echo i18n::__('confirm') ?></button>
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
                Pagina<select id="sqlPaginador" onchange="paginador(this,'<?php echo routing::getInstance()->getUrlWeb('proveedor', 'index') ?>')">
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