<!doctype html>
<html lang="en-US">
@include('admin/common/head')
<style>

</style>
<body>

<div class="container">
    <div id="wrapper" class="clearfix">

        @include('admin/common/nav')

        @include('admin/common/header')

        <section id="middle">

            @include('admin/common/crumbs')
            {{--内容区--}}
            <div id="content" class="dashboard padding-20">

                <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong>{{admin_language('common_add')}}</strong>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <form method="post" id="addArticle" enctype="multipart/form-data">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('common_name')}}</label>
                                                        <input type="text" name="name" value="{{old('name')}}"
                                                               class="form-control required">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('common_price')}}</label>
                                                        <input type="text" name="price" value="{{old('price')}}"
                                                               class="form-control required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>
                                                            {{admin_language('product_description')}}
                                                        </label>
                                                        <textarea class="form-control" rows="5"
                                                                  name="describe">{{old('describe')}}</textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('common_content')}}
                                                            <button onclick="addOnLine('/uploads')" type="button"
                                                                    class="btn btn-primary btn-xs">
                                                                {{admin_language('common_onlineResources')}}
                                                            </button>
                                                        </label>

                                                        <textarea name="content"
                                                                  id="editor">{{old('content')}}</textarea>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('seo_keywords')}}</label>
                                                        <input type="text" name="seo[keyword]"
                                                               value="{{old('seo')['keyword']}}"
                                                               class="form-control required">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('seo_description')}}</label>
                                                        <input type="text" name="seo[describe]"
                                                               value="{{old('seo')['describe']}}"
                                                               class="form-control required">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12 ajaxGetCategoryBox">
                                                        <label>{{admin_language('product_category')}}</label>

                                                        <ul class="treeCategor"
                                                            style="list-style: none;margin: 0;padding: 0">
                                                            @foreach($productCategory as $productCategoryVal)
                                                                @if($productCategoryVal->isTop==1)
                                                                    <li onclick="treeShowHide(this);"
                                                                        id="a{{$productCategoryVal->id}}"
                                                                        class="a{{$productCategoryVal->pid}}"
                                                                        levels="{{$productCategoryVal->level}}"
                                                                        style="margin-left: {{$productCategoryVal->level*22}}px;@if($productCategoryVal->pid!=0) display: none; @endif">
                                                                        <label class="checkbox">
                                                                            <i class="fa fa-plus-square-o"
                                                                               style="border-style: none;font-size: 20px;padding-top: 1px;"></i>
                                                                            {{home_language($productCategoryVal->language_key)}}

                                                                        </label>
                                                                    </li>
                                                                @else
                                                                    <li id="a{{$productCategoryVal->id}}"
                                                                        class="a{{$productCategoryVal->pid}}"
                                                                        levels="{{$productCategoryVal->level}}"
                                                                        style="margin-left: {{$productCategoryVal->level*22}}px;@if($productCategoryVal->pid!=0) display: none; @endif">
                                                                        <label class="checkbox">
                                                                            {{--      <input onchange="$(':input[name=category]').prop('checked',false);$(this).prop('checked',true)" value="{{$productCategoryVal->id}}" type="checkbox" name="category"
                                                                                         id="drop-remove">--}}

                                                                            <input type="checkbox"

                                                                                   name="category[]"
                                                                                   value="{{$productCategoryVal->id}}">
                                                                            <i></i>
                                                                            {{home_language($productCategoryVal->language_key)}}
                                                                        </label>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                            <li levels="0" style="display: none;"></li>
                                                        </ul>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin-bottom: 0;">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>
                                                            {{admin_language('common_attribute')}}
                                                        </label>
                                                        <a href="javascript:;" onclick="addAttribute()"
                                                           class="btn btn-primary btn-xs white">
                                                            {{admin_language('common_Choice')}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="attribute-box">

                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('common_cover')}}</label>
                                                        <div class="row text-center">
                                                            <img src="{{app_public()}}template/admin/assets/other/default.png"
                                                                 style="width: 90%;">
                                                        </div>
                                                        <div style="position: relative;"
                                                             class="fancy-file-upload fancy-file-primary">
                                                            <div style="margin-right: 20px;"
                                                                 class="fancy-file-upload fancy-file-primary">
                                                                <i class="fa fa-upload"></i>
                                                                <input type="file" style=""
                                                                       class="form-control" name="cover[]"
                                                                       onchange="jQuery(this).next('input').val(this.value);">
                                                                <input type="text" class="form-control"
                                                                       placeholder="no file"
                                                                       readonly="">
                                                                <span class="button"
                                                                      style="height: 32px;">{{admin_language('setting_selectImage')}}</span>
                                                            </div>

                                                            <span onclick="$('.fileBox').append($('.plus-file').eq(0).clone().show())"
                                                                  style="position: absolute;top: -5px;right: 0px;font-size: 32px;cursor: pointer;">+</span>
                                                        </div>
                                                        <div class="fileBox">

                                                            <div style="display: none;position: relative;"
                                                                 class="fancy-file-upload fancy-file-primary plus-file">
                                                                <div style="position: relative;margin-right: 20px;"
                                                                     class="fancy-file-upload fancy-file-primary plus-file">
                                                                    <i class="fa fa-upload"></i>
                                                                    <input type="file" style="" class="form-control"
                                                                           name="cover[]"
                                                                           onchange="jQuery(this).next('input').val(this.value);">
                                                                    <input type="text" class="form-control"
                                                                           placeholder="no file"
                                                                           readonly="">
                                                                    <span class="button"
                                                                          style="height: 32px;">{{admin_language('setting_selectImage')}}</span>
                                                                </div>
                                                                <span onclick="$(this).parents('.plus-file').remove()"
                                                                      style="position: absolute;top: -5px;right: 0px;font-size: 30px;cursor: pointer;color: red;">x</span>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('common_pictureCollection')}}</label>
                                                        <div class="gallery-box" style="width: 100%;">

                                                        </div>
                                                        <button type="button"
                                                                onclick="addOnLine('isGallery')"
                                                                class="btn btn-primary btn-sm btn-block">
                                                            {{admin_language('common_onlineResources')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <button type="submit" onclick="" class="btn btn-primary">
                                                            {{admin_language('common_submit')}}
                                                        </button>
                                                        <button style="margin-left: 10px;" type="button"
                                                                onclick="window.history.go(-1);"
                                                                class="btn btn-success">
                                                            {{admin_language('common_Return')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{csrf_field()}}
                                    </form>
                                </div>
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
{{--<div style="position: fixed;left: 20%;    top: 41px;
    width: 737px;
    height: 477px;background-color: #F1F2F7;z-index: 9999;"
>


</div>--}}
@include('admin/common/js')
<script>
    var isGalleryT = false;

    function addOnLine(isGallery) {
        if (isGallery == 'isGallery') {
            isGalleryT = true;
        } else {
            isGalleryT = false;
        }
        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['935px', '550px'], //宽高
            content: '<div class="on-line-l"></div>'
        });
        onLineUpload.init('.on-line-l', '/');
    }

    $("body").on('click', '.fileAll', function () {
        console.log(isGalleryT)
        if (isGalleryT) {
            setProductGallery(this)
        } else {
            appendEditor(this);
        }
    })

    /*
     * 追加至富文本编辑器
     * */
    function appendEditor(e) {

        if ($(e).attr('type') == 'img') {
            editor_setcontent(editor_getcontent() + '<img src="' + $(e).attr('asset') + '" />')
        } else if ($(e).attr('type') == 'other') {
            editor_setcontent(editor_getcontent() + '<a href="' + $(e).attr('asset') + '"> attachment </a>')
        }
    }

    /*
     * 获取和重写富文本编辑器内容
     * */
    function editor_getcontent() {

        return ue.getContent();
    }

    function editor_setcontent(text) {
        ue.setContent(text);
    }


    /*
     * 产品选择图集
     * */
    function setProductGallery(e) {
        if ($(".gallery-box").size() > 0) {
            var urlPath = $(e).attr('asset');
            var uploadPath = $(e).attr('relative');

            $(".gallery-box").append(
                '<div style="width:50%;position: relative;display: inline-block;float: left;">' +
                '<img style="width: 98%;margin-bottom: 10px;margin-right: 2%;" src="' + urlPath + '" />' +
                '<span onclick="removeGalleryOne(this)" style="position: absolute;top: -8px;right: 4px;color: red;font-size: 24px;cursor: pointer;">X</span>' +
                '<input type="hidden" name="gallery[]" value="' + uploadPath + '" />' +
                '</div>'
            );
        }
    }

    /*
     * 产品添加图集后移除
     * */
    function removeGalleryOne(e) {
        $(e).parent('div').remove();
    }

</script>
<script type="text/javascript">

    @if(count($errors))
    layer.msg('{{$errors->first()}}');

    @endif

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

    //添加属性
    function addAttribute() {
        addAttributeOpen = layer.open({
            type: 1,
            title: "{{admin_language('SelectionAttribute')}}", //不显示标题
            shadeClose: true, //开启遮罩关闭
            skin: 'layui-layer-rim', //加上边框
            area: ['720px', '460px'], //宽高
            content: '<div style="padding: 10px;overflow: auto;height: 100%;width: 100%;" class="">\n' +
            '        <form class="selectAttribute">@foreach($attributeGroup as $g)\n' +
            '            <div style="font-size: 18px;">{{admin_language($g->language_key)}}<span style="font-size:14px;margin-left:10px; cursor: pointer;" onclick="selectCh(this)">{{admin_language('common_Select')}}</span></div>\n' +
            '            <div style="margin-bottom:15px;">\n' +
            '                @foreach($attributeType as $t)\n' +
            '                    @if($t->group_id==$g->id)\n' +
            '                        <label class="checkbox">\n' +
            '                            <input type="checkbox" name="name[]" value="{{$t->id}}"><i></i>\n' +
            '                            {{home_language($t->language_key)}}\n' +
            '                        </label>\n' +
            '                    @endif\n' +
            '                @endforeach\n' +
            '            </div>\n' +
            '        @endforeach\n' +
            '        <div>\n' +
            '            <button type="button" style="margin-top:10px;" onclick="" class="btn btn-primary getAttribute">\n' +
            '                {{admin_language('common_confirm')}}\n' +
            '            </button>\n' +
            '        </div>\n{{csrf_field()}}</form>' +
            '    </div>'
        });
    }
    //全选属性
    function selectCh(_this) {
        $(_this).parent().next().find('input').prop('checked',true)
    }

    $("body").on('click', '.getAttribute', function () {
//        $(this).parent(".selectAttribute").
        $.ajax({
            url: '{{url('admin/product/add/attribute/add')}}',
            type: 'post',
            data: $('.selectAttribute').serialize(),
            //datatype: 'json',
            success: function (data) {
                $(".attribute-box").html(data);
                layer.close(addAttributeOpen)
            },
            error: function () {
            }
        });

    })

</script>
</body>
</html>