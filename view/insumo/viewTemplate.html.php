<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view?>
<?php $id = insumoTableClass::ID ?>
<?php $nombre =insumoTableClass::NOMBRE ?>
<?php $fecha_fabricacion =insumoTableClass::FECHA_FEBRICACION ?>
<?php $fecha_vencimiento =insumoTableClass::FECHA_VENCIMIENTO ?>
<?php $valor =insumoTableClass::VALOR ?>
<?php $id_tipo_insumo =insumoTableClass::ID_TIPO_INSUMO ?>
<?php view::includePartial('animal/menuPrincipal')?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('insumo')?></h1>
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
                        <th><?php echo i18n::__('date_create')?></th>
                        <th><?php echo i18n::__('date_expiration')?></th>
                        <th><?php echo i18n::__('value')?></th>
                        <th><?php echo i18n::__('id_tipo_insumo')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objInsumo as $insumo): ?>
                    <tr>
                        <td><?php echo $insumo->$nombre?></td>
                        <td><?php echo $insumo->$fecha_fabricacion?></td>
                        <td><?php echo $insumo->$fecha_vencimiento?></td>
                        <td><?php echo $insumo->$valor?></td>
                        <td><?php echo $insumo->$id_tipo_insumo?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot></tfoot>
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'index')?>"><i class="fa fa-hand-o-left"> <?php echo i18n::__('return')?></i></a>
        </section>
        <footer>
            
        </footer>
    </div>
</div>

       



