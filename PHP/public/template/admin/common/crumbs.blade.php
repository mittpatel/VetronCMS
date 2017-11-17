<header id="page-header">
    <h1><a href="{{url('admin')}}" style="color: #1B1819;">{{admin_language('common_home')}}</a></h1>
    <ol class="breadcrumb">
        {{--模块首页--}}
        <li><a href="{{url('admin/'.session('breadcrumb')['url'])}}">{{session('breadcrumb')['modular']}}</a></li>
        <li class="active">{{session('breadcrumb')['action']}}</li>
    </ol>
</header>