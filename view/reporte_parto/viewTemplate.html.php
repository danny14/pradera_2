<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = reportePartoTableClass::ID ?>
<?php $fecha_parto = reportePartoTableClass::FECHA_PARTO ?>
<?php $n_animales_vi = reportePartoTableClass::N_ANIMALES_VI ?>
<?php $n_animales_m = reportePartoTableClass::N_ANIMALES_M ?>
<?php $n_machos = reportePartoTableClass::N_MACHOS?>
<?php $n_hembras = reportePartoTableClass::N_HEMBRAS ?>
<?php $id_animal = reportePartoTableClass::ID_ANIMAL?>
<?php $observaciones = reportePartoTableClass::OBSERVACIONES ?>

<?php view::includePartial('animal/menuPrincipal'); ?>


<div class="container container-fluid">
    <h1><?php echo i18n::__('report_parto')?></h1>
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
                        <th><?php echo i18n::__('date_delivery')?></th>
                        <th><?php echo i18n::__('n_animales_living')?></th>
                        <th><?php echo i18n::__('n_animales_dead')?></th>
                        <th><?php echo i18n::__('n_males')?></th>
                        <th><?php echo i18n::__('n_females')?></th>
                        <th><?php echo i18n::__('id_animal')?></th>
                        <th><?php echo i18n::__('observation')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objReporteParto as $reporte_parto): ?>
                    <tr>
                        
                        <td><?php echo $reporte_parto->$id ?></td>
                        <td><?php echo $reporte_parto->$fecha_parto ?></td>
                        <td><?php echo $reporte_parto->$n_animales_vi ?></td>
                        <td><?php echo $reporte_parto->$n_animales_m ?></td>
                        <td><?php echo $reporte_parto->$n_machos ?></td>
                        <td><?php echo $reporte_parto->$n_hembras ?></td>
                        <td><?php echo reportePartoTableClass::getNameFieldForaneaAnimal($reporte_parto->$id_animal) ?></td>
                         <td><?php echo $reporte_parto->$observaciones ?></td>       
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('reporte_parto', 'index')?>"><i class="fa fa-hand-o-left"> </i> <?php echo i18n::__('return')?></a>
        </section>
        <footer>

        </footer>
    </div>
</div>