<aside id="aside">

    <div class="userinfo">
        <div class="avatar">
            <a href="{{url('admin/profile')}}">
                <img src="{{asset(session('vetronCmsLogin')->header)}}" class="img-responsive img-circle"
                     alt="Jellal Scarlet">
            </a>
        </div>
        <div class="info">
            <span class="username">{{session('vetronCmsLogin')->name}}</span>
            <br>
            <span class="useremail">{{session('vetronCmsLogin')->email}}</span>
        </div>
    </div>
    <nav id="sideNav">
        <ul class="nav nav-list">
            <li class="@if($other['navActive']=='/') active @endif">
                <a class="dashboard" href="{{url('/admin')}}">
                    <i class="main-icon fa fa-dashboard"></i> <span>{{admin_language('menu_home')}}</span>
                </a>
            </li>
            @foreach($GLOBALS['menuDate'] as $key=>$menu)
                @if($menu->p_id==0)
                    <li class="@if($other['navActive']==$menu->active) active @endif">
                        <a href="@if($menu->route=='javascript') javascript:; @endif">
                            <i class="fa fa-menu-arrow pull-right"></i>
                            <i class=" main-icon {{$menu->icon}}"></i>
                            <span>{{admin_language($menu->language_key)}}</span>
                        </a>
                        <ul>
                            @foreach($GLOBALS['menuDate'] as $key_son=>$menu_son)
                                @if($menu->id==$menu_son->p_id)
                                    @if($menu_son->auth=='admin/plugin')
                                        
                                    @endif
                                    <li class="@if($menu_son->active==$other['navActiveSon']) active @endif">
                                        <a href="{{url($menu_son->route)}}">{{admin_language($menu_son->language_key)}}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach


        </ul>

        <h3>{{admin_language('common_more')}}</h3>
        <ul class="nav nav-list">
            <li class="@if($other['navActive']=='navProfile') active @endif">
                <a href="{{url('admin/profile')}}">
                    <i class="main-icon fa fa-user"></i>
                    <span>{{admin_language('menu_profile')}}</span>
                </a>
            </li>
            <li>
                <a href="{{url('admin/logout')}}">
                    <i class="main-icon fa fa-sign-out"></i>
                    <span>{{admin_language('menu_logout')}}</span>
                </a>
            </li>
        </ul>

    </nav>

    <span id="asidebg"><!-- aside fixed background --></span>
</aside>