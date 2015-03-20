<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php $id = tipoInsumoTableClass::ID ?>
<?php $descripcion = tipoInsumoTableClass::DESCRIPCION?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('input_type')?></h1>
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
                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objTipoInsumo as $tipoinsumo): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="<?php?>"></td>
                        <td><?php echo $tipoinsumo->$id ?></td>
                        <td><?php echo $tipoinsumo->$descripcion ?></td>
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