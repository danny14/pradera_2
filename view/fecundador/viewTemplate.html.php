<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $id = fecundadorTableClass::ID ?>
<?php $nombre =fecundadorTableClass::NOMBRE ?>
<?php $edad =fecundadorTableClass::EDAD ?>
<?php $peso =fecundadorTableClass::PESO ?>
<?php $observacion =fecundadorTableClass::OBSERVACION ?>
<?php $id_raza =fecundadorTableClass::ID_RAZA ?>
<?php view::includePartial('animal/menuPrincipal')?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('fecundador')?></h1>
    <h1<i class="fa fa-mars-stoke"><?php echo i18n::__('fecundador') ?></i></h1>
    <div class="row" >
        <header>
            
        </header>
        <nav>
            
        </nav>
        <section>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><?php echo i18n::__('name')?></th>
                        <th><?php echo i18n::__('age')?></th>
                        <th><?php echo i18n::__('weight')?></th>
                        <th><?php echo i18n::__('observation')?></th>
                        <th><?php echo i18n::__('id_raza')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objFecundador as $fecundador): ?>
                    <tr>
                        <td><?php echo $fecundador->$nombre?></td>
                        <td><?php echo $fecundador->$edad?></td>
                        <td><?php echo $fecundador->$peso?>.Kg</td>
                        <td><?php echo $fecundador->$observacion?></td>
                        <td><?php echo fecundadorTableClass::getNameFieldForaneaRaza($fecundador->$id_raza) ?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot></tfoot>
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('fecundador', 'index')?>"><i class="fa fa-hand-o-left"> <?php echo i18n::__('return')?></i></a>
        </section>
        <footer>
            
        </footer>
    </div>
</div>

       



