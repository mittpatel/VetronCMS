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
                                <a href="{{url('admin/administrators/group/add')}}" style="margin-top: 5px;"
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
                                    <th>{{admin_language('auth_creator')}}</th>


                                    <th>{{admin_language('common_note')}}</th>
                                    <th>{{admin_language('common_createTime')}}</th>
                                    <th>{{admin_language('common_status')}}</th>
                                    <th style="width: 300px;">{{admin_language('common_action')}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($groupList as $groupListVal)
                                    @foreach($groupListVal as $groupListValVal)
                                        <tr class="odd gradeX">
                                            <td style="">
                                                <a href="{{url('admin/administrators/user')}}?g={{$groupListValVal->id}}">
                                                    @if($groupListValVal->level==0)
                                                        {{admin_language($groupListValVal->language_key)}}
                                                    @else
                                                        {{str_repeat("─ ",$groupListValVal->level)}}
                                                        {{admin_language($groupListValVal->language_key)}}
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                @foreach($userList as $user)
                                                    @if($user->id==$groupListValVal->u_id)
                                                        @if($groupListValVal->u_id==UID)
                                                            <span style="">{{$user->name}}</span>
                                                            ({{admin_language('auth_Own')}})
                                                        @else
                                                            {{$user->name}}

                                                        @endif
                                                    @endif
                                                @endforeach

                                            </td>

                                            <td title="{{$groupListValVal->note}}">
                                                {{$groupListValVal->note}}
                                            </td>

                                            <td>
                                                {{$groupListValVal->created_at}}
                                            </td>
                                            <td>
                                                <label class="switch switch-success switch-round">
                                                    <input value="" class="checkbox_status"
                                                           onchange="status('{{$groupListValVal->id}}',this)"
                                                           type="checkbox"
                                                           @if($groupListValVal->status==1) checked @endif
                                                    >
                                                    <span class="switch-label" data-on="on" data-off="off"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{url('admin/administrators/group/auth'.'/'.$groupListValVal->id)}}"
                                                   class="btn btn-success btn-xs white"><i
                                                            class="fa fa-cubes white"></i>
                                                    {{admin_language('common_auth')}}
                                                </a>
                                                <a href="{{url('admin/administrators/group/edit'.'/'.$groupListValVal->id)}}"
                                                   class="btn btn-success btn-xs white"><i
                                                            class="fa fa-edit white"></i>
                                                    {{admin_language('common_edit')}}
                                                </a>
                                                <a onclick="deleteGroup({{$groupListValVal->id}})"
                                                   href="javascript:;"
                                                   class="btn btn-danger btn-xs white delete">
                                                    <i class="fa fa-times white"></i>
                                                    {{admin_language('common_delete')}}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /panel content -->


                </div>
            </div>


        </section>

    </div>
</div>

@include('admin/common/js')
<script>
    function deleteGroup(id) {
        layer.confirm('{{admin_language('common_areYouDelete')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = "{{url('admin/administrators/group/delete')}}" + "/" + id
        });
    }
    function status(id, e) {
        var groupStatus = layer.load();
        $.ajax({
            type: 'GET',
            url: "{{url('admin/administrators/group/status')}}",
            data: {id: id},
            success: function (data) {

                data = $.parseJSON(data);
                if (data.status == 1) {
                    layer.close(groupStatus);
                }
            }
        });

    }
</script>
</body>
</html>