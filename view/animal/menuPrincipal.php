<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\session\sessionClass as session?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <a class="navbar-brand" href="#">Corral de Piedras</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Animal <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('animal', 'index')?>">Animal</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('estado', 'index')?>">Estado</a></li>
            <li class="divider"></li>
          </ul>
        </li>
      </ul>
        <!-- Modulo Trabajador -->
       <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Trabajador <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('trabajador', 'index')?>">Trabajador</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('ciudad', 'index')?>">Ciudad</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('credencial', 'index')?>">Credencial</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('turno', 'index')?>">Turno</a></li>
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
        <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Fecundador <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
              <li><a href="<?php  echo routing::getInstance()->getUrlWeb('fecundador', 'index')?>">Fecundador</a></li>
            <li class="divider"></li>
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('raza', 'index')?>">Raza</a></li>
            <li class="divider"></li>
          </ul>
        </li>
      </ul>
<!-- Modulo Proveedor -->
       <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Proveedor <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('proveedor', 'index')?>">Proveedor</a></li>
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
<!-- Modulo Ordeño -->
       <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ordeño <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('ordenno', 'index')?>">Ordeño</a></li>
          </ul>
        </li>
      </ul>
        <!-- Fin Modulo -->
        <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Registro Celo <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  echo routing::getInstance()->getUrlWeb('registro_celo', 'index')?>">Registro Celo</a></li>
            <!--<li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
            -->
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--<li><a href="#">Link</a></li>-->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo session::getInstance()->getUserName() ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
              <li><a href="#"><i class="fa fa-wrench">Ajustes</i></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout')?>"><i class="fa fa-sign-out"><?php echo i18n::__('logout')?></i></a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

