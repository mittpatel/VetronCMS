<script type="text/javascript">var plugin_path = '<?php echo e(app_public()); ?>template/admin/assets/plugins/';</script>
<script type="text/javascript">var site_root = '<?php echo e(url('/')); ?>';</script>
<script type="text/javascript">var site_public = '<?php echo e(asset('/')); ?>';</script>
<script type="text/javascript">var token = '<?php echo e(csrf_token()); ?>';</script>
<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/layer/layer.js"></script>
<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/js/cms.js"></script>
<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/scripts/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/scripts/js/bootstrap-treeview.js"></script>

<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/scripts/Jcrop.js"></script>

<script type="text/javascript" charset="utf-8"
        src="<?php echo e(app_public()); ?>template/admin/assets/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8"
        src="<?php echo e(app_public()); ?>template/admin/assets/ueditor/ueditor.all.min.js"></script>
    <?php if(ADMIN_LOCALE=='zh'): ?>
        <script type="text/javascript" charset="utf-8"
                src="<?php echo e(app_public()); ?>template/admin/assets/ueditor/lang/zh-cn/zh-cn.js"></script>
    <?php else: ?>
        <script type="text/javascript" charset="utf-8"
                src="<?php echo e(app_public()); ?>template/admin/assets/ueditor/lang/en/en.js"></script>
    <?php endif; ?>
<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/scripts/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/scripts/jquery.imgareaselect.pack.js"></script>
<script type="text/javascript" src="<?php echo e(app_public()); ?>template/admin/assets/scripts/upload-get-new.js"></script>

<script>
    <?php if(session()->has('tips')): ?>
    layer.msg("<?php echo e(session()->pull('tips')); ?>");
    <?php endif; ?>
    if ($("#editor").attr("id")) {

        var ue = UE.getEditor('editor', {
            autoFloatEnabled: false
        });
    }
</script>