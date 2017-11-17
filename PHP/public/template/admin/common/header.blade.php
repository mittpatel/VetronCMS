<header id="header">

    <!-- Mobile Button -->
    <button id="mobileMenuBtn"></button>

    <!-- Logo -->
    <span class="pull-left logo-text">
        {{config('aSetting.admin_Name')}}
    </span>

    <!--<form method="get" action="" class="search pull-left hidden-xs">
        <button type="button"><i class="fa fa-search"></i></button>
        <input type="text" class="form-control" name="k" placeholder="Search for something..."/>
    </form>-->

    <nav>
        <ul class="nav pull-right">
            <li class="dropdown pull-left">
                <a style="line-height: 50px;" href="{{url('/')}}" target="_blank" class="dropdown-toggle">

								<span class="user-name">
									<span class="hidden-xs">
										{{admin_language('top_Website')}} &nbsp; |
									</span>
								</span>
                </a>
            </li>
            <li class="dropdown pull-left">
                <a href="javascript:;" style="line-height: 50px;" class="dropdown-toggle" data-toggle="dropdown"
                   data-hover="dropdown"
                   data-close-others="true" aria-expanded="false">
                    <span class="user-name">
                        <span class="hidden-xs">
                            {{admin_language('top_changeLanguage')}}<i class="fa fa-angle-down"></i>
                        </span>
                    </span>
                </a>

                <ul class="dropdown-menu hold-on-click">
                    @foreach($GLOBALS['languageList'] as $languageListVal)
                        <li><a href="{{url('admin/setting/setLanguage',[$languageListVal->folder])}}">&nbsp;&nbsp;{{admin_language($languageListVal->language_key)}}</a></li>
                    @endforeach
                </ul>
            </li>

        </ul>

    </nav>

</header>