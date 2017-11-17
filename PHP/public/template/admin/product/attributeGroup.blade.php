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
								<strong>{{admin_language('Group')}}</strong> <!-- panel title -->
							</span>

                        <!-- right options -->
                        <ul class="options pull-right list-inline">

                            <li>
                                <a href="{{url('admin/product/attribute/group/add')}}" style="margin-top: 5px;"
                                   class="btn btn-primary btn-xs white fa fa-plus" data-toggle="tooltip"
                                   title="" data-placement="bottom" data-original-title="">
                                    {{admin_language('GroupAdd')}}
                                </a>
                                <a href="{{url('admin/product/attribute/type/add')}}" class="btn btn-primary btn-xs white fa fa-plus" >
                                    {{admin_language('auth_productAttributeAdd')}}
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
                                <th>{{admin_language('product_inputType')}}</th>
                                <th>{{admin_language('common_default')}}</th>
                                <th style="width: 220px;">{{admin_language('common_action')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($productAttributeGroup as $productAttributeGroupVal)


                                <tr class="odd gradeX">
                                    <td colspan="3">
                                        <b>{{admin_language($productAttributeGroupVal->language_key)}}</b>
                                    </td>
                                    <td>

                                        <a href="{{url('admin/product/attribute/group/edit'.'/'.$productAttributeGroupVal->id)}}"
                                           class="btn btn-success btn-xs white"><i
                                                    class="fa fa-edit white"></i>
                                            {{admin_language('common_edit')}}
                                        </a>
                                        <a onclick="deleteA({{$productAttributeGroupVal->id}},1)"
                                           href="javascript:;"
                                           class="btn btn-danger btn-xs white delete">
                                            <i class="fa fa-times white"></i>
                                            {{admin_language('common_delete')}}
                                        </a>
                                    </td>
                                </tr>
                                @foreach($productAttributeType as $productAttributeTypeVal)
                                    @if($productAttributeTypeVal->group_id==$productAttributeGroupVal->id)
                                        <tr class="odd gradeX">
                                            <td style="padding-left: 15px;">
                                                {{home_language($productAttributeTypeVal->language_key)}}
                                            </td>
                                            <td>
                                                @if($productAttributeTypeVal->input_type==1)
                                                    {{admin_language('product_textBox')}}
                                                @elseif($productAttributeTypeVal->input_type==2)
                                                    {{admin_language('product_radio')}}
                                                @elseif($productAttributeTypeVal->input_type==3)
                                                    {{admin_language('product_checkBox')}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$productAttributeTypeVal->default_val}}
                                            </td>
                                            <td>
                                                <a href="{{url('admin/product/attribute/type/edit'.'/'.$productAttributeTypeVal->id)}}"
                                                   class="btn btn-success btn-xs white">
                                                    <i class="fa fa-edit white"></i>
                                                    {{admin_language('common_edit')}}
                                                </a>
                                                <a onclick="deleteA({{$productAttributeTypeVal->id}},2)"
                                                   href="javascript:;"
                                                   class="btn btn-danger btn-xs white delete">
                                                    <i class="fa fa-times white"></i>
                                                    {{admin_language('common_delete')}}
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
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

    function deleteA(id, type) {
        layer.confirm('{{admin_language('common_areYouDelete')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = "{{url('admin/product/attribute/group/delete')}}" + "/" + id + "?type=" + type
        });
    }

</script>
</body>
</html>