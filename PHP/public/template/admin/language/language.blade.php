<!doctype html>
<html lang="en-US">
@include('admin/common/head')

<body>

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
                                <a href="{{url('admin/setting/language/add')}}"
                                   style="margin-top: 5px;" class="btn btn-primary btn-xs white fa fa-plus"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="">
                                    {{admin_language('common_add')}}
                                </a>
                            </li>
                            <li>
                                <a href="#" class="opt panel_colapse" data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Colapse"></a>
                            </li>
                            <li>
                                <a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a>
                            </li>
                            <li>
                                <a href="#" class="opt panel_close" data-confirm-title="Confirm"
                                   data-confirm-message="Are you sure you want to remove this panel?"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Close"><i
                                            class="fa fa-times"></i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table" id="datatable_sample">
                                <thead>
                                <tr>
                                    <th>{{admin_language('language_language')}}</th>
                                    <th>{{admin_language('common_status')}}</th>
                                    <th>{{admin_language('language_module')}}</th>
                                    <th></th>
                                    <th style="width: 260px;">{{admin_language('common_action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="background-color: #E8E8E8;">
                                    <td colspan="5"
                                        style="font-size: 16px;">{{admin_language('language_frontDesk')}}</td>
                                </tr>
                                @foreach($language as $value)
                                    @if($value->modular==1)
                                        <tr class="odd gradeX">
                                            <td>
                                                {{admin_language($value->language_key)}}
                                            </td>
                                            <td>
                                                <label class="switch switch-success switch-round">
                                                    <input value="{{$value->name}}" class="checkbox_status"
                                                           onchange="changeStatus({{$value->id}})" type="checkbox"
                                                           @if($value->status==1) checked @endif>
                                                    <span class="switch-label" data-on="on" data-off="off"></span>
                                                </label>
                                            </td>
                                            <td>
                                                {{admin_language('language_frontDesk')}}
                                            </td>
                                            <td>
                                                @if(env('HOME_LOCALE')==$value->folder)
                                                    {{admin_language('lang_Default')}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(env('HOME_LOCALE')!=$value->folder)
                                                    <a onclick="activeLang(this,'{{$value->id}}')"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-filter white"></i>
                                                        {{admin_language('_langSetAsDefault')}}
                                                    </a>
                                                    <a href="{{url('admin/setting/language/edit',[$value->folder,$value->file_name])}}"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-edit white"></i>
                                                        {{admin_language('common_edit')}}
                                                    </a>
                                                    <a dataId="{{$value->id}}" onclick="deleteLanguage(this)"
                                                       href="javascript:;" data-id="1"
                                                       class="btn btn-danger btn-xs white delete">
                                                        <i class="fa fa-times white"></i>
                                                        <span>{{admin_language('common_delete')}}</span>
                                                    </a>
                                                @else
                                                    <a href="{{url('admin/setting/language/edit',[$value->folder,$value->file_name])}}"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-edit white"></i>
                                                        {{admin_language('common_edit')}}
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endif

                                @endforeach

                                <tr style="background-color: #E8E8E8;">
                                    <td colspan="5"
                                        style="font-size: 16px;">{{admin_language('language_backstage')}}</td>
                                </tr>

                                @foreach($language as $value)
                                    @if($value->modular==2)
                                        <tr class="odd gradeX">
                                            <td>
                                                {{admin_language($value->language_key)}}
                                            </td>
                                            <td>
                                                <label class="switch switch-success switch-round">
                                                    <input value="{{$value->name}}" class="checkbox_status"
                                                           onchange="changeStatus({{$value->id}})" type="checkbox"
                                                           @if($value->status==1) checked @endif>
                                                    <span class="switch-label" data-on="on" data-off="off"></span>
                                                </label>
                                            </td>
                                            <td>
                                                {{admin_language('language_backstage')}}
                                            </td>
                                            <td>
                                                @if(env('ADMIN_LOCALE')==$value->folder)
                                                    {{admin_language('lang_Default')}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(env('ADMIN_LOCALE')!=$value->folder)

                                                    <a onclick="activeLang(this,'{{$value->id}}')"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-filter white"></i>
                                                        {{admin_language('_langSetAsDefault')}}
                                                    </a>

                                                    <a href="{{url('admin/setting/language/edit',[$value->folder,$value->file_name])}}"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-edit white"></i>
                                                        {{admin_language('common_edit')}}
                                                    </a>
                                                    <a dataId="{{$value->id}}" onclick="deleteLanguage(this)"
                                                       href="javascript:;" data-id="1"
                                                       class="btn btn-danger btn-xs white delete">
                                                        <i class="fa fa-times white"></i>
                                                        {{admin_language('common_delete')}}
                                                    </a>
                                                @else
                                                    <a href="{{url('admin/setting/language/edit',[$value->folder,$value->file_name])}}"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-edit white"></i>
                                                        {{admin_language('common_edit')}}
                                                    </a>
                                                @endif
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

    function deleteLanguage(e) {
        var id = $(e).attr('dataId');
        layer.confirm('{{admin_language('common_areYouDelete')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = "{{url('admin/setting/language/delete')}}" + "/" + id
        });
    }

    function changeStatus(e) {
        var ajaxStatus = layer.load();
        $.ajax({
            type: 'GET',
            url: "{{url('admin/setting/language/status')}}" + '/' + e,
            success: function (data) {
                data = $.parseJSON(data);
                if (data.status == 1) {
                    layer.close(ajaxStatus);
                }
            }
        });
    }

    function activeLang(e, id) {
        layer.confirm('{{admin_language('lang_AreYouSureYouWa')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location  = "{{url('admin/setting/language/active')}}" + '/' + id;
        });
    }
</script>
</body>
</html>