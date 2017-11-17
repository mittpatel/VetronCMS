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
                                <a href="{{url('admin/setting/menu/add')}}" style="margin-top: 5px;"
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
                                        <th>{{admin_language('common_display')}}</th>

                                        <th>{{admin_language('common_active')}}</th>
                                        <th>{{admin_language('common_auth')}}</th>
                                        <th>{{admin_language('common_icon')}}</th>
                                        <th>{{admin_language('common_order')}}</th>
                                        <th>{{admin_language('common_createTime')}}</th>
                                        <th style="width: 200px;">{{admin_language('common_action')}}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($data as $datas)
                                    @if($datas->p_id==0)
                                        <tr class="odd gradeX">

                                            <td style="font-size: 110%;">
                                                <b>{{admin_language($datas->language_key)}}</b>
                                            </td>

                                            <td>

                                            </td>

                                            <td>
                                                @if($datas->is_show==1)
                                                    <span style="color: green;">{{admin_language('common_yes')}}</span>
                                                @else
                                                    <span style="color: #DB5D5A;">{{admin_language('common_no')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{$datas->active}}
                                            </td>
                                            <td>
                                                {{$datas->auth}}
                                            </td>
                                            <td>
                                                <i class="{{$datas->icon}}"></i>
                                            </td>
                                            <td>
                                                {{$datas->order}}
                                            </td>
                                            <td>
                                                {{date('Y-m-d',$datas->create_time)}}
                                            </td>

                                            <td>
                                                <a href="{{url('admin/setting/menu/edit'.'/'.$datas->id)}}"
                                                   class="btn btn-success btn-xs white"><i
                                                            class="fa fa-edit white"></i>
                                                    {{admin_language('common_edit')}}
                                                </a>

                                                <a href="javascript:;" data-id="{{$datas->id}}"
                                                   class="btn btn-danger btn-xs white delete">
                                                    <i class="fa fa-times white"></i>
                                                    {{admin_language('common_delete')}}
                                                </a>

                                            </td>
                                        </tr>
                                        @foreach($data as $data_s)
                                            @if($data_s->p_id==$datas->id)
                                                <tr class="odd gradeX">

                                                    <td style="padding-left: 20px;">
                                                        {{admin_language($data_s->language_key)}}
                                                    </td>

                                                    <td>
                                                        {{$data_s->route}}
                                                    </td>


                                                    <td>
                                                        @if($data_s->is_show==1)
                                                            <span style="color: green">{{admin_language('common_yes')}}</span>
                                                        @else
                                                            <span style="color: #DB5D5A;">{{admin_language('common_no')}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{$data_s->active}}
                                                    </td>
                                                    <td>
                                                        {{$data_s->auth}}
                                                    </td>
                                                    <td>

                                                    </td>
                                                    <td>
		                                                {{$datas->order}}
		                                            </td>
                                                    <td>
                                                        {{date('Y-m-d',$data_s->create_time)}}
                                                    </td>

                                                    <td>
                                                        <a href="{{url('admin/setting/menu/edit'.'/'.$data_s->id)}}"
                                                           class="btn btn-success btn-xs white"><i
                                                                    class="fa fa-edit white"></i>
                                                            {{admin_language('common_edit')}}
                                                        </a>
                                                        <a href="javascript:;" data-id="{{$data_s->id}}"
                                                           class="btn btn-danger btn-xs white delete">
                                                            <i class="fa fa-times white"></i>
                                                            {{admin_language('common_delete')}}
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endif

                                        @endforeach
                                    @endif
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
                window.location = "{{url('admin/setting/menu/delete/')}}" + "/" + dataId;
            });
        })
    });
</script>
</html>