<!doctype html>
<html lang="en-US">
@include('admin/common/head')

<body>

<div class="container">
    <!-- WRAPPER -->
    <div id="wrapper" class="clearfix">

        @include('admin/common/nav')

        @include('admin/common/header')

        <section id="middle">
            @include('admin/common/crumbs')
            {{--内容区--}}
            <div id="content" class="dashboard padding-20">
                <div id="panel-1" class="panel panel-default">
                    <div class="panel-heading">
							<span class="title elipsis">
								<strong>{{admin_language('common_lists')}}</strong> <!-- panel title -->
							</span>

                        <!-- right options -->
                        <ul class="options pull-right list-inline">


                            <li>
                                <a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                                   data-placement="bottom"></a>
                            </li>
                            <li>
                                <a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip"
                                   title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a>
                            </li>
                            <li>
                                <a href="#" class="opt panel_close" data-confirm-title="Confirm"
                                   data-confirm-message="Are you sure you want to remove this panel?"
                                   data-toggle="tooltip" title="Close" data-placement="bottom"><i
                                            class="fa fa-times"></i></a>
                            </li>
                        </ul>
                        <!-- /right options -->

                    </div>

                    <!-- panel content -->
                    <div class="panel-body">
                        <div class="table-responsive" style="overflow-x: hidden">
                            <table class="table table-striped table-hover  dataTable no-footer"
                                   id="datatable_sample">
                                <thead>
                                <tr>
                                    <th>{{admin_language('common_name')}}</th>
                                    <th style="">{{admin_language('theme_fileType')}}</th>
                                    <th style="">{{admin_language('theme_updateTime')}}</th>
                                    <th style="width: 180px;">{{admin_language('common_action')}}</th>
                                </tr>
                                </thead>
                                <tbody class="line-height-40">
                                @if(!$isRoot)
                                    <tr>
                                        <td colspan="4">
                                            <a href="{{url('admin/setting/theme',[$theme])}}?path={{$upPath}}"> . .
                                                .</a>
                                        </td>
                                    </tr>
                                @endif

                                @foreach($files as $file)
                                    @if($file!='.' && $file!='..')
                                        <tr class="odd gradeX">
                                            <td>
                                                @if($file['isDir']==1)
                                                    <a href="{{url('admin/setting/theme',[$theme])}}?path={{$file['path']}}">{{$file['name']}}</a>
                                                @else
                                                    {{$file['name']}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$file['suffix']}}
                                            </td>
                                            <td>
                                                {{$file['time']}}
                                            </td>
                                            <td>
                                                <a @if(!$file['allowEdit']) disabled href="javascript:;" @endif
                                                @if($file['isDir']==1)
                                                onclick="changeName('{{$file['path']}}')"
                                                   @else
                                                   href="{{url('admin/setting/theme/change/file')}}?file={{$file['name']}}&path={{$nowPath}}&theme={{$theme}}"
                                                   @endif
                                                   class="btn btn-success btn-xs white"><i
                                                            class="fa fa-edit white"></i>
                                                    {{admin_language('common_edit')}}
                                                </a>
                                                <a onclick="deleteFile('{{$theme.$nowPath.'/'.$file['name']}}')"
                                                   href="javascript:;"
                                                   class="btn btn-danger btn-xs white delete">
                                                    <i class="fa fa-times white"></i>
                                                    {{admin_language('common_delete')}}
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

            @include('admin/common/footer')
        </section>

    </div>
</div>

@include('admin/common/js')
<script>
    function changeName(str) {
        var indexprompt = layer.prompt({
            title: '{{admin_language('theme_EnterANewName')}}',
            formType: 3,		//3是明文，1是密文，2是文本域
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'],
        }, function (text) {		//text是输入的值
            layer.close(indexprompt);
            var changeNameS = layer.load();
            $.ajax({
                type: 'GET',
                url: "{{url('admin/setting/theme/change/FolderName')}}",
                data: {path: str, name: text, theme: '{{$theme}}', upPath: '{{$upPath}}'},
                success: function (data) {
                    layer.close(changeNameS)
                    data = $.parseJSON(data);
                    if (data.status == 1) {
                        layer.msg(data.msg);
                        window.location.reload();
                    } else {
                        layer.msg(data.msg);
                    }
                },
                error: function () {
                }
            });
        });
    }
    function deleteFile(s) {
        /*确认要执行此操作吗*/
        layer.confirm('{{admin_language('theme_areYouSureYouWantToPerformThisOperation')}}', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = "{{url('admin/setting/theme/change/delete')}}?s=" + s
        });
    }

</script>
</body>
</html>