<!doctype html>
<html lang="en-US">
@include('admin/common/head')

<body>

<div class="container">
    <div id="wrapper" class="clearfix">
        {{--左侧导航--}}
        @section('nav')
            @include('admin/common/nav')
        @show
        @include('admin/common/header')

        <section id="middle">
            @include('admin/common/crumbs')
            {{--内容区--}}
            @section('content')
                <div id="content" class="dashboard padding-20">
                    <div id="panel-1" class="panel panel-default">
                        <div class="panel-heading">
                                <span class="title elipsis">
                                    <strong>{{admin_language('index_systemInformation')}}</strong> <!-- panel title -->
                                </span>

                            <ul class="options pull-right list-inline">
                                <li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                                       data-placement="bottom"></a></li>
                                <li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip"
                                       title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
                            </ul>

                        </div>

                        <div class="panel-body">


                            <div class="row">

                                <div class="col-md-6">

                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <h4>CMS {{admin_language('index_information')}}</h4>

                                            <div class="table-responsive">
                                                <table class="table table-bordered nomargin">

                                                    <tbody>
                                                    <tr>
                                                        <td>{{admin_language('index_systemName')}}</td>
                                                        <td>VETRON CMS</td>
                                                    </tr>

                                                    <tr>
                                                        <td>{{admin_language('index_version')}}</td>
                                                        <td>1.0.0</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{admin_language('index_team')}}</td>
                                                        <td>CMS TEAM</td>
                                                    </tr>

                                                    <tr>
                                                        <td>{{admin_language('index_company')}}</td>
                                                        <td>Shenzhen Vetron Technology Co., Ltd.</td>

                                                    </tr>

                                                    <tr>
                                                        <td>{{admin_language('index_address')}}</td>
                                                        <td>Shenzhen Jinfeng Building Shangbu South road Futian District City,
                                                            13C
                                                        </td>

                                                    </tr>

                                                    <tr>
                                                        <td>{{admin_language('index_phone')}}</td>
                                                        <td>0755-8270-8271</td>

                                                    </tr>

                                                    <tr>
                                                        <td>{{admin_language('index_theOfficialWebsite')}}</td>
                                                        <td><a href="http://szvetron.com">http://szvetron.com</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{admin_language('index_community')}}</td>
                                                        <td>
                                                            <a href="http://cms.szvetron.com">http://cms.szvetron.com</a>
                                                        </td>
                                                    </tr>


                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                            <h4>{{admin_language('index_serverInformation')}}</h4>

                                            <div class="table-responsive">
                                                <table class="table table-bordered nomargin">

                                                    <tbody>
                                                    <tr>
                                                        <td>{{admin_language('index_operatingSystem')}}</td>
                                                        <td>{{PHP_OS}}</td>

                                                    </tr>

                                                    <tr>
                                                        <td>{{admin_language('index_EnvironmentalScience')}}<!--Server Env--></td>
                                                        <td>{{$_SERVER["SERVER_SOFTWARE"]}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{admin_language('index_port')}}</td>
                                                        <td>{{$_SERVER['SERVER_PORT']}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>PHP {{admin_language('index_version')}}</td>
                                                        <td>{{PHP_VERSION}}</td>

                                                    </tr>

                                                    <tr>
                                                        <td>{{admin_language('index_maximumUploadSize')}}</td>
                                                        <td>{{ini_get("file_uploads") ? ini_get("upload_max_filesize") : "Disabled"}}</td>

                                                    </tr>


                                                    <tr>
                                                        <td>{{admin_language('index_systemTime')}}</td>
                                                        <td>{{date('Y-m-d H:i:s')}}</td>

                                                    </tr>

                                                    <tr>
                                                        <td>{{admin_language('index_BrowserInformation')}}</td>
                                                        <td>{{substr($_SERVER['HTTP_USER_AGENT'], 0, 40)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{admin_language('index_domain')}}</td>
                                                        <td>{{$_SERVER['SERVER_NAME']}}
                                                            [{{gethostbyname($_SERVER['SERVER_NAME'])}}]
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>IP<!--User IP address--></td>
                                                        <td>{{$_SERVER['REMOTE_ADDR']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{admin_language('index_ResidualSpace')}}</td>
                                                        <td>{{round((disk_free_space(".")/(1024*1024)),2)}}M</td>
                                                    </tr>


                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            @show

        </section>

    </div>
</div>

@include('admin/common/js')
{{--javascript--}}
@section('javascript')
@show
</body>
</html>