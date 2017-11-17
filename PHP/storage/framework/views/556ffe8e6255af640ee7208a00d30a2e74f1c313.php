<!doctype html>
<html lang="en-US">
<?php echo $__env->make('admin/common/head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body>

<div class="container">
    <!-- WRAPPER -->
    <div id="wrapper" class="clearfix">

        <?php echo $__env->make('admin/common/nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('admin/common/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <section id="middle">
            <?php echo $__env->make('admin/common/crumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            <div id="content" class="dashboard padding-20">
                <div id="panel-1" class="panel panel-default">
                    <div class="panel-heading">
							<span class="title elipsis">
								<strong><?php echo e(admin_language('common_lists')); ?></strong> <!-- panel title -->
							</span>

                        <!-- right options -->
                        <ul class="options pull-right list-inline">


                            <li>
                                <a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse"
                                   data-placement="bottom"></a>
                            </li>
                            <li>
                                <a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip"
                                   title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a>
                            </li>
                            <li>
                                <a href="#" class="opt panel_close" data-confirm-title="Confirm"
                                   data-confirm-message="Are you sure you want to remove this panel?"
                                   data-toggle="tooltip" title="Close" data-placement="bottom"><i
                                            class="fa fa-times"></i></a>
                            </li>
                        </ul>
                        <!-- /right options -->

                    </div>

                    <!-- panel content -->
                    <div class="panel-body">
                        <div class="table-responsive" style="overflow-x: hidden">
                            <table class="table table-striped table-hover  dataTable no-footer"
                                   id="datatable_sample">
                                <thead>
                                <tr>
                                    <th><?php echo e(admin_language('common_name')); ?></th>
                                    <th style=""><?php echo e(admin_language('theme_fileType')); ?></th>
                                    <th style=""><?php echo e(admin_language('theme_updateTime')); ?></th>
                                    <th style="width: 180px;"><?php echo e(admin_language('common_action')); ?></th>
                                </tr>
                                </thead>
                                <tbody class="line-height-40">
                                <?php if(!$isRoot): ?>
                                    <tr>
                                        <td colspan="4">
                                            <a href="<?php echo e(url('admin/setting/theme',[$theme])); ?>?path=<?php echo e($upPath); ?>"> . .
                                                .</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($file!='.' && $file!='..'): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                                <?php if($file['isDir']==1): ?>
                                                    <a href="<?php echo e(url('admin/setting/theme',[$theme])); ?>?path=<?php echo e($file['path']); ?>"><?php echo e($file['name']); ?></a>
                                                <?php else: ?>
                                                    <?php echo e($file['name']); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo e($file['suffix']); ?>

                                            </td>
                                            <td>
                                                <?php echo e($file['time']); ?>

                                            </td>
                                            <td>
                                                <a <?php if(!$file['allowEdit']): ?> disabled href="javascript:;" <?php endif; ?>
                                                <?php if($file['isDir']==1): ?>
                                                onclick="changeName('<?php echo e($file['path']); ?>')"
                                                   <?php else: ?>
                                                   href="<?php echo e(url('admin/setting/theme/change/file')); ?>?file=<?php echo e($file['name']); ?>&path=<?php echo e($nowPath); ?>&theme=<?php echo e($theme); ?>"
                                                   <?php endif; ?>
                                                   class="btn btn-success btn-xs white"><i
                                                            class="fa fa-edit white"></i>
                                                    <?php echo e(admin_language('common_edit')); ?>

                                                </a>
                                                <a onclick="deleteFile('<?php echo e($theme.$nowPath.'/'.$file['name']); ?>')"
                                                   href="javascript:;"
                                                   class="btn btn-danger btn-xs white delete">
                                                    <i class="fa fa-times white"></i>
                                                    <?php echo e(admin_language('common_delete')); ?>

                                                </a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

            <?php echo $__env->make('admin/common/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </section>

    </div>
</div>

<?php echo $__env->make('admin/common/js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    function changeName(str) {
        var indexprompt = layer.prompt({
            title: '<?php echo e(admin_language('theme_EnterANewName')); ?>',
            formType: 3,		//3是明文，1是密文，2是文本域
            btn: ['<?php echo e(admin_language('common_confirm')); ?>', '<?php echo e(admin_language('common_cancel')); ?>'],
        }, function (text) {		//text是输入的值
            layer.close(indexprompt);
            var changeNameS = layer.load();
            $.ajax({
                type: 'GET',
                url: "<?php echo e(url('admin/setting/theme/change/FolderName')); ?>",
                data: {path: str, name: text, theme: '<?php echo e($theme); ?>', upPath: '<?php echo e($upPath); ?>'},
                success: function (data) {
                    layer.close(changeNameS)
                    data = $.parseJSON(data);
                    if (data.status == 1) {
                        layer.msg(data.msg);
                        window.location.reload();
                    } else {
                        layer.msg(data.msg);
                    }
                },
                error: function () {
                }
            });
        });
    }
    function deleteFile(s) {
        /*确认要执行此操作吗*/
        layer.confirm('<?php echo e(admin_language('theme_areYouSureYouWantToPerformThisOperation')); ?>', {
            title: ['<?php echo e(admin_language('common_tips')); ?>'],     //提示
            btn: ['<?php echo e(admin_language('common_confirm')); ?>', '<?php echo e(admin_language('common_cancel')); ?>'], //按钮
        }, function () {
            window.location = "<?php echo e(url('admin/setting/theme/change/delete')); ?>?s=" + s
        });
    }

</script>
</body>
</html>