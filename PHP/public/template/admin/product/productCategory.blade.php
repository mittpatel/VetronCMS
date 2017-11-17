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

            <div id="content" class="dashboard padding-20">

                <div id="panel-1" class="panel panel-default">
                    <div class="panel-heading">
							<span class="title elipsis">
								<strong>{{admin_language('common_lists')}}</strong> <!-- panel title -->
							</span>

                        <!-- right options -->
                        <ul class="options pull-right list-inline">

                            <li>
                                <a href="{{url('admin/product/category/add')}}" style="margin-top: 5px;"
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

                        <table class="table" id="datatable_sample">
                            <thead>
                                <tr>
                                    <th>{{admin_language('common_name')}}</th>
                                    <th>{{admin_language('common_status')}}</th>
                                    <th>{{admin_language('common_note')}}</th>
                                    <th style="width: 200px;">{{admin_language('common_createTime')}}</th>
                                    <th style="width: 220px;">{{admin_language('common_action')}}</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($productCategory as $categoryListVal)
                                <tr class="odd gradeX">
                                    <td style="">
                                        @if($categoryListVal->level==0)
                                            <b style="font-size: 110%;">{{home_language($categoryListVal->language_key)}}</b>
                                        @else
                                            {{str_repeat("─ ",$categoryListVal->level)}}
                                            {{home_language($categoryListVal->language_key)}}
                                        @endif
                                    </td>
                                    <td>

                                        @if($categoryListVal->status==1)
                                            <span class="listEnableColor">{{admin_language('common_enabled')}}</span>
                                        @else
                                            <span class="listDisableColor">{{admin_language('common_disabled')}}</span>
                                        @endif
                                    </td>

                                    <td title="{{$categoryListVal->note}}">
                                        {{$categoryListVal->note}}
                                    </td>
                                    <td>
                                        {{$categoryListVal->created_at}}
                                    </td>
                                    <td>

                                        <a href="{{url('admin/product/category/edit'.'/'.$categoryListVal->id)}}"
                                           class="btn btn-success btn-xs white"><i
                                                    class="fa fa-edit white"></i>
                                            {{admin_language('common_edit')}}
                                        </a>
                                        <a onclick="deleteCategory({{$categoryListVal->id}})" href="javascript:;"
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
                    <!-- /panel content -->


                </div>
            </div>

            @include('admin/common/footer')
        </section>

    </div>
</div>

@include('admin/common/js')
<script>
    function deleteCategory(id) {
        layer.confirm('{{admin_language('common_areYouDelete')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = "{{url('admin/product/category/delete')}}" + "/" + id
        });
    }
</script>
</body>
</html>