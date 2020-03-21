
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <!--<li> <a href="index.html" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard <span class="fa arrow"></span> <span class="label label-rouded label-inverse pull-right">4</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="index.html"><i class=" fa-fw">1</i><span class="hide-menu">Dashboard 1</span></a> </li>
                            <li> <a href="index2.html"><i class=" fa-fw">2</i><span class="hide-menu">Dashboard 2</span></a> </li>
                            <li> <a href="index3.html"><i class=" fa-fw">3</i><span class="hide-menu">Dashboard 3</span></a> </li>
                        </ul>
                    </li>-->
                    <li> <a href="#" class="waves-effect"><i class="mdi mdi-home-variant fa-fw">CP</i> <span class="hide-menu">Casas de Paz<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li @click="menu=3">
                                <a href="#">
                                <i class="fa-fw">CP</i> <span class="hide-menu">Ver Casas de Paz de mi Red</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li> <a href="#" class="waves-effect"><i class="mdi mdi-home-variant fa-fw">IN</i> <span class="hide-menu">Informes<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li @click="menu=4">
                                <a href="#">
                                <i class="fa-fw">IR</i> <span class="hide-menu">Ver Informes Recibidos</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--<li> <a href="#" class="waves-effect"><i class="mdi mdi-home-variant fa-fw">GU</i> <span class="hide-menu">Gestión de Usuarios<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li @click="menu=5">
                                <a href="#">
                                <i class="fa-fw">AU</i> <span class="hide-menu">Añadir Usuario</span>
                                </a>
                            </li>
                        </ul>
                    </li>-->
                </ul>
            </div>
        </div>