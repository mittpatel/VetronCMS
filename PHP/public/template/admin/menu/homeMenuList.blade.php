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
								<strong>{{admin_language('common_lists')}}</strong> <!-- panel title -->
							</span>

                        <!-- right options -->
                        <ul class="options pull-right list-inline">

                            <li>
                                <a href="{{url('admin/setting/homemenu/add')}}" style="margin-top: 5px;"
                                   class="btn btn-primary btn-xs white fa fa-plus" data-toggle="tooltip"
                                   title="" data-placement="bottom" data-original-title="">
                                    {{admin_language('common_add')}}
                                </a>
                            </li>
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
                        <div class="table-responsive">
                            <table class="table" id="datatable_sample">
                                <thead>
                                <tr>
                                    <th>{{admin_language('common_name')}}</th>
                                    <th>{{admin_language('common_route')}}</th>
                                    <th>{{admin_language('menu_NewWindow')}}</th>
                                    <th>{{admin_language('common_type')}}</th>
                                    <th>{{admin_language('common_active')}}</th>
                                    <th>{{admin_language('common_icon')}}</th>
                                    <th>{{admin_language('common_display')}}</th>
                                    <th>{{admin_language('menuM_index')}}</th>
                                    <th>{{admin_language('common_createTime')}}</th>
                                    <th style="width: 200px;">{{admin_language('common_action')}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($data as $dataS)

                                    <tr class="odd gradeX">

                                        <td style="@if($dataS->level==0) font-size:110%;@endif">
                                            @if($dataS->level==0)
                                                <b>{{home_language($dataS->language_key)}}</b>
                                            @elseif($dataS->level!=0)
                                                {{str_repeat("─ ",$dataS->level)}}{{home_language($dataS->language_key)}}
                                            @endif
                                        </td>
                                        <td title="
                                            @if(ifHttpHttps($dataS->route))
                                            {{$dataS->route}}
                                            @else
                                            {{url($dataS->route)}}
                                            @endif
                                        ">
                                            @if(ifHttpHttps($dataS->route))
                                            {{pure_text($dataS->route,50)}}
                                                @else
                                                {{pure_text(url($dataS->route),50)}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($dataS->target==1)

                                                <span style="color: #c0a16b">
                                                {{admin_language('common_no')}}

                                                </span>
                                            @else
                                                <span style="color: #0FAA0F">
                                                   {{admin_language('common_yes')}}

                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($dataS->type==0 || $dataS->type==1)
                                                <span style="color: #0FAA0F">
                                                    {{admin_language('menu_BuiltIn')}}
                                                </span>
                                            @else
                                                <span style="color: #c0a16b">
                                                       {{admin_language('menu_TheChain')}}

                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$dataS->active}}
                                        </td>
                                        <td>
                                            <i class="{{$dataS->icon}}"></i>
                                        </td>
                                        {{--     <td>
                                                 @if($dataS->is_show==1)
                                                     {{admin_language('common_yes')}}
                                                 @else
                                                     {{admin_language('common_no')}}
                                                 @endif

                                             </td>--}}
                                        <td>
                                            <label class="switch switch-success switch-round">
                                                <input value="" class="checkbox_status"
                                                       onchange="changeStatus({{$dataS->id}},'setStatus',this)"
                                                       type="checkbox"
                                                       @if($dataS->is_show==1)
                                                       checked
                                                        @endif
                                                >
                                                <span class="switch-label" data-on="on" data-off="off"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="switch switch-success switch-round">
                                                <input value="" class="checkbox_index"
                                                       onchange="changeStatus({{$dataS->id}},'setIndex',this)"
                                                       type="checkbox"
                                                       @if($dataS->index==1)
                                                       checked
                                                        @endif
                                                >
                                                <span class="switch-label" data-on="on" data-off="off"></span>
                                            </label>
                                        </td>
                                        <td>
                                            {{$dataS->created_at}}
                                        </td>
                                        <td>

                                            @if($dataS->type!=0)

                                                <a href="{{url('admin/setting/homemenu/edit'.'/'.$dataS->id)}}"
                                                   class="btn btn-success btn-xs white"><i
                                                            class="fa fa-edit white"></i>
                                                    {{admin_language('common_edit')}}
                                                </a>

                                                <a href="javascript:;" data-id="{{$dataS->id}}"
                                                   class="btn btn-danger btn-xs white delete">
                                                    <i class="fa fa-times white"></i>
                                                    {{admin_language('common_delete')}}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /panel content -->


                </div>
            </div>

            @include('admin/common/footer')
        </section>

    </div>
</div>

@include('admin/common/js')


</body>
<script>
    $(function () {
        $(".delete").click(function () {
            var dataId = $(this).attr('data-id');

            layer.confirm('{{admin_language('common_areYouDelete')}}', {
                title: ['{{admin_language('common_tips')}}'],     //提示
                btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
            }, function () {
                window.location = "{{url('admin/setting/homemenu/delete/')}}" + "/" + dataId;
            });
        })
    });

    function changeStatus(id, action, e) {
        var _this = e;
        var setSt = layer.load();
        $.get("{{url('admin/setting/homemenu/status')}}", {id: id, action: action}, function (data) {
            layer.close(setSt);
            data = $.parseJSON(data);
            if (action == 'setIndex') {
                if (data.status == 1) {
                    $(".checkbox_index").prop('checked', false);
                    $(_this).prop('checked', true)
                } else {
                    $(_this).prop('checked', false)
                }
            }
        });
    }
</script>
</html>