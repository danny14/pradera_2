<?php use mvc\routing\routingClass as routing;?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view?>
<?php $id = estadoTableClass::ID ;?>
<?php $descripcion = estadoTableClass::DESCRIPCION ;?>
<?php view::includePartial('animal/menuPrincipal'); ?>
<?php view::includePartial('animal/formTraductor')?>
<div class="container container-fluid">
    <h1><i class="fa fa-caret-square-o-up"> <?php echo i18n::__('status') ?></i></h1>
    <div class="row">
        <header>
            
        </header>
        <nav>
            
        </nav>
        <section>
                <?php view::includeHandlerMessage()?>
            <table class="table table-bordered table-responsive table-striped table-condensed">
                <thead>
                    <tr>
                        <th><?php echo i18n::__('description')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objEstado as $estado): ?>
                    <tr>
                        <td><?php echo $estado->$descripcion ?></td>
                    </tr>
                    <?php endforeach; ?> 
                </tbody>
                <tfoot>
                    
                </tfoot>
                
            </table>
            <a href="<?php echo routing::getInstance()->getUrlWeb('estado', 'index')?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-arrow-left"> <?php echo i18n::__('return')?></i></a>
        </section>
        <footer>
            
        </footer>
    </div>
</div>