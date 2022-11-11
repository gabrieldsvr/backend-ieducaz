<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start me-lg-3">
                <div>
                    <a class="navbar-brand brand-logo" href="{{route("dashboard")}}">
                        <h3 class="text-white">ADMIN SYSTEM</h3>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{route("dashboard")}}">
                        <img src="../../../../images/logo-mini-reverse.svg" alt="logo"/>
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav navbar-nav-right">
                    {{--                    <li class="nav-item dropdown">--}}
                    {{--                        <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">--}}
                    {{--                            <i class="icon-mail icon-lg"></i>--}}
                    {{--                        </a>--}}
                    {{--                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">--}}
                    {{--                            <a class="dropdown-item py-3 border-bottom">--}}
                    {{--                                <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>--}}
                    {{--                                <span class="badge badge-pill badge-primary float-right">View all</span>--}}
                    {{--                            </a>--}}
                    {{--                            <a class="dropdown-item preview-item py-3">--}}
                    {{--                                <div class="preview-thumbnail">--}}
                    {{--                                    <i class="mdi mdi-alert m-auto text-primary"></i>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="preview-item-content">--}}
                    {{--                                    <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>--}}
                    {{--                                    <p class="fw-light small-text mb-0"> Just now </p>--}}
                    {{--                                </div>--}}
                    {{--                            </a>--}}
                    {{--                            <a class="dropdown-item preview-item py-3">--}}
                    {{--                                <div class="preview-thumbnail">--}}
                    {{--                                    <i class="mdi mdi-settings m-auto text-primary"></i>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="preview-item-content">--}}
                    {{--                                    <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>--}}
                    {{--                                    <p class="fw-light small-text mb-0"> Private message </p>--}}
                    {{--                                </div>--}}
                    {{--                            </a>--}}
                    {{--                            <a class="dropdown-item preview-item py-3">--}}
                    {{--                                <div class="preview-thumbnail">--}}
                    {{--                                    <i class="mdi mdi-airballoon m-auto text-primary"></i>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="preview-item-content">--}}
                    {{--                                    <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>--}}
                    {{--                                    <p class="fw-light small-text mb-0"> 2 days ago </p>--}}
                    {{--                                </div>--}}
                    {{--                            </a>--}}
                    {{--                        </div>--}}
                    {{--                    </li>--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator disabled" id="messageDropdown" href="#"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="icon-bell"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0"
                             aria-labelledby="messageDropdown">
                            <a class="dropdown-item py-3">
                                <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                                <span class="badge badge-pill badge-primary float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="../../../../images/faces/face10.jpg" alt="image"
                                         class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="../../../../images/faces/face12.jpg" alt="image"
                                         class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="../../../../images/faces/face1.jpg" alt="image"
                                         class="img-sm profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow py-2">
                                    <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown  d-none d-lg-flex user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../../../../images/faces/face8.jpg"
                                 alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../../../../images/faces/face8.jpg"
                                     alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold"><?=auth()->user()->name?></p>
                                <p class="fw-light text-muted mb-0"><?=auth()->user()->email?></p>
                            </div>
                            <a class="dropdown-item disabled"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile

                            </a>
                            <a class="dropdown-item disabled"><i
                                    class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i>
                                Messages </a>
                            <a class="dropdown-item disabled"><i
                                    class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i>
                                Activity </a>
                            <a class="dropdown-item disabled"><i
                                    class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ
                                </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{route('logout')}}"
                                   onclick="event.preventDefault(); this.closest('form').submit();"><i
                                        class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                            </form>

                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="horizontal-menu-toggle">
                    <span class="ti-menu"></span>
                </button>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dashboard')}}">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('website',[0])}}" class="nav-link disabled">
                        <i class="icon-screen-desktop menu-icon"></i>
                        <span class="menu-title ">Web Site</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('website',[0])}}" class="nav-link disabled">
                        <i class="icon-graph menu-icon"></i>
                        <span class="menu-title ">Estátisticas</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('website',[0])}}" class="nav-link disabled">
                        <i class="icon-calendar menu-icon"></i>
                        <span class="menu-title ">Agenda</span></a>
                </li>

                <li class="nav-item">
                    <a href="{{route('people.index')}}" class="nav-link">
                        <i class="icon-mail menu-icon"></i>
                        <span class="menu-title">CRM</span>
                        <i class="menu-arrow"></i></a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('funnel.index')}}">Dashboard de vendas</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{route('funnel.index')}}">Imovel Ideal</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('funnel.index')}}">Cliente Ideal</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{route('people.index')}}" class="nav-link">
                        <i class="icon-user menu-icon"></i>
                        <span class="menu-title">Clientes</span>
                        <i class="menu-arrow"></i></a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="{{route('people.create')}}">Novo Cliente</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('people.index')}}">Meus Clientes</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{route('imovel.index')}}" class="nav-link">
                        <i class="icon-home menu-icon"></i>
                        <span class="menu-title">Imóveis</span>
                        <i class="menu-arrow"></i></a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="{{route('imovel.create')}}">Novo</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('imovel.index')}}">Listar</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
