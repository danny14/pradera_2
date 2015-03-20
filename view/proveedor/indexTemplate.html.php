<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php $id = proveedorTableClass::ID ?>
<?php $nombre = proveedorTableClass::NOMBRE?>
<?php $apellido = proveedorTableClass::APELLIDO?>
<?php $direccion = proveedorTableClass::DIRECCION?>
<?php $telefono = proveedorTableClass::TELEFONO?>
<?php $correo = proveedorTableClass::CORREO?>
<?php $id_ciudad = proveedorTableClass::ID_CIUDAD?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('provider')?></h1>
    <div class="row">
        <header>
            
        </header>
        <nav>
            
        </nav>
        <section>
            <div>
                <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'insert')?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion">Borrar</a>
            </div>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"></th>
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
                        <td><input type="checkbox" name="chk[]" value="<?php?>"></td>
                        <td><?php echo $proveedor->$id ?></td>
                        <td><?php echo $proveedor->$nombre ?></td>
                        <td><?php echo $proveedor->$apellido ?></td>
                        <td><?php echo $proveedor->$direccion ?></td>
                        <td><?php echo $proveedor->$telefono ?></td>
                        <td><?php echo $proveedor->$correo ?></td>
                        <td><?php echo $proveedor->$id_ciudad ?></td>
                        
                        <td>
                            <div class="btn btn-group btn-xs">
                                <a href="#" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"><?php?></i></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'edit', array(proveedorTableClass::ID => $proveedor->$id))?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
                <tfoot>
                    
                </tfoot>
                
            </table>
            
        </section>
        <footer>
            
        </footer>
    </div>
</div>