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

                        <!-- ------ -->
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong>{{admin_language('common_add')}}</strong>
                            </div>

                            <div class="panel-body">
                                <form id="addLang">
                                    <fieldset>
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_name')}}({{admin_language('common_languageKey')}})</label>
                                                    <input type="text" name="language_key"
                                                           value="{{session_form_old('language_key')}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('language_abbreviation')}}</label>
                                                    <input type="text" name="folder"
                                                           value="{{session_form_old('active')}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('language_module')}}</label>
                                                    <div class="sky-form">
                                                        <label class="checkbox" style="display: inline-block;">
                                                            <input value="1" type="checkbox" name="modular[]" id="drop-remove"><i></i>{{admin_language('language_frontDesk')}}
                                                        </label>
                                                        <label class="checkbox" style="display: inline-block;">
                                                            <input value="2" type="checkbox" name="modular[]" id="drop-remove"><i></i>{{admin_language('language_backstage')}}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('language_synchronize')}}</label>
                                                    <select name="langKey" class="form-control pointer ">
                                                        <option value="0">{{admin_language('common_select')}}</option>
                                                        @foreach($languageList as $languageListVal)
                                                            <option value="{{$languageListVal->id}}">{{admin_language($languageListVal->language_key)}}
                                                                ( @if($languageListVal->modular==1){{admin_language('language_frontDesk')}}@else{{admin_language('language_backstage')}} @endif )
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_note')}}</label>
                                                    <textarea name="note"
                                                              class="form-control">{{session_form_old('note')}}</textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" onclick="addLanguage()" class="btn btn-primary">
                                                    {{admin_language('common_submit')}}
                                                </button>
                                                <button style="margin-left: 10px;" type="button" onclick="window.history.go(-1);" class="btn btn-success">
                                                    {{admin_language('common_Return')}}
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                    {{csrf_field()}}
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
    function addLanguage() {
        var ajaxHeader = layer.load();
        $.ajax({
            type: 'POST',
            url: window.location.href,
            data: $('#addLang').serialize(),
            success: function (data) {
                data = $.parseJSON(data);
                layer.msg(data.msg);
                layer.close(ajaxHeader);

                if (data.status == 1) {
                    setTimeout(function () {
                        window.location = data.url;
                    },1000);
                }
            }
        });
    }
</script>
</body>
</html>