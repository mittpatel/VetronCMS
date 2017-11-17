<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title>{{admin_language('common_login')}}</title>
    <meta name="description" content=""/>
    <meta name="Author" content=""/>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext"
          rel="stylesheet" type="text/css"/>

    <link rel="shortcut icon" href="{{app_public()}}template/admin/assets/favicon.ico">
    <link href="{{app_public()}}template/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{app_public()}}template/admin/assets/css/essentials.css" rel="stylesheet" type="text/css"/>
    <link href="{{app_public()}}template/admin/assets/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="{{app_public()}}template/admin/assets/css/color_scheme/custom.css" rel="stylesheet" type="text/css"
          id="color_scheme"/>
    <link href="{{app_public()}}template/admin/assets/css/login.css" rel="stylesheet" type="text/css"/>

</head>

<body>


<div class="padding-15">

    <div class="login-box">
        <div class="boxed login_logo">
            <img src="{{app_public()}}template/admin/assets/vetron_logo.png">
        </div>

        <!-- login form -->
        <form action="" method="post" class="sky-form boxed">
            {{csrf_field()}}
            <header><i class="fa fa-users"></i>{{admin_language('common_login')}}</header>
            @if(session('error_tips'))
                <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
                    {{session()->pull('error_tips')}}
                </div>
            @endif
            @if(session('ok_tips'))
                <div class="alert alert-warning noborder text-center weight-400 nomargin noradius">
                </div>
            @endif


            <fieldset>

                <section>
                    <label class="label"></label>
                    <label class="input">
                        <i class="icon-append fa fa-user"></i>
                        <input type="text" required="" name="name" value="{{session()->pull('login_data')['name']}}" placeholder="{{admin_language('common_userName')}}">
                        <span class="tooltip tooltip-top-right">{{admin_language('common_userName')}}</span>
                    </label>
                </section>

                <section>
                    <label class="label"></label>
                    <label class="input">
                        <i class="icon-append fa fa-lock"></i>
                        <input type="password" required="" name="password" placeholder="{{admin_language('common_password')}}">
                        <span class="tooltip tooltip-top-right">{{admin_language('common_password')}}</span>
                    </label>
                </section>

            </fieldset>

            <footer>
                <button type="submit" class="btn btn-primary pull-right">{{admin_language('common_submit')}}</button>
                <div class="forgot-password pull-left">
                    <a href="{{url('admin/forgotPassword')}}">{{admin_language('common_forgetPassword')}}</a> <br/>
                    {{--<a href="page-register.html"><b>{{trans('admin_lang.Need_to_Register')}}?</b></a>--}}
                </div>
            </footer>
        </form>
        <!-- /login form -->

        <hr/>

        {{--<div class="text-center">--}}
        {{--Or sign in using:--}}
        {{--</div>--}}


        <div class="socials margin-top-10 text-center">
            <a href="{{url('/')}}">{{admin_language('common_home')}}</a>
        </div>

    </div>

</div>

<script type="text/javascript">var plugin_path = '{{app_public()}}template/admin/assets/plugins/';</script>
<script type="text/javascript"
        src="{{app_public()}}template/admin/assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="{{app_public()}}template/admin/assets/js/app.js"></script>
<script type="text/javascript" src="{{app_public()}}template/admin/assets/layer/layer.js"></script>

</body>
</html>