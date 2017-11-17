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
                                <strong>{{admin_language('common_edit')}}</strong>
                            </div>

                            <div class="panel-body">

                                <form class="" action="" method="post" enctype="multipart/form-data">
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
                                                           val="{{$data->language_key}}"
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
                                                        <span style="cursor:pointer;"
                                                              onclick="$(this).next().show();$(this).hide();$('.languageVal').show();"
                                                              id="" class="glyphicon glyphicon-plus"></span>
                                                        <span onclick="$(this).prev().show();$(this).hide();$('.languageVal').hide();"
                                                              style="display: none;cursor:pointer;" id=""
                                                              class="glyphicon glyphicon-minus"></span>
                                                    </label>
                                                    <div style="display: none;" class="languageVal">
                                                        @foreach($language as $l)
                                                            <input placeholder="{{admin_language($l->language_key)}}"
                                                                   style='margin-top: 3px;' type="text"
                                                                   name="lang[{{$l->folder}}]"
                                                                   value="{{language_all($data->language_key,'admin',$l->folder)}}"
                                                                   class="form-control required">
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_route')}}</label>
                                                    <input type="text" name="route" value="{{$data->route}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_auth')}}</label>
                                                    <input type="text" name="auth" value="{{$data->auth}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_icon')}}</label>
                                                    <input type="text" name="icon" value="{{$data->icon}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_active')}}</label>
                                                    <input type="text" name="active" value="{{$data->active}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_note')}}</label>
                                                    <textarea name="note"
                                                              class="form-control">{{$data->note}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_display')}}</label>
                                                    <select name="is_show"
                                                            class="form-control pointer required">
                                                        <option value="1"
                                                                @if($data->is_show==1) selected @endif>{{admin_language('common_yes')}}</option>
                                                        <option value="2"
                                                                @if($data->is_show==2) selected @endif>{{admin_language('common_no')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('menu_parent')}}</label>
                                                    <select name="p_id"
                                                            class="form-control pointer required">
                                                        <option value="0"
                                                                @if($data->p_id==0) selected @endif>{{admin_language('menu_topLevel')}}</option>
                                                        @foreach($menu as $v)
                                                            <option @if($data->p_id==$v->id) selected
                                                                    @endif value="{{$v->id}}">{{admin_language($v->language_key)}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_order')}}</label>
                                                    <input type="text" name="order" value="{{$data->order}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary">{{admin_language('common_submit')}}</button>
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
</body>
</html>