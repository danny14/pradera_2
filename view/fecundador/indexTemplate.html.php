<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php $id = fecundadorTableClass::ID ?>
<?php $nombre = fecundadorTableClass::NOMBRE ?>
<?php $edad = fecundadorTableClass::EDAD ?>
<?php $peso = fecundadorTableClass::PESO ?>
<?php $observacion = fecundadorTableClass::OBSERVACION ?>
<?php $id_raza = fecundadorTableClass::ID_RAZA ?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('fecundador')?></h1>
    <div class="row">
        <header>
            
        </header>
        <nav>
            
        </nav>
        <section>
            <div>
                <a href="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'insert')?>" class="btn btn-success btn-xs">Nuevo</a>
                <a href="#" class="btn btn-danger btn-xs">Borrar</a>
            </div>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="chkAll"></th>
                        <th><?php echo i18n::__('id')?></th>
                        <th><?php echo i18n::__('name')?></th>
                        <th><?php echo i18n::__('age')?></th>
                        <th><?php echo i18n::__('weight')?></th>
                        <th><?php echo i18n::__('observation')?></th>
                        <th><?php echo i18n::__('id_raza')?></th>
                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objFecundador as $fecundador): ?>
                    <tr>
                        <td><input type="checkbox" name="chk[]" value="" ></td>
                        <td><?php echo $fecundador->$id?></td>
                        <td><?php echo $fecundador->$nombre?></td>
                        <td><?php echo $fecundador->$edad?></td>
                        <td><?php echo $fecundador->$peso?></td>
                        <td><?php echo $fecundador->$observacion?></td>
                        <td><?php echo $fecundador->$id_raza?></td>
                        <td>
                            <div>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'view', array(fecundadorTableClass::ID =>$fecundador->$id ))?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>
                                <a href="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'edit', array(fecundadorTableClass::ID =>$fecundador->$id ))?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="#" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot></tfoot>
                
            </table>
            
        </section>
        <footer></footer>
    </div>
</div>