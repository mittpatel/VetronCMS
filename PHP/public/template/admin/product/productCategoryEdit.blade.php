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

                <div class="row">

                    <div class="col-md-12">

                        <!-- ------ -->
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong>{{admin_language('common_edit')}}</strong>
                            </div>

                            <div class="panel-body">

                                <form method="post" id="categoryForm">
                                    <fieldset>
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_name')}}
                                                        ({{admin_language('common_languageKey')}})
                                                    </label>
                                                    <span style="color: red;"></span>
                                                    <input onchange="checkLangKeyOnly($(this).val(),2,this)"
                                                           type="text" name="language_key"
                                                           value="{{$categoryOne->language_key}}"
                                                           val="1"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>
                                                        {{admin_language('menu_LanguageValue')}}
                                                        {{--<apan style="font-size: 14px;"><b>+</b></apan>--}}
                                                        <span style="cursor:pointer" onclick="$(this).next().show();$(this).hide();$('.languageVal').show();" id="" class="glyphicon glyphicon-plus"></span>
                                                        <span onclick="$(this).prev().show();$(this).hide();$('.languageVal').hide();" style="display: none;cursor:pointer" id="" class="glyphicon glyphicon-minus"></span>
                                                    </label>
                                                    <div style="display: none;" class="languageVal">
                                                        @foreach($language as $l)
                                                            <input placeholder="{{admin_language($l->language_key)}}"
                                                                   style='margin-top: 3px;' type="text"
                                                                   name="lang[{{$l->folder}}]"
                                                                   value="{{language_all($categoryOne->language_key,'home',$l->folder)}}"
                                                                   class="form-control required">
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('product_category')}} *</label>
                                                    @if(!$isLastSonCategory)<span style="font-size: 12px;color: #ccc;">{{admin_language('product_editProhibited')}}</span>@endif
                                                    <select @if(!$isLastSonCategory) disabled @endif name="pid" class="form-control pointer required">
                                                        <option value="0">{{admin_language('menu_topLevel')}}</option>
                                                        @foreach($categoryList as $categoryListVal)
                                                            {{--不能修改成自己的子类，或者修改成本类--}}
                                                            @if($categoryOne->id != $categoryListVal->pid)
                                                                @if($categoryOne->id != $categoryListVal->id)
                                                                    <option @if($categoryOne->pid==$categoryListVal->id) selected
                                                                            @endif value="{{$categoryListVal->id}}">
                                                                        {{str_repeat("─ ",$categoryListVal->level)}}
                                                                        {{home_language($categoryListVal->language_key)}}
                                                                    </option>
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_status')}}</label>
                                                    <div class="sky-form">
                                                        <label style="display: inline-block;" class="radio">
                                                            <input type="radio"
                                                                   name="status"
                                                                   value="1"
                                                                   @if($categoryOne->status==1) checked @endif
                                                            ><i></i> <span
                                                                    class="text-primary">{{admin_language('common_enabled')}}</span></label>
                                                        <label style="display: inline-block;" class="radio"><input
                                                                    type="radio"
                                                                    name="status"
                                                                    @if($categoryOne->status==2) checked @endif
                                                                    value="2"><i></i> <span
                                                                    class="text-warning">{{admin_language('common_disabled')}}</span></label>
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
                                                    <textarea class="form-control" rows="5"
                                                              name="note">{{$categoryOne->note}}</textarea>
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

                                    <input type="hidden" name="id" value="{{$categoryOne->id}}">
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
</script>
</body>
</html>