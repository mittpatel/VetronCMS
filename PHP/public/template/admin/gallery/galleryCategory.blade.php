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
                                <a href="{{url('admin/gallery/category/add')}}" style="margin-top: 5px;"
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

                        <div class="row">

                            <!-- LEFT -->
                            <div class="col-md-12">

                                <div class="row">
                                    @if($pid!=0)
                                        <div class="col-md-2">
                                            <div style="position: relative" class="pricing-table see_gallery">
                                                <a href="{{url('admin/gallery/category')}}?p={{$ppId}}">
                                                    <div>
                                                        <img style="width: 100%;"
                                                             src="{{asset('uploads/gallery/back.png')}}">
                                                    </div>
                                                </a>

                                            </div>
                                            <div class="plan-title none_back">
                                                {{home_language($categoryListVal->language_key)}}
                                            </div>
                                        </div>
                                    @endif
                                    @foreach($categoryList as $categoryListVal)

                                        <div class="col-md-2">
                                            <div style="position: relative" class="pricing-table see_gallery">
                                                <a href="@if($categoryListVal->isTop==1){{url('admin/gallery/category')}}?p={{$categoryListVal->id}}@else {{url('admin/gallery')}}?c={{$categoryListVal->id}} @endif">
                                                    <div>
                                                        <img style="width: 100%;"
                                                             src="{{asset($categoryListVal->cover)}}">
                                                    </div>
                                                </a>
                                                <div class="edit-edit" style="display: none">
                                                    <div class="hide_action plan-title"
                                                         style="width:100%;position: absolute;bottom: 0;display: flex;justify-content: space-around;">
                                                <span class=""><a style="color: #000;cursor: pointer;"
                                                                  href="{{url('admin/gallery/category/edit')}}/{{$categoryListVal->id}}"><i
                                                                id="26" class="fa fa-pencil type_edit"></i></a></span>
                                                        <span class=""><i id="26" style="cursor: pointer;"
                                                                          class="fa fa-trash"
                                                                          onclick="deleteCategory({{$categoryListVal->id}})"></i></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="plan-title none_back">
                                                {{home_language($categoryListVal->language_key)}}

                                            </div>
                                        </div>
                                    @endforeach


                                </div>


                            </div>


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
<script>
    function deleteCategory(id) {
        layer.confirm('{{admin_language('common_areYouDelete')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = "{{url('admin/gallery/category/delete')}}" + "/" + id
        });
    }
    $(".see_gallery").mouseenter(function () {
        $(this).find(".edit-edit").show();
    }).mouseleave(function () {
        $(".edit-edit").hide();
    });
</script>
</body>
</html>