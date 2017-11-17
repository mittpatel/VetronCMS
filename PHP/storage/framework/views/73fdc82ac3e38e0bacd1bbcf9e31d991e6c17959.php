<!doctype html>
<html lang="en-US">
<?php echo $__env->make('admin/common/head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style>

    .plugin_avater {
        position: relative;
        width: 72px;
        top: -11px
    }

    .plugin_athor {
        height: 30px;
        line-height: 30px;
    }

    .plugin-text-right {
        float: right;
    }

    .plugin-settting {
        height: 21px;
        line-height: 21px;
    }

</style>
<body>

<div class="container">
    <div id="wrapper" class="clearfix">

        <?php echo $__env->make('admin/common/nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('admin/common/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <section id="middle">
            <?php echo $__env->make('admin/common/crumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div id="content" class="dashboard padding-20">
                <iframe id="pluginList" style="width: 100%;height: 100%;" src="<?php echo e($iframeUrl); ?>"></iframe>
            </div>
            <?php echo $__env->make('admin/common/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </section>

    </div>
</div>

<?php echo $__env->make('admin/common/js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>

    function actionPlugin(url) {
        layer.confirm('<?php echo e(admin_language('theme_areYouSureYouWantToPerformThisOperation')); ?>？', {
            title: ['<?php echo e(admin_language('common_tips')); ?>'],     //提示
            btn: ['<?php echo e(admin_language('common_confirm')); ?>', '<?php echo e(admin_language('common_cancel')); ?>'], //按钮
        }, function () {
            window.location = url;
        });

    }
    $(function () {
       $("#pluginList").height($(window).height()-162);
       $(window).resize(function () {
           $("#pluginList").height($(window).height()-162);
       })
    });


    //下载完成后，跳出iframe
    function reloadIframe(url) {
        window.location=url;
    }


</script>

</body>
</html>