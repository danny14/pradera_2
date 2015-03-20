<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php $id = turnoTableClass::ID?>
<?php $descripcion = turnoTableClass::DESCRIPCION ?>
<?php $inicio_turno = turnoTableClass::INICIO_TURNO?>
<?php $fin_turno = turnoTableClass::FIN_TURNO ?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('turn')?> </h1>
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
                        <th><?php echo i18n::__('description')?></th>
                        <th><?php echo i18n::__('start_turn')?></th>
                        <th><?php echo i18n::__('end_turn')?></th>
                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objTurno as $turno): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php?>"></td>
                        <td><?php echo $turno->$id ?></td>
                        <td><?php echo $turno->$descripcion ?></td>
                        <td><?php echo $turno->$inicio_turno ?></td>
                        <td><?php echo $turno->$fin_turno ?></td>
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