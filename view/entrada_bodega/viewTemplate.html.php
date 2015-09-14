<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = entradaBodegaTableClass::ID ;?>
<?php $fecha = entradaBodegaTableClass::FECHA ;?>
<?php $hora = entradaBodegaTableClass::HORA ?>
<?php $id_trabajador = entradaBodegaTableClass::ID_TRABAJADOR ?>
<?php $id_proveedor = entradaBodegaTableClass::ID_PROVEEDOR; ?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('entry_cellar') ?></h1>
    <h1<i class="fa fa-truck"><?php echo i18n::__('entrada_bodega') ?></i></h1>
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
                        <th><?php echo i18n::__('id') ?></th>
                        <th><?php echo i18n::__('date') ?></th>
                        <th><?php echo i18n::__('time') ?></th>
                        <th><?php echo i18n::__('id_employee') ?></th>
                        <th><?php echo i18n::__('id_provider') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objEntradaBodega as $entrada_bodega): ?>
                        <tr>
                            <td><?php echo $entrada_bodega->$id ?></td>
                            <td><?php echo $entrada_bodega->$fecha ?></td>
                            <td><?php echo $entrada_bodega->$hora ?></td>
                            <td><?php echo entradaBodegaTableClass::getNameFieldForaneaTrabajador($entrada_bodega->$id_trabajador) ?></td>
                            <td><?php echo entradaBodegaTableClass::getNameFieldForaneaProveedor($entrada_bodega->$id_proveedor) ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('entrada_bodega', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
        </section>
        <footer>

        </footer>
    </div>
</div>