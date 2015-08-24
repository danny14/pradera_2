<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = credencialTableClass::ID?>
<?php $nombre = credencialTableClass::NOMBRE?>
<?php $created_at= credencialTableClass::CREATED_AT?>
<?php $updated_at = credencialTableClass::UPDATED_AT?>
<?php $deleted_at = credencialTableClass::DELETED_AT?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('credential') ?></h1>
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
                        <th><?php echo i18n::__('nombre')?></th>
                        <th><?php echo i18n::__('created_at')?></th>
                        <th><?php echo i18n::__('update_at')?></th>
                        <th><?php echo i18n::__('deleted_at')?></th>
                        <th><?php echo i18n::__('action')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objCredencial as $credencial): ?>
                        <tr>
                        <td><?php echo $credencial->$nombre ?></td>
                        <td><?php echo $credencial->$created_at ?></td>
                        <td><?php echo $credencial->$updated_at ?></td>
                        <td><?php echo $credencial->$deleted_at ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>

            </table>
            <a href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index')?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-arrow-left"></i></a>
        </section>
        <footer>

        </footer>
    </div>
</div>
