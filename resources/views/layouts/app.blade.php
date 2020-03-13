<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.png">
    <title>Iglesia Primitiva - Dashboard</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('/css/plantilla.css') }}">
</head>

<body class="fix-header">

    <style>
        input:disabled
{
	background-color   : #1A2740;
}
    </style>
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="app">
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="{{ url('/home') }}">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><img style="width: 38px; height: 38px; border-radius: 5px" src="/images/users/custom.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="/images/admin-logo-dark.png" alt="home" class="light-logo" />
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><!--<img src="/images/admin-text.png" alt="home" class="dark-logo" />--><!--This is light logo text--><img src="/images/admin-text-dark.png" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                <!-- /Logo -->       
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                    <li class="dropdown">                        
                    </li>
                    <!-- .Task dropdown -->
                    <li class="dropdown">
                                                
                    </li>                                        
                </ul>         
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="/images/users/custom.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{ Auth::User()->TabCon->NomCon }}</b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="/images/users/custom.png" alt="user" /></div>
                                    <div class="u-text">
                                        <h4>{{ Auth::User()->TabCon->NomCon }} {{ Auth::User()->TabCon->ApeCon }}</h4>
                                        <p class="text-muted">{{ Auth::User()->email }}</p><!--<a href="#" class="btn btn-rounded btn-danger btn-sm">Ver Perfil</a>-->
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#" class="btn btn-rounded btn-danger btn-sm">Configuración de mi cuenta</a></li>
                            <!--<li><a href="#"><i class="ti-settings"></i>Configuración de mi Cuenta</a></li>-->
                            <li role="separator" class="divider"></li>
                            <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off">Cerrar Sesión</i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </li>                            
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>


        @if(Auth::check())
          @if (Auth::user()->isLidercdp())
              @include('plantilla.sidebarLidercdp')
          @elseif (Auth::user()->isLiderred())
              @include('plantilla.sidebarLiderred')
          @else
          
          @endif
        @endif

        <div id="page-wrapper">            
            @yield('content')            
        </div>
        
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/plantilla.js') }}"></script>    
    <script type="text/javascript">
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();
    </script>
    
    @yield('scripts')
</body>

</html>
