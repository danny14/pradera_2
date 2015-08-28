<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = ciudadTableClass::ID ?>
<?php $descripcion = ciudadTableClass::DESCRIPCION ?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('city') ?></h1>
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objCiudad as $ciudad): ?>
                        <tr>
                            <td><?php echo $ciudad->$descripcion ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>

            </table>
            <a href="<?php echo routing::getInstance()->getUrlWeb('ciudad', 'index')?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-arrow-left"></i></a>
        </section>
        <footer>

        </footer>
    </div>
</div>
