<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = registroCeloTableClass::ID ?>
<?php $fecha = registroCeloTableClass::FECHA?>
<?php $id_fecundador = registroCeloTableClass::ID_FECUNDADOR;?>
<?php $id_animal = registroCeloTableClass::ID_ANIMAL?>
<?php view::includePartial('animal/menuPrincipal'); ?>

<div class="container container-fluid">
    <h1<i class="fa fa-github-alt"><?php echo i18n::__('register_celo') ?></i></h1>
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
                        <th><?php echo i18n::__('id_fecundador')?></th>
                        <th><?php echo i18n::__('id_animal')?></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objRegistroCelo as $registro_celo): ?>
                    <tr>
                        
                        <td><?php echo $registro_celo->$id ?></td>
                        <td><?php echo $registro_celo->$fecha ?></td>
                        <td><?php echo registroCeloTableClass::getNameFieldForaneaFecundador($registro_celo->$id_fecundador) ?></td>
                        <td><?php echo registroCeloTableClass::getNameFieldForaneaAnimal($registro_celo->$id_animal) ?></td>
                                
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('registro_celo', 'index')?>"><i class="fa fa-hand-o-left"> </i> <?php echo i18n::__('return')?></a>
        </section>
        <footer>

        </footer>
    </div>
</div>