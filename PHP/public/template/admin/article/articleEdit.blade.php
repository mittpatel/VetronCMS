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

                <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong>{{admin_language('common_edit')}}</strong>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <form method="post" id="addArticle" enctype="multipart/form-data">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('common_title')}}</label>
                                                        <input type="text" name="title" value="{{$data->title}}"
                                                               class="form-control required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('common_content')}}
                                                            <button onclick="addOnLine()" type="button"
                                                                    class="btn btn-primary btn-xs">
                                                                {{admin_language('common_onlineResources')}}
                                                            </button>
                                                        </label>

                                                        <textarea name="content"
                                                                  id="editor">{!! $data->content !!}</textarea>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('seo_keywords')}}</label>
                                                        <input type="text" name="seo[keyword]"
                                                               value="{{json_decode($data->seo)->keyword}}"
                                                               class="form-control required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('seo_description')}}</label>
                                                        <input type="text" name="seo[describe]"
                                                               value="{{json_decode($data->seo)->describe}}"
                                                               class="form-control required">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('article_category')}}</label>
                                                        <ul class="treeCategor"
                                                            style="list-style: none;margin: 0;padding: 0">
                                                            @foreach($articleCategoryList as $articleCategoryListVal)
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

                                                                            <input type="checkbox"
                                                                                   @if(in_array($articleCategoryListVal->id,explode(',',$data->category)))
                                                                                   checked
                                                                                   @endif
                                                                                   onchange=""
                                                                                   name="category[]"
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
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('common_cover')}}</label>
                                                        @foreach(explode(',',$data->cover) as $value)
                                                            <div class="row text-center" style="position: relative;">
                                                                <img src="{{asset($value)}}"
                                                                     style="width: 90%;">
                                                                <span onclick="$(this).parent('div').remove();"
                                                                      style="position: absolute;font-size: 20px;color: red;right: 30px;cursor: pointer;">x</span>
                                                                <input type="hidden" value="{{$value}}"
                                                                       name="oldCover[]">
                                                            </div>
                                                        @endforeach
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
                                                        <button type="submit" onclick="" class="btn btn-primary">
                                                            {{admin_language('common_submit')}}
                                                        </button>
                                                        <button style="margin-left: 10px;" type="button" onclick="window.history.go(-1);" class="btn btn-success">
                                                            {{admin_language('common_Return')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <input type="hidden" name="id" value="{{$data->id}}">
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

@include('admin/common/js')

<script>
    function addOnLine() {

        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['935px', '550px'], //宽高
            content: '<div class="on-line-l"></div>'
        });
        onLineUpload.init('.on-line-l','/');
    }
    $("body").on('click','.fileAll',function(){
        appendEditor(this);
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

</script>
<script type="text/javascript">
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

</script>
</body>
</html>