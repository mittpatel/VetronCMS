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
                                <strong>{{admin_language($languageType)}}</strong>
                            </div>
                            <div class="panel-body">
                                <form class="" method="post">
                                    {{csrf_field()}}
                                    <fieldset>
                                        <div class="row" id="">
                                            <div class="form-group">
                                                @if($data==1)
                                                    <div class="col-md-4 col-sm-6" style="margin-top: 10px;">
                                                        {{admin_language('common_noData')}}
                                                    </div>
                                                @else
                                                    @foreach($data as $key=>$value)
                                                        <div class="col-md-4 col-sm-6" style="margin-top: 10px;">
                                                            <label style="color: #000000;">{{$key}}</label>
                                                            <input type="text" name="{{$key}}" value="{{$value}}"
                                                                   class="form-control required">
                                                        </div>
                                                    @endforeach
                                                @endif


                                            </div>
                                        </div>
                                        <div id="tmpLang" class="row" style="">

                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button style="" type="button" onclick="window.history.go(-1);" class="btn btn-success">
                                                    {{admin_language('common_Return')}}
                                                </button>
                                                <button type="button"
                                                        onclick="$('#tmpLang').append($('.tmpLang').last().clone())"
                                                        class="btn btn-success">
                                                   {{admin_language('common_add')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{admin_language('common_submit')}}
                                                </button>

                                            </div>
                                        </div>
                                    </fieldset>

                                </form>

                            </div>

                        </div>


                    </div>

                </div>
            </div>

            @include('admin/common/footer')
        </section>

    </div>
</div>
<div class="" style="display: none;">
    <div class="tmpLang">
        <div class="col-md-4 col-sm-12"
             style="margin-top: 10px;display: flex;justify-content: space-between;">
            <input name="languageKey[]" style="width: 48%;" placeholder="key"
                   type="text" class="form-control">
            <input name="languageValue[]" style="width: 48%;"
                   placeholder="value" type="text" class="form-control">
            <div onclick="$(this).parents('.tmpLang').remove()"
                 style="position: absolute;right: 20px;top: 10px;font-size: 16px;cursor: pointer;color: red;">
                X
            </div>
        </div>
    </div>
</div>
@include('admin/common/js')
</body>
</html>