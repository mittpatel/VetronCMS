<!doctype html>
<html lang="en-US">
@include('admin/common/head')
<style>
	.myclass{
		border: 1px solid #DDDDDD;
		margin-right: 20px;
	}
	.list-unstyled li{
		line-height: 30px;
	}
	
	.myul{
		
		margin-bottom: 10px;
	}
	
	.list-unstyled > .mydescribe{
		line-height: none;
	}
</style>
<body>

<div class="container">
    <div id="wrapper" class="clearfix">

        @include('admin/common/nav')

        @include('admin/common/header')
        <section id="middle">
            @include('admin/common/crumbs')
            <div id="content" class="padding-20">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: white;">
							<span class="title elipsis">
								<strong>{{admin_language('common_lists')}}</strong> <!-- panel title -->
							</span>

                        <ul class="options pull-right list-inline">
                            <li class="">

                                <a href="{{url('admin/setting/theme/add')}}" style="margin-top: 5px;" class="btn btn-primary btn-xs white"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="">
                                    <i class="glyphicon glyphicon-open"></i>上传</a>
                            </li>
                            <li>
                                <a href="{{url('admin/theme/store')}}"
                                   style="margin-top: 5px;" class="btn btn-primary btn-xs"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    {{admin_language('theme_store')}}
                                </a>
                            </li>
                        </ul>

                    </div>

                </div>
                @foreach($themeList as $themeListVal)
                    <div class="col-md-4" style="padding: 0;">

                        <div id="panel-misc-portlet-l4" class="panel panel-default myclass">
                            <div class="panel-heading">
									<span class="elipsis">
										<strong>{{$themeListVal->themeInformation->name}}</strong>
									</span>
                                <span style="color: #909090;">
                                    @if(!$themeListVal->status)
                                        {{--未安装--}}
                                        {{admin_language('theme_notInstalled')}}
                                    @elseif($themeListVal->status==1)
                                        {{--当前--}}
                                        <span style="color: #007600;">{{admin_language('common_active')}}</span>
                                    @elseif($themeListVal->status==2)
                                        {{--未启用--}}
                                        {{admin_language('theme_notEnabled')}}
                                    @endif
                                </span>

                                {{--@if($themeListVal->config->themeRootPath!='default')--}}
                                <ul class="options pull-right relative list-unstyled">
                                    <li>
                                        <a href="{{url('admin/setting/theme',[$themeListVal->onlyFolder])}}"
                                           class="btn btn-success btn-xs white">
                                            <i class="fa fa-edit white"></i>
                                            {{--编辑--}}
                                            {{admin_language('common_edit')}}
                                        </a>
                                    </li>
                                    @if(!$themeListVal->status)
                                        <li>
                                            <a onclick="actionTheme('install','{{$themeListVal->onlyFolder}}')" href="#"
                                               class="btn btn-success btn-xs white">
                                                <i class="fa fa-filter white"></i>
                                                {{--安装--}}
                                                {{admin_language('theme_install')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="actionTheme('delete','{{$themeListVal->onlyFolder}}')"
                                               class="btn btn-danger btn-xs white">
                                                <i class="fa fa-times"></i>
                                                {{--删除--}}
                                                {{admin_language('common_delete')}}
                                            </a>
                                        </li>
                                    @elseif($themeListVal->status==2)
                                        <li>
                                            <a href="#" onclick="actionTheme('enable','{{$themeListVal->onlyFolder}}')"
                                               class="btn btn-success btn-xs white">
                                                <i class="fa fa-filter white"></i>
                                                {{--启用--}}
                                                {{admin_language('theme_enable')}}
                                            </a>
                                        </li>
                                        @if($themeListVal->config->themeRootPath!='default')
                                            <li>
                                                <a href="#"
                                                   onclick="actionTheme('uninstall','{{$themeListVal->onlyFolder}}')"
                                                   class="btn btn-danger btn-xs white">
                                                    <i class="fa fa-times"></i>
                                                    {{--卸载--}}
                                                    {{admin_language('theme_Uninstall')}}
                                                </a>
                                            </li>
                                        @endif

                                    @endif

                                </ul>
                                {{--@endif--}}
                            </div>
                            <!-- panel content -->
                            <div class="panel-body">
                                <img style="width: 100%;"
                                     src="{{asset('template/home/'.$themeListVal->config->themeRootPath.'/'.$themeListVal->config->preview)}}">
                            </div>
                            
                            <div class="panel-body" style="min-height: 215px;">
                            	<h4><strong>{{admin_language('theme_TemplateName')}}：</strong> {{$themeListVal->themeInformation->name}}</h4>
								<ul class="list-unstyled myul">
									<li><strong>{{admin_language('theme_Edition')}}:</strong> {{$themeListVal->themeInformation->version}}</li>
									<li><strong>{{admin_language('theme_Author')}}:</strong> {{$themeListVal->themeInformation->author}}</li>
									<li><strong>{{admin_language('theme_Date')}}:</strong> {{$themeListVal->themeInformation->date}}</li>
									<li style="line-height: 15px;max-height: 45px;min-height: 45px;overflow: hidden;"><strong>{{admin_language('theme_Describe')}}:</strong> {{$themeListVal->themeInformation->describe}}...</li>
								</ul>
								<div class="panel-body">
	                            	<a href="{{url('admin/setting/theme/delete/cache')}}" class="btn btn-danger btn-xs white">
	                                    <i class="fa fa-times"></i>
	                                    	{{admin_language('theme_WipeCache')}}
	                                </a>
	                            </div>
                            </div>                            
                        </div>
                    </div>
                @endforeach

            </div>

            @include('admin/common/footer')
        </section>

    </div>
</div>

@include('admin/common/js')
<script>

    function actionTheme(a, e) {
        /*确认要执行此操作吗*/
        layer.confirm('{{admin_language('theme_areYouSureYouWantToPerformThisOperation')}}', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = "{{url('admin/setting/theme/action')}}?action=" + a + "&theme=" + e
        });
    }

</script>
</body>
</html>