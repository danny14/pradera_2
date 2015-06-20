<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = trabajadorTableClass::ID ?>
<?php $nombre = trabajadorTableClass::NOMBRE ?>
<?php $genero = trabajadorTableClass::GENERO ?>
<?php $edad = trabajadorTableClass::EDAD ?>
<?php $peso = trabajadorTableClass::PESO; ?>
<?php $fecha_ingreso = trabajadorTableClass::FECHA_INGRESO; ?>
<?php $numero_partos = trabajadorTableClass::NUMERO_PARTOS ?>
<?php $id_raza = trabajadorTableClass::ID_RAZA ?>
<?php $id_estado = trabajadorTableClass::ID_ESTADO ?>
<?php view::includePartial('trabajador/menuPrincipal'); ?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('employee') ?></h1>
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
                        <th><?php echo i18n::__('name') ?></th>
                        <th><?php echo i18n::__('last_name') ?></th>
                        <th><?php echo i18n::__('address') ?></th>
                        <th><?php echo i18n::__('phone') ?></th>
                        <th><?php echo i18n::__('id_turn') ?></th>
                        <th><?php echo i18n::__('id_credential') ?></th>
                        <th><?php echo i18n::__('id_city') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objTrabajador as $trabajador): ?>
                        <tr>
                            <td><?php echo $trabajador->$id ?></td>
                            <td><?php echo $trabajador->$nombre ?></td>
                            <td><?php echo $trabajador->$apellido ?></td>
                            <td><?php echo $trabajador->$direccion ?></td>
                            <td><?php echo $trabajador->$telefono ?></td>
                            <td><?php echo trabajadorTableClass::getNameFieldForaneaRaza($trabajador->$id_turno) ?></td>
                            <td><?php echo trabajadorTableClass::getNameFieldForaneaRaza($trabajador->$id_credencial) ?></td>
                            <td><?php echo trabajadorTableClass::getNameFieldForaneaEstado($trabajador->$id_ciudad) ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('trabajador', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
        </section>
        <footer>

        </footer>
    </div>
</div>