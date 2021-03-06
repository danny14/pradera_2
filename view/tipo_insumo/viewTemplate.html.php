<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = tipoInsumoTableClass::ID ?>
<?php $descripcion = tipoInsumoTableClass::DESCRIPCION ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('type_input') ?></h1>
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
                    <?php foreach ($objTipoInsumo as $tipo_insumo): ?>
                        <tr>
                            <td><?php echo $tipo_insumo->$descripcion ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>

            </table>
            <a href="<?php echo routing::getInstance()->getUrlWeb('tipo_insumo', 'index')?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-arrow-left"></i></a>
        </section>
        <footer>

        </footer>
    </div>
</div>
