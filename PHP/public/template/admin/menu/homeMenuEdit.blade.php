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
                                <strong>{{admin_language('common_add')}}</strong>
                            </div>

                            <div class="panel-body">

                                <form class="" action="" method="post" enctype="multipart/form-data">
                                    <fieldset>
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_name')}}
                                                        ({{admin_language('common_languageKey')}})</label>
                                                    <input type="text" name="language_key"
                                                           value="{{$menuOne->language_key}}"
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
                                                        <span style="cursor:pointer;" onclick="$(this).next().show();$(this).hide();$('.languageVal').show();" id="" class="glyphicon glyphicon-plus"></span>
                                                        <span onclick="$(this).prev().show();$(this).hide();$('.languageVal').hide();" style="display: none;cursor:pointer;" id="" class="glyphicon glyphicon-minus"></span>
                                                    </label>
                                                    <div style="display: none;" class="languageVal">
                                                        @foreach($language as $l)
                                                            <input placeholder="{{admin_language($l->language_key)}}"
                                                                   style='margin-top: 3px;' type="text"
                                                                   name="lang[{{$l->folder}}]"
                                                                   value="{{language_all($menuOne->language_key,'home',$l->folder)}}"
                                                                   class="form-control required">
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_type')}}</label>
                                                    <select name="type"
                                                            class="form-control pointer required">
                                                        <option @if(!ifHttpHttps($menuOne->route)) selected @endif value="1">{{admin_language('menu_BuiltIn')}}</option>
                                                        <option @if(ifHttpHttps($menuOne->route)) selected @endif value="2">{{admin_language('menu_TheChain')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="row" id="menu_TheChain" style=" @if(ifHttpHttps($menuOne->route)) display:none; @endif">
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label>{{admin_language('Modular')}}</label>
                                                        <select id="Modular" name="modular_id"
                                                                class="form-control pointer required">
                                                            @foreach($menu as $mm)
                                                                @if($mm->type==0)
                                                                    <option @if($mm->id==$menuOne->modular_id) selected @endif parameter="{{$mm->parameter}}" value="{{$mm->id}}" route="{{$mm->route}}">{{home_language($mm->language_key)}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_route')}}
                                                        
                                                            <span id="canshu" style="@if(ifHttpHttps($menuOne->route)) display: none; @endif">

                                                                                                                   ( {{admin_language('Parameter')}} :<span class="Parameter"></span>)

                                                            </span>
                                                       
                                                    </label>
                                                    <input type="text" name="route"
                                                           value="{{$menuOne->route}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('menu_NewWindow')}}</label>
                                                    <select name="target"
                                                            class="form-control pointer required">
                                                        <option @if($menuOne->target==1) selected @endif value="1">{{admin_language('common_no')}}</option>
                                                        <option @if($menuOne->target==2) selected @endif value="2">{{admin_language('common_yes')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_order')}}</label>
                                                    <input type="text" name="order"
                                                           value="{{$menuOne->order}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_icon')}}</label>
                                                    <input type="text" name="icon" value="{{$menuOne->icon}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_active')}}</label>
                                                    <input type="text" name="active"
                                                           value="{{$menuOne->active}}"
                                                           class="form-control required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('common_note')}}</label>
                                                    <textarea name="note"
                                                              class="form-control">{{$menuOne->note}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <label>{{admin_language('menu_parent')}}</label>
                                                    @if($isLow)<span style="font-size: 12px;color: #ccc;">{{admin_language('article_editProhibited')}}</span>@endif
                                                    <select @if($isLow) disabled @endif name="p_id"
                                                            class="form-control pointer required">
                                                        <option value="0">{{admin_language('menu_topLevel')}}</option>
                                                        @foreach($menu as $v)
                                                            <option @if($menuOne->p_id==$v->id) selected
                                                                    @endif value="{{$v->id}}">{{str_repeat("─ ",$v->level)}}{{home_language($v->language_key)}}</option>
                                                        @endforeach
                                                    </select>
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
                                    <input type="hidden" name="id" value="{{$menuOne->id}}">
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


    $("#Modular").change(function () {
        $(":input[name=route]").val($("#Modular").find("option:selected").attr('route'));
        $(".Parameter").html($("#Modular").find("option:selected").attr('Parameter'));
    });


    $(':input[name=type]').change(function () {
        if($(this).val()==1) {
            $("#canshu").show();
            $("#menu_TheChain").show();
            $(":input[name=route]").val($("#Modular").find("option:selected").attr('route'));
            $(".Parameter").html($("#Modular").find("option:selected").attr('Parameter'));
        }else {
            $("#menu_TheChain").hide();
            $(":input[name=route]").val('');
            $("#canshu").hide();
        }
    });
</script>
@if(count($errors))
    <script>
        layer.msg("{{$errors->first()}}")
    </script>
@endif
</body>
</html>