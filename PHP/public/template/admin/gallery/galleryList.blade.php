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
                                <a onclick="galleryAdd()"
                                   style="margin-top: 5px;"
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

                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12 col-sm-12">
                                    <label>{{admin_language('article_category')}}</label>
                                    <ul class="treeCategor"
                                        style="list-style: none;margin: 0;padding: 0">
                                        @foreach($categoryList as $articleCategoryListVal)
                                            @if($articleCategoryListVal->isTop==1)
                                                <li onclick="treeShowHide(this);"
                                                    id="a{{$articleCategoryListVal->id}}"
                                                    class="a{{$articleCategoryListVal->pid}}"
                                                    levels="{{$articleCategoryListVal->level}}"
                                                    style="margin-left: {{$articleCategoryListVal->level*22}}px;">
                                                    <label class="checkbox">
                                                        <i class="fa fa-minus-square-o"
                                                           style="border-style: none;font-size: 20px;padding-top: 1px;"></i>
                                                        {{$articleCategoryListVal->language_key}}
                                                    </label>
                                                </li>
                                            @else
                                                <li id="a{{$articleCategoryListVal->id}}"
                                                    class="a{{$articleCategoryListVal->pid}}"
                                                    levels="{{$articleCategoryListVal->level}}"
                                                    style="margin-left: {{$articleCategoryListVal->level*22}}px;">
                                                    <label class="checkbox">
                                                        {{--      <input onchange="$(':input[name=category]').prop('checked',false);$(this).prop('checked',true)" value="{{$productCategoryVal->id}}" type="checkbox" name="category"
                                                                     id="drop-remove">--}}

                                                        <input type="radio"
                                                               onchange="getGallery({{$articleCategoryListVal->id}})"
                                                               @if($_GET['c']==$articleCategoryListVal->id)
                                                               checked
                                                               @endif
                                                               name="category"
                                                               value="{{$articleCategoryListVal->id}}">
                                                        <i></i>
                                                        {{$articleCategoryListVal->language_key}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach

                                        <li levels="0" style="display: none;"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="galleryBox">
                            @foreach($galleryList as $galleryListVal)

                                <div class="col-md-2">
                                    <div style="position: relative" class="pricing-table see_gallery">
                                        <div>
                                            <img style="width: 100%;"
                                                 src="{{asset($galleryListVal->cover)}}">
                                        </div>
                                        <div class="edit-edit" style="display: none">
                                            <div class="hide_action plan-title"
                                                 style="width:100%;position: absolute;bottom: 0;display: flex;justify-content: space-around;">
                                                <span class=""><i style="cursor: pointer;"
                                                                  class="fa fa-trash"
                                                                  onclick="deleteGallery({{$galleryListVal->id}})"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="plan-title none_back">
                                        {{$galleryListVal->name}}
                                    </div>
                                </div>
                            @endforeach

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
    function treeShowHide(e) {
        var _this = $(e);

        _this.find('i').removeClass('fa fa-plus-square-o').addClass('fa fa-minus-square-o');
        $("." + _this.attr('id')).toggle();
//        获取当前的级别
        var indexClass = _this.attr('levels');
        var _thisIndex = _this.index();
        var hideArr = [];
//      如果是折回操作
        if (_this.next().is(":hidden")) {

            _this.find('i').removeClass('fa fa-minus-square-o').addClass('fa fa-plus-square-o');

            for (var i = _thisIndex; i < $(".treeCategor").find('li').size(); i++) {
                var nextLi = $(".treeCategor").find('li').eq(i + 1).attr('levels');

                var nextIndex = $(".treeCategor").find('li').eq(i + 1).index();
                hideArr.push(nextIndex);
//                在当前级别和下一个比当前级别小的全部隐藏
                if (indexClass >= nextLi) {
                    for (var j = 0; j < hideArr.length; j++) {
                        $(".treeCategor").find('li').eq(hideArr[j - 1]).hide();
                    }
                    break;
                }
            }
        }
    }
    $(".see_gallery").mouseenter(function () {
        $(this).find(".edit-edit").show();
    }).mouseleave(function () {
        $(".edit-edit").hide();
    });
    var nowCategory = {{$_GET['c']}}
        function getGallery(id) {

        var getGalleryS = layer.load();
        $.ajax({
            type: 'GET',
            url: "{{url('admin/ajaxGetGallery')}}",
            data: {id: id},
            //datatype: 'json',
            success: function (data) {
                layer.close(getGalleryS);
                $("#galleryBox").html(data);
                nowCategory = id;

            }
        });
    }
    function deleteGallery(id) {

        layer.confirm('{{admin_language('common_areYouDelete')}}？', {
            title: ['{{admin_language('common_tips')}}'],     //提示
            btn: ['{{admin_language('common_confirm')}}', '{{admin_language('common_cancel')}}'], //按钮
        }, function () {
            window.location = "{{url('admin/gallery/delete')}}" + "/" + id
        });
    }
    var category={{$_GET['c']?$_GET['c']:"0"}}
    function galleryAdd() {
        window.location="{{url('admin/gallery/add')}}/"+category
    }
</script>
</body>
</html>