<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = salidaBodegaTableClass::ID ?>
<?php $fecha = salidaBodegaTableClass::FECHA ?>
<?php $id_trabajador = salidaBodegaTableClass::ID_TRABAJADOR ?>

<?php view::includePartial('animal/menuPrincipal'); ?>
<?php view::includePartial('animal/formTraductor')?>
<h1<i class="fa fa-arrow-circle-o-right"><?php echo i18n::__('salida_bodega') ?></i></h1>

<div class="container container-fluid">
    <h1><?php echo i18n::__('Output_bodega')?></h1>
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
                       
                        <th><?php echo i18n::__('id')?></th>
                        <th><?php echo i18n::__('date')?></th>
                        <th><?php echo i18n::__('id_employee')?></th>              
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objSalidaBodega as $salida_bodega): ?>
                    <tr>
                        
                        <td><?php echo $salida_bodega->$id ?></td>
                        <td><?php echo $salida_bodega->$fecha ?></td>
                        <td><?php echo salidaBodegaTableClass::getNameFieldForaneaTrabajador($salida_bodega->$id_trabajador) ?></td>
                               
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('salida_bodega', 'index')?>"><i class="fa fa-hand-o-left"> </i> <?php echo i18n::__('return')?></a>
        </section>
        <footer>

        </footer>
    </div>
</div>