<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $id = ordennoTableClass::ID ?>
<?php $fecha_ordenno =ordennoTableClass::FECHA_ORDENNO ?>
<?php $cantidad_leche =ordennoTableClass::CANTIDAD_LECHE ?>
<?php $id_trabajador =ordennoTableClass::ID_TRABAJADOR ?>
<?php $id_animal =ordennoTableClass::ID_ANIMAL ?>
<?php view::includePartial('animal/menuPrincipal')?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('ordenno')?></h1>
    <h1<i class="fa fa-ship-tint"><?php echo i18n::__('ordenno') ?></i></h1>
    <div class="row" >
        <header>
            
        </header>
        <nav>
            
        </nav>
        <section>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><?php echo i18n::__('date_ordenno')?></th>
                        <th><?php echo i18n::__('quantity_milk')?></th>
                        <th><?php echo i18n::__('id_employee')?></th>
                        <th><?php echo i18n::__('id_animal')?></th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objOrdenno as $ordenno): ?>
                    <tr>
                        <td><?php echo $ordenno->$fecha_ordenno?></td>
                        <td><?php echo $ordenno->$cantidad_leche?></td>
                        <td><?php echo ordennoTableClass::getNameFieldForaneaTrabajador($ordenno->$id_trabajador) ?></td>
                        <td><?php echo ordennoTableClass::getNameFieldForaneaAnimal($ordenno->$id_animal) ?></td>
                        
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot></tfoot>
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('ordenno', 'index')?>"><i class="fa fa-hand-o-left"> <?php echo i18n::__('return')?></i></a>
        </section>
        <footer>
            
        </footer>
    </div>
</div>

       



