
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Bufeo</b>Sale</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

        <!--Barra de notificaciones-->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo _SERVER_;?><?php echo $this->crypt->decrypt($_SESSION['user_image'],_PASS_);?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->crypt->decrypt($_SESSION['user_nickname'],_PASS_);?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo _SERVER_;?><?php echo $this->crypt->decrypt($_SESSION['user_image'],_PASS_);?>" class="img-circle" alt="User Image">

                <p>
                    <?php echo  $this->crypt->decrypt($_SESSION['user_nickname'],_PASS_);?>
                  <small>Rol de Usuario: <?php echo $this->crypt->decrypt($_SESSION['role_name'],_PASS_);?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo _SERVER_;?>Edit/changepass" class="btn btn-default btn-flat">Contraseña</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo _SERVER_;?>api/Logout/singOut" class="btn btn-default btn-flat">Cerrar Sesion</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo _SERVER_;?><?php echo $this->crypt->decrypt($_SESSION['user_image'],_PASS_);?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->crypt->decrypt($_SESSION['user_nickname'],_PASS_);?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
        </div>
      </div>
      <!-- search form -->
      <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menú Principal</li>
        <?php
        foreach ($navs as $nav){
            $activom = '';
            if($nav->menu_controller == $_SESSION['controlador']){
                $activom = "active";
                $_SESSION['controlador'] = $nav->menu_name;
                $_SESSION['icono'] = $nav->menu_icon;
                //Obtener el Nombre del Controlador y de la Funcion
                $name = $this->nav->listOptionName($_SESSION['controlador'], $_SESSION['accionnav']);
                $_SESSION['accion'] = $name->optionm_name;
            }
            ?>
            <li class="<?php echo $activom;?> treeview">
                <a href="#">
                    <i class="<?php echo $nav->menu_icon;?>"></i> <span><?php echo $nav->menu_name;?></span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <?php
                    $option = $this->nav->listOptions($nav->id_menu);
                    foreach ($option as $o){
                        $activoo = '';
                        if($activom == "active"){
                            if($o->optionm_function == $_SESSION['accionnav'] && $activom == "active"){
                                $activoo = "class=\"active\"";
                            }
                        }
                        ?><li <?php echo $activoo;?>><a  href="<?php echo _SERVER_. $nav->menu_controller . '/'. $o->optionm_function;?>"><i class="fa fa-circle-o"></i><?php echo $o->optionm_name;?></a></li><?php
                    }
                    ?>
                </ul>
            </li>
            <?php
        }
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


  <div class="control-sidebar-bg"></div>