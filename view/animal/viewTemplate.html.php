<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = animalTableClass::ID ?>
<?php $nombre = animalTableClass::NOMBRE ?>
<?php $genero = animalTableClass::GENERO ?>
<?php $edad = animalTableClass::EDAD ?>
<?php $peso = animalTableClass::PESO; ?>
<?php $fecha_ingreso = animalTableClass::FECHA_INGRESO; ?>
<?php $numero_partos = animalTableClass::NUMERO_PARTOS ?>
<?php $id_raza = animalTableClass::ID_RAZA ?>
<?php $id_estado = animalTableClass::ID_ESTADO ?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('animal') ?></h1>
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
                        <th><?php echo i18n::__('gender') ?></th>
                        <th><?php echo i18n::__('age') ?></th>
                        <th><?php echo i18n::__('weight') ?></th>
                        <th><?php echo i18n::__('date_entry') ?></th>
                        <th><?php echo i18n::__('number_births') ?></th>
                        <th><?php echo i18n::__('breed') ?></th>
                        <th><?php echo i18n::__('status') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objAnimal as $animal): ?>
                        <tr>
                            <td><?php echo $animal->$id ?></td>
                            <td><?php echo $animal->$nombre ?></td>
                            <td><?php echo $animal->$genero ?></td>
                            <td><?php echo $animal->$edad ?></td>
                            <td><?php echo $animal->$peso ?></td>
                            <td><?php echo $animal->$fecha_ingreso ?></td>
                            <td><?php echo $animal->$numero_partos ?></td>
                            <td><?php echo animalTableClass::getNameFieldForaneaRaza($animal->$id_raza) ?></td>
                            <td><?php echo animalTableClass::getNameFieldForaneaEstado($animal->$id_estado) ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
        </section>
        <footer>

        </footer>
    </div>
</div>