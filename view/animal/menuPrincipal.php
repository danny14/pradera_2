<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
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
              <li><a href="<?php // echo routing::getInstance()->getUrlWeb('animal', 'index')?>">Animal</a></li>
            <li class="divider"></li>
            <li><a href="<?php // echo routing::getInstance()->getUrlWeb('raza', 'index')?>">Raza</a></li>
            <li class="divider"></li>
            <li><a href="<?php // echo routing::getInstance()->getUrlWeb('estado', 'index')?>">Estado</a></li>
            <li class="divider"></li>
          </ul>
        </li>
      </ul>
        <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Fecundador <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
              <li><a href="<?php // echo routing::getInstance()->getUrlWeb('fecundador', 'index')?>">Fecundador</a></li>
            <li class="divider"></li>
            <li><a href="<?php // echo routing::getInstance()->getUrlWeb('raza', 'index')?>">Raza</a></li>
            <li class="divider"></li>
          </ul>
        </li>
      </ul>
        <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Registro Celo <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php  //echo routing::getInstance()->getUrlWeb('registro_celo', 'index')?>">Registro Celo</a></li>
            <li><a href="<?php // echo routing::getInstance()->getUrlWeb('animal', 'index')?>">Animal</a></li>
            <li><a href="<?php //echo routing::getInstance()->getUrlWeb('fecundador', 'index')?>">Fecundador</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i>usuario <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">ajustes</a></li>
            <li class="divider"></li>
            <li><a href="<?php //echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout')?>"><?php echo i18n::__('logout')?></a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

