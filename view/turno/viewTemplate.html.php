<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = turnoTableClass::ID ?>
<?php $descripcion = turnoTableClass::DESCRIPCION ?>
<?php $inicio_turno = turnoTableClass::INICIO_TURNO?>
<?php $fin_turno = turnoTableClass::FIN_TURNO ?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('breed') ?></h1>
    <h1<i class="fa fa-clock"><?php echo i18n::__('turno') ?></i></h1>
    <div class="row">
        <header>

        </header>
        <nav>

        </nav>
        <section>
            <?php view::includeHandlerMessage() ?>
            <table class="table table-bordered table-responsive table-condensed">
                <thead>
                    <tr class="active">
                        <th><?php echo i18n::__('description') ?></th>
                        <th><?php echo i18n::__('start_turn') ?></th>
                        <th><?php echo i18n::__('end_turn') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objRaza as $turno): ?>
                        <tr>
                            <td><?php echo $turno->$descripcion ?></td>
                            <td><?php echo $turno->$inicio_turno ?></td>
                            <td><?php echo $turno->$fin_turno ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>

            </table>
            <a href="<?php echo routing::getInstance()->getUrlWeb('turno', 'index')?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-arrow-left"></i></a>
        </section>
        <footer>

        </footer>
    </div>
</div>
