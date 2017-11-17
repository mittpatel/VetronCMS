<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title><?php echo e(admin_language('common_login')); ?></title>
    <meta name="description" content=""/>
    <meta name="Author" content=""/>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext"
          rel="stylesheet" type="text/css"/>

    <link rel="shortcut icon" href="<?php echo e(app_public()); ?>template/admin/assets/favicon.ico">
    <link href="<?php echo e(app_public()); ?>template/admin/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(app_public()); ?>template/admin/assets/css/essentials.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(app_public()); ?>template/admin/assets/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(app_public()); ?>template/admin/assets/css/color_scheme/custom.css" rel="stylesheet" type="text/css"
          id="color_scheme"/>
    <link href="<?php echo e(app_public()); ?>template/admin/assets/css/login.css" rel="stylesheet" type="text/css"/>

</head>

<body>


<div class="padding-15">

    <div class="login-box">
        <div class="boxed login_logo">
            <img src="<?php echo e(app_public()); ?>template/admin/assets/vetron_logo.png">
        </div>

        <!-- login form -->
        <form action="" method="post" class="sky-form boxed">
            <?php echo e(csrf_field()); ?>

            <header><i class="fa fa-users"></i><?php echo e(admin_language('common_login')); ?></header>
            <?php if(session('error_tips')): ?>
                <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
                    <?php echo e(session()->pull('error_tips')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('ok_tips')): ?>
                <div class="alert alert-warning noborder text-center weight-400 nomargin noradius">
                </div>
            <?php endif; ?>


            <fieldset>

                <section>
                    <label class="label"></label>
                    <label class="input">
                        <i class="icon-append fa fa-user"></i>
                        <input type="text" required="" name="name" value="<?php echo e(session()->pull('login_data')['name']); ?>" placeholder="<?php echo e(admin_language('common_userName')); ?>">
                        <span class="tooltip tooltip-top-right"><?php echo e(admin_language('common_userName')); ?></span>
                    </label>
                </section>

                <section>
                    <label class="label"></label>
                    <label class="input">
                        <i class="icon-append fa fa-lock"></i>
                        <input type="password" required="" name="password" placeholder="<?php echo e(admin_language('common_password')); ?>">
                        <span class="tooltip tooltip-top-right"><?php echo e(admin_language('common_password')); ?></span>
                    </label>
                </section>

            </fieldset>

            <footer>
                <button type="submit" class="btn btn-primary pull-right"><?php echo e(admin_language('common_submit')); ?></button>
                <div class="forgot-password pull-left">
                    <a href="<?php echo e(url('admin/forgotPassword')); ?>"><?php echo e(admin_language('common_forgetPassword')); ?></a> <br/>
                    
                </div>
            </footer>
        </form>
        <!-- /login form -->

        <hr/>

        
        
        


        <div class="socials margin-top-10 text-center">
            <a href="<?php echo e(url('/')); ?>"><?php echo e(admin_language('common_home')); ?></a>
        </div>

    </div>

</div>

<script type="text/javascript">var plugin_path = '<?php echo e(app_public()); ?>template/admin/assets/plugins/';</script>
<script type="text/javascript"
        src="<?php echo e(app_public()); ?>template/admin/assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/layer/layer.js"></script>

</body>
</html>