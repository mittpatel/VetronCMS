<!doctype html>
<html lang="en-US">
@include('admin/common/head')
<style>

    .plugin_avater {
        position: relative;
        width: 72px;
        top: -11px
    }

    .plugin_athor {
        height: 30px;
        line-height: 30px;
    }

    .plugin-text-right {
        float: right;
    }

    .plugin-settting {
        height: 21px;
        line-height: 21px;
    }

</style>
<body>
<script>
    var updateData = new Array();
</script>
<div class="container">
    <div id="wrapper" class="clearfix">

        @include('admin/common/nav')

        @include('admin/common/header')

        <section id="middle">
            @include('admin/common/crumbs')
            <div id="content" class="dashboard padding-20">
                <div id="panel-1" class="panel panel-default">
                    <div class="panel-heading">
							<span class="title elipsis">
								<strong>{{admin_language('common_lists')}}</strong>
							</span>

                        <ul class="options pull-right list-inline">

                            <li>
                                <a href="{{url('admin/plugin/store')}}"
                                   style="margin-top: 5px;" class="btn btn-primary btn-xs white fa fa-shopping-cart"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="">
                                    {{--插件商店--}}
                                    {{admin_language('plugin_PluginStore')}}
                                </a>
                            </li>

                            <li>
                                <a href="javascript:;" onclick="DetectionUpdate(1);"
                                   style="margin-top: 5px;" class="btn btn-danger btn-xs white fa fa-refresh"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="">
                                    {{--检查更新--}}
                                    {{admin_language('plugin_CheckForUpdates')}}
                                </a>
                            </li>

                        </ul>
                    </div>


                    {{--暂没有下载插件--}}
                    @if(count($pluginList['enabled'])==0 && count($pluginList['uninstalled'])==0 && count($pluginList['unenabled'])==0)
                        <div class="panel-title">
                            <h6 class="page-header">
                                <i class="fa fa-refresh text-success"></i>
                                {{admin_language('plugin_ThereIsNoDownlo')}}
                            </h6>
                        </div>
                    @endif

                    @if(count($pluginList['enabled'])>0)
                        <div class="panel-title">
                            {{--已启用的插件--}}
                            <h6 class="page-header">
                                <i class="fa fa-check-square text-success"></i>
                                {{admin_language('plugin_EnabledPlugins')}}
                            </h6>
                        </div>

                        <div class="panel-body">
                            {{--已经启用的插件--}}
                            @foreach($pluginList['enabled'] as $v=>$plugin)

                                <div class="clearfix search-result"><!-- item -->
                                    <img src="{{plugin_assets($plugin->name,$plugin->avatar)}}" class="plugin_avater"/>
                                    <h4>{{$plugin->title}} {{$plugin->version}} ({{$plugin->name}})</h4>
                                    {{--作者     评分--}}
                                    <p class="plugin_athor">
                                        {{admin_language('plugin_Author')}}：{{$plugin->author}}
                                        &nbsp;&nbsp | &nbsp
                                        <a target="_blank"
                                           href="{{url("admin/plugin/action",["score",$plugin->name])}}">
                                            {{admin_language('plugin_Score')}}
                                        </a>
                                        {{--举报--}}
                                        <a target="_blank"
                                           href="{{url("admin/plugin/action",["report",$plugin->name])}}"
                                           class="plugin-text-right">
                                            {{admin_language('plugin_Report')}}
                                        </a>
                                    </p>
                                    <p class="update_{{$plugin->name}} update_update_">
                                        {{--版本--}}
                                        {{admin_language('index_version')}} :
                                        {{$plugin->version}}
                                        <span style="color: red;">
                                        </span>
                                    </p>
                                    <script>
                                        updateData.push({
                                            version: "{{$plugin->version}}",
                                            name: "{{$plugin->name}}",
                                            elClass: "update_{{$plugin->name}}"
                                        });
                                    </script>

                                    <p class="plugin-settting">

                                        <span>
                                            @foreach($plugin['setting'] as $k=>$s)
                                                <a target="_blank"
                                                   href="{{url($s)}}">{{plugin_trans($plugin->name,$k)}}</a>
                                                @if(end($plugin['setting'])!=$s)| @endif
                                            @endforeach
                                        </span>


                                        <span class="plugin-text-right">
                                            {{--禁用--}}
                                            <a onclick="actionPlugin('{{url("admin/plugin/action",["disable",$plugin->name])}}')"
                                               href="javascript:;">{{admin_language('plugin_Disable')}}</a> &nbsp;
                                            {{--更新--}}
                                            <a onclick="actionPlugin('{{url("admin/plugin/action",["update",$plugin->name])}}')"
                                               href="javasxript:;">{{admin_language('plugin_ToUpdate')}}</a>

                                        </span>
                                    </p>
                                </div>

                            @endforeach
                        </div>

                    @endif


                    @if(count($pluginList['unenabled'])>0)
                        <div class="panel-title">
                            <h6 class="page-header">
                                <i class="fa fa-circle text-warning"></i>
                                {{admin_language('plugin_PluginsNotEnabl')}}
                            </h6>
                        </div>

                        <div class="panel-body">
                            {{--未启用的插件--}}
                            @foreach($pluginList['unenabled'] as $v=>$plugin)

                                <div class="clearfix search-result"><!-- item -->
                                    <img src="{{plugin_assets($plugin->name,$plugin->avatar)}}" class="plugin_avater"/>
                                    <h4>{{$plugin->title}} {{$plugin->version}} ({{$plugin->name}})</h4>
                                    <p class="plugin_athor">{{admin_language('plugin_Author')}}：{{$plugin->author}}
                                        &nbsp;&nbsp; | &nbsp; <a target="_blank"
                                                                 href="{{url("admin/plugin/action",["score",$plugin->name])}}">
                                            {{admin_language('plugin_Score')}}
                                        </a>
                                        {{--举报--}}
                                        <a target="_blank"
                                           href="{{url("admin/plugin/action",["report",$plugin->name])}}"
                                           class="plugin-text-right">
                                            {{admin_language('plugin_Report')}}
                                        </a>
                                    </p>
                                    <p class="update_{{$plugin->name}} update_update_">
                                        {{--版本--}}
                                        {{admin_language('index_version')}} :
                                        {{$plugin->version}}
                                        <span style="color: red;">
                                        </span>
                                    </p>
                                    <script>
                                        updateData.push({
                                            version: "{{$plugin->version}}",
                                            name: "{{$plugin->name}}",
                                            elClass: "update_{{$plugin->name}}"
                                        });
                                    </script>
                                    <p class="plugin-settting">
                                        <span class="plugin-text-right">
                                            <a onclick="actionPlugin('{{url("admin/plugin/action",["enable",$plugin->name])}}')"
                                               href="javascript:;">
                                                {{admin_language('plugin_Enable')}}
                                            </a> &nbsp;
                                            <a onclick="actionPlugin('{{url("admin/plugin/action",["update",$plugin->name])}}')"
                                               href="javascript:;">
                                                {{admin_language('plugin_ToUpdate')}}
                                            </a> &nbsp;
                                            <a onclick="actionPlugin('{{url("admin/plugin/action",["uninstall",$plugin->name])}}')"
                                               href="javascript:;">
                                                {{admin_language('plugin_Uninstall')}}
                                            </a>
                                        </span>
                                    </p>
                                </div>

                            @endforeach

                        </div>
                    @endif

                    @if(count($pluginList['uninstalled'])>0)
                        <div class="panel-title">
                            {{--未安装的插件--}}
                            <h6 class="page-header"><i
                                        class="fa fa-circle text-danger"></i>{{admin_language('plugin_PluginsNotInsta')}}
                            </h6>
                        </div>

                        <div class="panel-body">
                            {{--未安装的插件--}}
                            @foreach($pluginList['uninstalled'] as $v=>$plugin)

                                <div class="clearfix search-result"><!-- item -->
                                    <img src="{{plugin_assets($plugin->name,$plugin->avatar)}}" class="plugin_avater"/>
                                    <h4>{{$plugin->title}} {{$plugin->version}} ({{$plugin->name}})</h4>
                                    <p class="plugin_athor">{{admin_language('plugin_Author')}}：{{$plugin->author}}
                                        <a onclick="actionPlugin('{{url("admin/plugin/action",["install",$plugin->name])}}')"
                                           href="javascript:;"
                                           class="plugin-text-right">{{admin_language('plugin_Install')}}</a></p>

                                </div>

                            @endforeach

                        </div>

                    @endif
                </div>

            </div>

            @include('admin/common/footer')
        </section>

    </div>
</div>

@include('admin/common/js')
<script>
    function actionPlugin(url) {
        layer.confirm('{{admin_language('theme_areYouSureYouWantToPerformThisOperation')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = url
        });

    }
</script>
<script>
    function DetectionUpdate(ii) {
        if(ii==1){
            layer.load();
        }
        $.ajax({
            type: 'GET',
            url: "{{trim(CMS_DEVELOPER,'/').'/'.'detection/update'}}",
            data: {data: updateData, type: 'plugin'},
            dataTypr: 'json',
            success: function (data) {
                layer.closeAll('loading');
                for (var i in data) {
                    if (data[i].status == 1) {
                        $("." + data[i].elClass).find('span').html(data[i].msg);
                    }
                }
            },
        });
    }
    DetectionUpdate(2);

</script>
</body>
</html>