<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php $id = bitacoraTableClass::ID ?>
<?php $usuario_id = bitacoraTableClass::USUARIO_ID ?>
<?php $accion = bitacoraTableClass::ACCION ?>
<?php $tabla = bitacoraTableClass::TABLA ?>
<?php $registro = bitacoraTableClass::REGISTRO ?>
<?php $observacion = bitacoraTableClass::OBSERVACION ?>
<?php $fecha = bitacoraTableClass::FECHA ?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('logbook')?></h1>
    <div class="row">
        <header>
            
        </header>
        <nav>
            
        </nav>
        <section>
            <div>
                <a href="#" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs" onclick="borrarSeleccion">Borrar</a>
            </div>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"></th>
                        <th><?php echo i18n::__('id')?></th>
                        <th><?php echo i18n::__('user_id')?></th>
                        <th><?php echo i18n::__('action')?></th>
                        <th><?php echo i18n::__('table')?></th>
                        <th><?php echo i18n::__('record')?></th>
                        <th><?php echo i18n::__('observation')?></th>
                        <th><?php echo i18n::__('date')?></th>
                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objBitacora as $bitacora): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php?>"></td>
                        <td><?php echo $bitacora->$id ?></td>
                        <td><?php echo $bitacora->$usuario_id ?></td>
                        <td><?php echo $bitacora->$accion ?></td>
                        <td><?php echo $bitacora->$tabla ?></td>
                        <td><?php echo $bitacora->$registro ?></td>
                        <td><?php echo $bitacora->$observacion ?></td>
                        <td><?php echo $bitacora->$fecha ?></td>
                        <td>
                            <div class="btn btn-group btn-xs">
                                <a href="#" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"><?php?></i></a>
                                <a href="" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
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