<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar @if(active_if_full_match('admin/purchase/create') == 'active' || active_if_full_match('admin/purchase/*/edit') == 'active' || active_if_full_match('admin/sell/create') == 'active' || active_if_full_match('admin/sell/*/edit') == 'active' || active_if_full_match('admin/requisition/create') == 'active' || active_if_full_match('admin/requisition/*/edit') == 'active') mb-2 @else mb-4 @endif  static-top border-bottom-primary-slim">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav">
        @if(active_if_full_match('purchase/create') == 'active'
        || active_if_full_match('purchase/*/edit') == 'active'
        ||  active_if_full_match('sell/create') == 'active'
        || active_if_full_match('sell/*/edit') == 'active'
        || active_if_full_match('requisition/create') == 'active'
        || active_if_full_match('requisition/*/edit') == 'active'
         )
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt mr-2"></i> <span class="text-dark">{{__('pages.dashboard')}}</span>
                </a>
            </li>
        @endif


        @can('manage_purchase_invoice')
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link" href="{{route('purchase.index')}}">
                    <i class="fa fa-list mr-2"></i>  <span class="text-dark"> {{__('pages.purchase_invoices')}} </span>
                </a>
            </li>
        @endcan
        @can('create_purchase_invoice')
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link" href="{{route('purchase.create')}}">
                    <i class="fa fa-plus mr-2"></i>  <span class="text-dark"> {{__('pages.create_purchase')}} </span>
                </a>
            </li>
        @endcan
        @can('manage_sell_invoice')
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link" href="{{route('sell.index')}}">
                    <i class="fa fa-list mr-2"></i> <span class="text-dark"> {{__('pages.sell_invoice')}} </span>
                </a>
            </li>
        @endcan
        @can('create_sell_invoice')
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link" href="{{route('sell.create')}}">
                    <i class="fa fa-plus mr-2"></i> <span class="text-dark"> {{__('pages.create_invoice')}} </span>
                </a>
            </li>
        @endcan
        @can('manage_requisition')
            <li class="nav-item d-none d-sm-block">
                <a class="nav-link" href="{{route('requisition.index')}}">
                    <i class="fa fa-list mr-2"></i> <span class="text-dark"> {{__('pages.requisition')}} </span>
                </a>
            </li>
        @endcan
    </ul>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter"> {{notifications()->count()}}</span>
            </a>
            <!-- Dropdown - Alerts -->
            @if(notifications()->count() > 0)
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in scroll-bar notification-mb-pos" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Notifications
                    </h6>

                    @foreach(notifications() as $notification)
                        <a class="dropdown-item d-flex align-items-center" href="{{route('notification', $notification->id)}}">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    @if($notification->type == 1)
                                        <i class="fas fa-store text-white"></i>
                                    @else
                                        <i class="fas fa-bell fa-fw text-white"></i>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">{{$notification->created_at->diffForHumans()}}</div>
                                <span class="font-weight-bold">{!! $notification->message !!}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </li>


        @if(active_if_full_match('*/*/*') == 'active')
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
                <todo-st3></todo-st3>
            </li>
        @elseif(active_if_full_match('*/*') == 'active')
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
                <todo-st2></todo-st2>
            </li>
        @else
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
                <todo></todo>
            </li>
        @endif

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @foreach(languages() as $app_lang)
                    @if(config('app.locale') == $app_lang->iso_code)
                        <img class="img-profile h-25" src="{{asset($app_lang->flag)}}">
                    @endif
                @endforeach
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                @foreach(languages() as $app_lang)
                    <a class="dropdown-item" href="{{ url('/local/'.$app_lang->iso_code) }}">
                        <img src="{{asset($app_lang->flag)}}" height="15" class="mr-2">
                         {{$app_lang->language}}
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach

                <a class="dropdown-item btn btn-success text-center" href="{{route('language.create')}}">
                  <button class="btn btn-primary btn-sm"> <i class="fa fa-plus mr-2"></i>   Add Your Language</button>
                </a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
                <img class="img-profile rounded-circle" src="{{asset(auth()->user()->employee->profile_picture != '' ? auth()->user()->employee->profile_picture : 'backend/img/user-placeholder.png')}}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="text-center pt-2 pb-3">

                    <b>{{auth()->user()->name}}</b> <br>
                    Since in {{auth()->user()->created_at->diffForHumans()}}
                </div>
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{route('profile')}}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                   {{__('pages.account_settings')}}
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('password')}}">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>

                    {{__('pages.change_password')}}
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
