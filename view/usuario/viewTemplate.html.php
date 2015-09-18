<?php use mvc\routing\routingClass as routing; ?>
<?php use mvc\i18n\i18nClass as i18n; ?>
<?php use mvc\view\viewClass as view ?>
<?php $id = usuarioTableClass::ID ?>
<?php $user_name = usuarioTableClass::USER ?>
<?php $created_at = usuarioTableClass::CREATED_AT ?>

<?php view::includePartial('usuario/menuPrincipal'); ?>
<div class="container container-fluid">
    <h1><?php echo i18n::__('user') ?></h1>
    <h1<i class="fa fa-user"><?php echo i18n::__('usuario') ?></i></h1>
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
                        <th><?php echo i18n::__('user') ?></th>
                        <th><?php echo i18n::__('created_at') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objUsuario as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario->$user_name ?></td>
                            <td><?php echo $usuario->$created_at ?></td>
                        </tr>
                    <?php endforeach; ?> 
                </tbody>
                
            </table>
            <a class="btn btn-info btn-sm" href="<?php echo routing::getInstance()->getUrlWeb('usuario', 'index')?>"><i class="glyphicon glyphicon-arrow-left"> </i> <?php echo i18n::__('return')?></a>
        </section>
        <footer>

        </footer>
    </div>
</div>