<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php $id = entradaBodegaTableClass::ID?>
<?php $fecha = entradaBodegaTableClass::NOMBRE?>
<?php $hora = entradaBodegaTableClass::CREATED_AT?>
<?php $id_tipo_doc = entradaBodegaTableClass::ID_TIPO_DOC ?>
<?php $id_trabajador = entradaBodegaTableClass::ID_TRABAJADOR?>
<?php $id_proveedor = entradaBodegaTableClass::ID_PROVEEDOR?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('entrance_cellar')?></h1>
    <div class="row">
        <header>
            
        </header>
        <nav>
            
        </nav>
        <section>
            <div>
                <a href="<?php echo routing::getInstance()->getUrlWeb('entrada_bodega', 'insert') ?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion">Borrar</a>
            </div>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"></th>
                        <th><?php echo i18n::__('id')?></th>
                        <th><?php echo i18n::__('date')?></th>
                        <th><?php echo i18n::__('time')?></th>
                        <th><?php echo i18n::__('id_type_doc')?></th>
                        <th><?php echo i18n::__('id_employee')?></th>
                        <th><?php echo i18n::__('id_provider')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objEntradaBodega as $entrada_bodega): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php?>"></td>
                        <td><?php echo $entrada_bodega->$id ?></td>
                        <td><?php echo $entrada_bodega->$fecha ?></td>
                        <td><?php echo $entrada_bodega->$hora?></td>
                        <td><?php echo $entrada_bodega->$id_tipo_doc?></td>
                        <td><?php echo $entrada_bodega->$id_trabajador?></td>
                        <td><?php echo $entrada_bodega->$id_proveedor?></td>
                        <td>
                            <div class="btn btn-group btn-xs">
                                <a href="<?php?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('entrada_bodega', 'edit', array(entradaBodegaTableClass::ID => $credencial->$id))?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            
        </section>
        <footer>
            
        </footer>
    </div>
</div>