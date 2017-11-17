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

                <div class="row">

                    <div class="col-md-12">

                        <!-- ------ -->
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong>{{admin_language('common_add')}}</strong>
                            </div>

                            <div class="panel-body">

                                <form method="post" id="categoryForm">
                                    <fieldset>
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_name')}}</label>
                                                    <input type="text" name="name" value=""
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('article_category')}} *</label>
                                                    <ul class="treeCategor"
                                                        style="list-style: none;margin: 0;padding: 0">
                                                        @foreach($categoryList as $articleCategoryListVal)
                                                            @if($articleCategoryListVal->isTop==1)
                                                                <li onclick="treeShowHide(this);"
                                                                    id="a{{$articleCategoryListVal->id}}"
                                                                    class="a{{$articleCategoryListVal->pid}}"
                                                                    levels="{{$articleCategoryListVal->level}}"
                                                                    style="margin-left: {{$articleCategoryListVal->level*22}}px;@if($articleCategoryListVal->pid!=0) display: none; @endif">
                                                                    <label class="checkbox">
                                                                        <i class="fa fa-plus-square-o"
                                                                           style="border-style: none;font-size: 20px;padding-top: 1px;"></i>
                                                                        {{$articleCategoryListVal->language_key}}
                                                                    </label>
                                                                </li>
                                                            @else
                                                                <li id="a{{$articleCategoryListVal->id}}"
                                                                    class="a{{$articleCategoryListVal->pid}}"
                                                                    levels="{{$articleCategoryListVal->level}}"
                                                                    style="margin-left: {{$articleCategoryListVal->level*22}}px;@if($articleCategoryListVal->pid!=0) display: none; @endif">
                                                                    <label class="checkbox">
                                                                        {{--      <input onchange="$(':input[name=category]').prop('checked',false);$(this).prop('checked',true)" value="{{$productCategoryVal->id}}" type="checkbox" name="category"
                                                                                     id="drop-remove">--}}

                                                                        <input type="radio"
                                                                               @if($_GET['c']==$articleCategoryListVal->id)
                                                                               checked
                                                                               @endif
                                                                               name="category_id"
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


                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div style="display: flex;align-items: flex-start">
                                                        <label>
                                                            {{admin_language('common_cover')}}
                                                        </label>
                                                        <label style="margin-left: 12px;">
                                                            <img id="logoID" style="height: 50px;display: none;" src="">
                                                        </label>
                                                    </div>
                                                    <div class="fancy-file-upload fancy-file-primary">
                                                        <i class="fa fa-upload"></i>
                                                        <input type="file" class="form-control" name="cover[]"
                                                               id="logologo"
                                                               onchange="jQuery(this).next('input').val(this.value);ajaxUploadHeader(this);">
                                                        <input type="text" class="form-control" placeholder=""
                                                               readonly="">
                                                        <span class="button">选择文件</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>
                                                        {{admin_language('common_note')}}
                                                    </label>
                                                    <textarea class="form-control" rows="5" name="description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button onclick="submitCategory()" type="button"
                                                        class="btn btn-primary">
                                                    {{admin_language('common_submit')}}
                                                </button>

                                                <button style="margin-left: 10px;" type="button" onclick="window.history.go(-1);" class="btn btn-success">
                                                    {{admin_language('common_Return')}}
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <input type="hidden" name="cover" value="">


                                </form>

                            </div>

                        </div>
                        <!-- /----- -->

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
    function submitCategory() {
        var submitCategory = layer.load();

        $.ajax({
            type: 'post',
            url: window.location.href,
            data: $('#categoryForm').serialize(),
            success: function (data) {
                data = $.parseJSON(data);
                if (data.status == 1) {
                    layer.close(submitCategory);
                    layer.msg(data.msg);
                    setTimeout(function () {
                        window.location = data.url;
                    }, 1000);
                } else layer.msg(data.msg);
                layer.close(submitCategory);
            }
        });
    }
    function ajaxUploadHeader(e) {
        var ajaxHeader = layer.load();
        ajaxUpload({
            e: e,
            url: "{{url('admin/gallery/ajaxUpload')}}",
            token: "{{csrf_token()}}"
        }, function (data) {
            layer.close(ajaxHeader);
            if (data.status == 1) {
                $(":input[name=cover]").val(data.path);
                $("#logoID").prop('src', data.url).show();
            } else {
                layer.msg(data.msg);
            }
        });
    };
</script>
</body>
</html>