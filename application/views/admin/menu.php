<!-- Side Navbar -->
<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center"><img src="<?php echo base_url('assets/img/icone.png'); ?>" alt="icone" class="img-fluid rounded-circle">
                <h2 class="h5">Compras APP</h2><span></span>
            </div>
            <!-- Small Brand information, appears on minimized sidebar-->
            <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <h5 class="sidenav-heading">Main</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">                  
                <li><a href="<?php echo base_url('Home'); ?>"><i class="icon-home"></i>Home</a></li>
                <li><a href="<?php echo base_url('Categorias'); ?>"><i class="icon-form"></i>Categorias</a></li>               
                <li><a href="<?php echo base_url('Produtos'); ?>"><i class="icon-form"></i>Marcas</a></li>            
                <li><a href="<?php echo base_url('Produtos'); ?>"><i class="icon-form"></i>Produtos</a></li>            
            </ul>
        </div>

    </div>
</nav>
<div class="page">
    <!-- navbar-->
    <header class="header">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                            <div class="brand-text d-none d-md-inline-block"><span>Compras </span><strong class="text-primary">App</strong></div></a></div>
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                        <!-- Messages dropdown-->
                        <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-envelope"></i><span class="badge badge-info">10</span></a>
                            <ul aria-labelledby="notifications" class="dropdown-menu">
                                <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                        <div class="msg-profile"> <img src="img/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="msg-body">
                                            <h3 class="h5">Mensagens</h3><span>Menagenns</span><small>Texto</small>
                                        </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                        <div class="msg-profile"> <img src="img/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="msg-body">
                                            <h3 class="h5">Mensagens</h3><span>Menagenns</span><small>Texto</small>
                                        </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
                                        <div class="msg-profile"> <img src="img/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
                                        <div class="msg-body">
                                            <h3 class="h5">Mensagens</h3><span>Menagenns</span><small>Texto</small>
                                        </div></a></li>
                                <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-envelope"></i>Ver todas as mensagens   </strong></a></li>
                            </ul>
                        </li>

                        <!-- Log out-->
                        <li class="nav-item"><a href="login.html" class="nav-link logout"> <span class="d-none d-sm-inline-block">Sair</span><i class="fa fa-sign-out"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>