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
                                                    <label>{{admin_language('common_name')}}
                                                        ({{admin_language('common_languageKey')}})
                                                    </label>
                                                    <span style="color: red;"></span>
                                                    <input onchange="checkLangKeyOnly($(this).val(),2,this)"
                                                           type="text" name="language_key"
                                                           value="{{$data->language_key}}"
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
                                                                   value=""
                                                                   class="form-control required">
                                                        @endforeach
                                                    </div>

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