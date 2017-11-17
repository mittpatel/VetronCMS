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
                                <a href="{{url('admin/product/add')}}" style="margin-top: 5px;"
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
                            <table class="table table-striped table-hover table-bordered dataTable no-footer"
                                   id="datatable_sample">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>{{admin_language('common_name')}}</th>
                                    <th>{{admin_language('product_category')}}</th>
                                    <th>{{admin_language('common_status')}}</th>
                                    <th style="">{{admin_language('common_createTime')}}</th>
                                    <th style="width: 180px;">{{admin_language('common_action')}}</th>
                                </tr>
                                </thead>

                                <tbody class="line-height-40">
                                @foreach($productList as $productListVal)
                                    <tr class="odd gradeX">
                                        <td style="width: 100px;overflow: hidden;">
                                            <img style="height: 39px;"
                                                 src="{{asset(explode(',',$productListVal->cover)[0])}}" alt="">
                                        </td>
                                        <td>
                                            {{$productListVal->name}}
                                        </td>
                                        <td>
                                            {{getProductCategoryName($productListVal->category)}}
                                        </td>
                                        <td>
                                            @if($productListVal->status==1)
                                                <span class="listEnableColor">{{admin_language('common_enabled')}}</span>
                                            @else
                                                <span class="listDisableColor">{{admin_language('common_disabled')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{$productListVal->created_at}}
                                        </td>

                                        <td>
                                            <a href="{{url('admin/product/edit'.'/'.$productListVal->id)}}"
                                               class="btn btn-success btn-xs white"><i
                                                        class="fa fa-edit white"></i>
                                                {{admin_language('common_edit')}}
                                            </a>
                                            <a onclick="deleteCategory({{$productListVal->id}})" href="javascript:;"
                                               class="btn btn-danger btn-xs white delete">
                                                <i class="fa fa-times white"></i>
                                                {{admin_language('common_delete')}}
                                            </a>
                                        </td>
                                    </tr>
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
<!-- PAGE LEVEL SCRIPTS -->
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

        });
    });
</script>
<script>
    function deleteCategory(id) {

        layer.confirm('{{admin_language('common_areYouDelete')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = "{{url('admin/product/delete')}}" + "/" + id
        });

    }
</script>
</body>
</html>