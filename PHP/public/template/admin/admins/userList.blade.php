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
                                <a href="{{url('admin/administrators/user/add')}}" style="margin-top: 5px;"
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
                        <div class="table-responsive" style="overflow-x: hidden">
                            <table class="table table-hover" id="datatable_sample">
                                <thead>
                                <tr>
                                    <th style="width: 60px;"></th>
                                    <th>{{admin_language('common_userName')}}</th>
                                    <th>{{admin_language('common_phoneNumber')}}</th>
                                    <th>{{admin_language('common_email')}}</th>
                                    <th>{{admin_language('common_company')}}</th>
                                    <th>{{admin_language('common_address')}}</th>
                                    <th>{{admin_language('admin_RegistrationTime')}}</th>
                                    <th>{{admin_language('admin_Group')}}</th>
                                    <th>{{admin_language('common_status')}}</th>
                                    <th style="width: 200px;">{{admin_language('common_action')}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($userList as $userListVal)

                                    @if($userListVal->id!=session('vetronCmsLogin')->id || UID==1)
                                        <tr class="odd gradeX">
                                            <td>
                                                <img style="height: 34px;" src="{{asset($userListVal->header)}}" alt="">
                                            </td>
                                            <td>
                                                {{$userListVal->name}}
                                            </td>
                                            <td>
                                                {{$userListVal->phone}}
                                            </td>
                                            <td>
                                                {{$userListVal->email}}
                                            </td>
                                            <td>
                                                {{$userListVal->company}}
                                            </td>
                                            <td>
                                                {{$userListVal->address}}
                                            </td>
                                            <td>
                                                {{date('Y-m-d',$userListVal->create_time)}}
                                            </td>
                                            <td>
                                                @foreach($groupList as $groupListVal)
                                                    @if($groupListVal->id==$userListVal->g_id)
                                                        {{admin_language($groupListVal->language_key)}}
                                                        @break
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($userListVal->id!=1)
                                                <label class="switch switch-success switch-round">
                                                    <input value="" class="checkbox_status"
                                                           onchange="status('{{$userListVal->id}}',this)"
                                                           type="checkbox"
                                                           @if($userListVal->status==1)
                                                           checked
                                                            @endif
                                                    >
                                                    <span class="switch-label" data-on="on" data-off="off"></span>
                                                </label>
                                                @endif
                                            </td>
                                            <td>
                                                @if($userListVal->id!=1)
                                                    <a href="{{url('admin/administrators/user/edit'.'/'.$userListVal->id)}}"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-edit white"></i>
                                                        {{admin_language('common_edit')}}
                                                    </a>

                                                    <a onclick="deleteUser({{$userListVal->id}})"
                                                       href="javascript:;"
                                                       class="btn btn-danger btn-xs white delete">
                                                        <i class="fa fa-times white"></i>
                                                        {{admin_language('common_delete')}}
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
                    <!-- /panel content -->


                </div>
            </div>


        </section>

    </div>
</div>

@include('admin/common/js')
<script type="text/javascript">
    loadScript(plugin_path + "datatables/js/jquery.dataTables.min.js", function () {
        loadScript(plugin_path + "datatables/dataTables.bootstrap.js", function () {

            if (jQuery().dataTable) {

                var table = jQuery('#datatable_sample');
                table.dataTable({
                    "columns": [{
                        "orderable": false
                    }, {
                        "orderable": false
                    }, {
                        "orderable": false
                    }, {
                        "orderable": false
                    }, {
                        "orderable": false
                    }, {
                        "orderable": false
                    }, {
                        "orderable": false
                    }, {
                        "orderable": false
                    }, {
                        "orderable": false
                    }, {
                        "orderable": false
                    }],
                    "lengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 15,
                    "pagingType": "bootstrap_full_number",
                    "language": {
                        "lengthMenu": "  _MENU_ records",
                        "paginate": {
                            "previous": "Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First"
                        }
                    },
                    "columnDefs": [{  // set default column settings
                        'orderable': false,
                        'targets': [0]
                    }, {
                        "searchable": false,
                        "targets": [0]
                    }],
                    "order": [
                        [1, "asc"]
                    ] // set first column as a default sort by asc
                });

                var tableWrapper = jQuery('#datatable_sample_wrapper');

                table.find('.group-checkable').change(function () {
                    var set = jQuery(this).attr("data-set");
                    var checked = jQuery(this).is(":checked");
                    jQuery(set).each(function () {
                        if (checked) {
                            jQuery(this).attr("checked", true);
                            jQuery(this).parents('tr').addClass("active");
                        } else {
                            jQuery(this).attr("checked", false);
                            jQuery(this).parents('tr').removeClass("active");
                        }
                    });
                    jQuery.uniform.update(set);
                });

                table.on('change', 'tbody tr .checkboxes', function () {
                    jQuery(this).parents('tr').toggleClass("active");
                });

                tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown

            }
            $(".dataTables_length label").append('' +
                '<select onchange="selectGroup(this)" style="width:120px;" name="" aria-controls="" class="form-control input-xsmall input-inline">' +
                '<option value=""> -- Select -- </option>' +
                    @foreach($subordinateGroupList as $subordinateGroupListVal)
                            @foreach($subordinateGroupListVal as $subordinateGroupListValV)
                        '<option @if($request->g==$subordinateGroupListValV->id) selected @endif value="{{$subordinateGroupListValV->id}}">{{str_repeat("─ ",$subordinateGroupListValV->level)}}{{admin_language($subordinateGroupListValV->language_key)}}</option>' +
                    @endforeach
                            @endforeach +
                        '');
        });
    });
</script>
<script>
    function deleteUser(id) {
        layer.confirm('{{admin_language('common_areYouDelete')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = "{{url('admin/administrators/user/delete')}}" + "/" + id
        });
    }

    function status(id, e) {
        var setSt = layer.load();
        $.get("{{url('admin/administrators/user/status')}}", {id: id}, function (data) {
            data = $.parseJSON(data);
            if (data.status == 1) {
                layer.close(setSt);
            }
        });
    }

    function selectGroup(e) {
        //admin/administrators/user?g=29

        window.location = "{{url('admin/administrators/user')}}?g=" + $(e).val();
    }
</script>
</body>
</html>