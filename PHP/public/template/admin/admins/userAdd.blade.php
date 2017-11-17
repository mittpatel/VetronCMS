<!doctype html>
<html lang="en-US">
@include('admin/common/head')
<style>
    .sky-form .checkbox input + i:after {
        color: rgba(0, 0, 0, 8);
    }
</style>
<body>

<div class="container">
    <div id="wrapper" class="clearfix">


        @include('admin/common/nav')

        @include('admin/common/header')

        <section id="middle">
            @include('admin/common/crumbs')
            <div id="content" class="padding-20">


                <div class="row">

                    <div class="col-md-12">

                        <!-- ------ -->
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong>{{admin_language('common_add')}}</strong>
                            </div>

                            <div class="panel-body">

                                <form id="addUser">
                                    <fieldset>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <label>{{admin_language('common_userName')}} <span
                                                                style="color: red;">*</span></label>
                                                    <input type="text" name="name"
                                                           value=""
                                                           class="form-control required">
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <label>{{admin_language('common_password')}} <span
                                                                style="color: red;">*</span></label>
                                                    <input type="text" name="password"
                                                           value=""
                                                           class="form-control required">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <label>{{admin_language('common_email')}}</label>
                                                    <input type="text" name="email"
                                                           value=""
                                                           class="form-control required">
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <label>{{admin_language('common_phoneNumber')}}</label>
                                                    <input type="text" name="phone"
                                                           value=""
                                                           class="form-control required">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <label>{{admin_language('common_company')}}</label>
                                                    <input type="text" name="company"
                                                           value=""
                                                           class="form-control required">
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <label>{{admin_language('common_address')}}</label>
                                                    <input type="text" name="address"
                                                           value=""
                                                           class="form-control required">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <label>{{admin_language('profile_Introduction')}}</label>
                                                    <textarea rows="6" class="form-control"
                                                              name="introduction"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <div style="display: flex;justify-content: space-between;align-items: flex-end">
                                                        <label>
                                                            {{admin_language('profile_HeadPortrait')}} <span
                                                                    style="color: red;">*</span>
                                                        </label>

                                                    </div>

                                                    <div class="fancy-file-upload fancy-file-primary">
                                                        <i class="fa fa-upload"></i>
                                                        <input type="file" class="form-control" name="header[]"
                                                               id="header-header"
                                                               onchange="jQuery(this).next('input').val(this.value);ajaxUploadHeader(this)">
                                                        <input type="text" class="form-control"
                                                               placeholder="no file selected" readonly="">
                                                        <span class="button">{{admin_language('setting_selectFile')}}</span>

                                                    </div>
                                                    <label>
                                                        <img class="headerImg" id=""
                                                             style="height: 50px;margin-top: 10px;display: none;"
                                                             src="">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    {{--
                                                        <label>{{admin_language('admin_adminGroup')}} <span
                                                                    style="color: red;">*</span></label>
                                                        <select class="form-control" name="g_id" id="">
                                                            @foreach($groupList as $groupListVal)
                                                                <option value="{{$groupListVal->id}}">{{str_repeat("─ ",$groupListVal->level)}}{{admin_language($groupListVal->language_key)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    --}}
                                                    <label>{{admin_language('admin_adminGroup')}} <span
                                                                style="color: red;">*</span></label>
                                                    <div class="sky-form">
                                                        @foreach($groupList as $groupListVal)

                                                            <label style="display: inline-block;" class="checkbox">
                                                                <input type="checkbox" value="{{$groupListVal->id}}"
                                                                       name="g_id[]"
                                                                       id="drop-remove">
                                                                <i style="border-color:#676a6c;color: #676a6c"></i>
                                                                {{admin_language($groupListVal->language_key)}}
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6">
                                                    <input type="button" value="{{admin_language('common_submit')}}"
                                                           onclick="addUser()"
                                                           class="btn btn-primary">
                                                    <button style="margin-left: 10px;" type="button" onclick="window.history.go(-1);" class="btn btn-success">
                                                        {{admin_language('common_Return')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    {{csrf_field()}}
                                    <input type="hidden" name="header">
                                    <input type="hidden" name="p_id" value="{{session('vetronCmsLogin')->id}}">
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


@include('admin/common/js')
<script>
    function addUser() {
        var submitCategory = layer.load();
        $.ajax({
            type: 'post',
            url: window.location.href,
            data: $('#addUser').serialize(),
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
            url: "{{url('admin/ajaxUploadHeader')}}",//处理图片脚本
            token: "{{csrf_token()}}"
        }, function (data) {
            layer.close(ajaxHeader);
            if (data.status == 1) {
                $(".headerImg").prop('src', data.url).show();
                $('input[name=header]').val(data.path);
            } else {
                layer.msg(data.msg);
            }
        });
    };

</script>
</body>
</html>