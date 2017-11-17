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

                <div id="content" class="padding-20">

                    <div class="page-profile">

                        <div class="row">

                            <!-- COL 1 -->
                            <div class="col-md-4 col-lg-3">
                                <section class="panel">
                                    <div class="panel-body noradius padding-10">

                                        <figure class="margin-bottom-10"><!-- image -->
                                            <img class="img-responsive"
                                                 src="{{asset($adminData->header)}}"
                                                 alt=""/>
                                        </figure><!-- /image -->


                                        {{--<ul class="list-unstyled size-13">--}}
                                            {{--<li>Confirm Your Account</li>--}}
                                            {{--<li>Update Your Address</li>--}}
                                        {{--</ul><!-- /updated -->--}}

                                        <hr class="half-margins"/>

                                        <!-- About -->
                                        <h3 class="text-black">
                                            {{session('vetronCmsLogin')->name}}
                                        </h3>
                                        <p class="size-12">
                                            {{session('vetronCmsLogin')->introduction}}

                                        </p>
                                        <!-- /About -->

                                        <hr class="half-margins"/>

                                    </div>
                                </section>
                            </div><!-- /COL 1 -->

                            <!-- COL 2 -->
                            <div class="col-md-8 col-lg-9">

                                <div class="tabs white nomargin-top">
                                    <ul class="nav nav-tabs tabs-primary">
                                        <li class="@if($_GET['a']=='h' || $_GET['page'] || !$_GET) active @endif">
                                            <a href="#overview" data-toggle="tab">
                                                {{admin_language('profile_LandingHistory')}}
                                            </a>
                                        </li>
                                        <li class="@if($_GET['a']=='d') active @endif">
                                            <a href="#edit" data-toggle="tab">
                                                {{admin_language('profile_EditMyInformation')}}
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">

                                        <!-- Overview -->
                                        <div id="overview" class="tab-pane @if($_GET['a']=='h' || $_GET['page'] || !$_GET) active @endif">

                                            <table class="table table-striped table-hover" id="sample_editable_1">
                                                <thead>
                                                <tr>
                                                    <th>IP</th>
                                                    <th>{{admin_language('profile_browser')}}</th>
                                                    <th>{{admin_language('profile_city')}}</th>
                                                    <th style="width: 150px;">{{admin_language('profile_time')}}</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($loginHistory as $loginHistoryVal)
                                                    <tr>
                                                        <td>
                                                            {{$loginHistoryVal->ip}}
                                                        </td>
                                                        <td>
                                                            {{$loginHistoryVal->browser}}
                                                        </td>
                                                        <td>
                                                            @if($loginHistoryVal->city)
                                                                {{$loginHistoryVal->city}}
                                                            @else
                                                                {{--未知--}}
                                                                {{admin_language('profile_unknown')}}
                                                            @endif
                                                        </td>
                                                        <td class="center">
                                                            {{$loginHistoryVal->create_time}}
                                                        </td>

                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                            {{$loginHistory->links()}}

                                        </div>

                                        <!-- Edit -->
                                        <div id="edit" class="tab-pane @if($_GET['a']=='d') active @endif">

                                            <form class="form-horizontal" id="changeProfile">
                                                <h4>{{admin_language('profile_PersonalInformation')}}</h4>
                                                <fieldset>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label" for="profileLastName">
                                                            {{admin_language('common_name')}}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input readonly value="{{$adminData->name}}"
                                                                   type="text" class="form-control"
                                                                   id="profileLastName">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label" for="profileCompany">
                                                            {{admin_language('common_email')}}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input readonly type="text"
                                                                   value="{{$adminData->email}}"
                                                                   class="form-control" id="profileCompany">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label" for="profileCompany">
                                                            {{admin_language('index_company')}}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="company"
                                                                   value="{{$adminData->company}}"
                                                                   class="form-control" id="profileCompany">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label" for="profileCompany">
                                                            {{admin_language('common_phoneNumber')}}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="phone" class="form-control"
                                                                   value="{{$adminData->phone}}"
                                                                   id="profileCompany">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label" for="profileAddress">
                                                            {{admin_language('index_address')}}

                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="address" class="form-control"
                                                                   value="{{$adminData->address}}"
                                                                   id="profileAddress">
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <hr/>

                                                <h4>{{admin_language('profile_aboutMe')}}</h4>
                                                <fieldset>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label" for="profileBio">
                                                            {{admin_language('profile_Introduction')}}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <textarea name="introduction" class="form-control" rows="3"
                                                                      id="profileBio">{{$adminData->introduction}}</textarea>
                                                        </div>
                                                    </div>


                                                    <div class="form-group headerDivImg"
                                                         style="margin-bottom: 0;display: none;">
                                                        <div class="sky-form">
                                                            <label class="col-xs-3 control-label">
                                                            </label>
                                                            <div class="col-md-8">
                                                                <label for="file" class="input input-file">
                                                                    <img style="width: 50px;" class="headerImg"
                                                                         src=""
                                                                         alt="">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="sky-form">
                                                            <label class="col-xs-3 control-label">
                                                               {{admin_language('profile_HeadPortrait')}}
                                                            </label>
                                                            <div class="col-md-8">
                                                                <label for="file" class="input input-file">
                                                                    <div class="button">
                                                                        <input type="file" id="file"
                                                                               name="header[]"
                                                                               onchange="$('.header-text').val($(this).val());ajaxUploadHeader(this)">选择
                                                                    </div>
                                                                    <input name="header" type="text" class="header-text"
                                                                           value="">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <hr/>

                                                <h4>{{admin_language('profile_ChangePassword')}} </h4>
                                                <fieldset class="mb-xl">

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label" for="profileNewPassword">
                                                            {{admin_language('profile_oldPassword')}}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control"
                                                                   id="profileNewPassword" name="oldPassword"
                                                                   placeholder="{{admin_language('profile_LeaveBlankIsNotModified')}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label" for="profileNewPassword">
                                                            {{admin_language('profile_newPassword')}}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="newPassword"
                                                                   id="profileNewPassword">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"
                                                               for="profileNewPasswordRepeat">
                                                            {{admin_language('profile_ConfirmTheNewPassword')}}
                                                        </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control"
                                                                   name="repeatPassword"
                                                                   id="profileNewPasswordRepeat">
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <div class="row">
                                                    <div class="col-md-9 col-md-offset-3">
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="changeData()">
                                                            {{admin_language('common_submit')}}
                                                        </button>
                                                    </div>
                                                </div>
                                                {{csrf_field()}}

                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </div><!-- /COL 2 -->

                            <!-- COL 3 -->
                            <div class="col-md-12 col-lg-3">



                            </div><!-- /COL 3 -->

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

    //        上传头像
    function ajaxUploadHeader(e) {
        var ajaxHeader = layer.load();
        ajaxUpload({
            e: e,
            url: "{{url('admin/ajaxUploadHeader')}}",//处理图片脚本
            token: "{{csrf_token()}}"
        }, function (data) {
            layer.close(ajaxHeader);
            if (data.status == 1) {
                $(".headerDivImg").show();
                $(".headerImg").prop('src', data.url);
                $(".header-text").val(data.path);
            } else {
                layer.msg(data.msg);
            }
        });
    };
    //    修改资料
    function changeData() {
        var changeDataLoading = layer.load();
        $.ajax({
            type: 'POST',
            url: "{{url('admin/changeProfile')}}",
            data: $('#changeProfile').serialize(),
            success: function (data) {
                layer.close(changeDataLoading);
                data = $.parseJSON(data);
                if (data.status == 50) {
                    layer.msg(data.msg);
                } else if (data.status == 1) {
                    layer.msg(data.msg);
                    window.location = data.url;
                }

            }
        });
    };

</script>
</body>
</html>