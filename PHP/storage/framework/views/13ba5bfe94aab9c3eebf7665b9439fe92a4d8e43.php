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
                                <a href="<?php echo e(url('admin/product/category/add')); ?>" style="margin-top: 5px;"
                                   class="btn btn-primary btn-xs white fa fa-plus" data-toggle="tooltip"
                                   title="" data-placement="bottom" data-original-title="">
                                    <?php echo e(admin_language('common_add')); ?>

                                </a>
                            </li>
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

                        <table class="table" id="datatable_sample">
                            <thead>
                                <tr>
                                    <th><?php echo e(admin_language('common_name')); ?></th>
                                    <th><?php echo e(admin_language('common_status')); ?></th>
                                    <th><?php echo e(admin_language('common_note')); ?></th>
                                    <th style="width: 200px;"><?php echo e(admin_language('common_createTime')); ?></th>
                                    <th style="width: 220px;"><?php echo e(admin_language('common_action')); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $productCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryListVal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr class="odd gradeX">
                                    <td style="">
                                        <?php if($categoryListVal->level==0): ?>
                                            <b style="font-size: 110%;"><?php echo e(home_language($categoryListVal->language_key)); ?></b>
                                        <?php else: ?>
                                            <?php echo e(str_repeat("─ ",$categoryListVal->level)); ?>

                                            <?php echo e(home_language($categoryListVal->language_key)); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>

                                        <?php if($categoryListVal->status==1): ?>
                                            <span class="listEnableColor"><?php echo e(admin_language('common_enabled')); ?></span>
                                        <?php else: ?>
                                            <span class="listDisableColor"><?php echo e(admin_language('common_disabled')); ?></span>
                                        <?php endif; ?>
                                    </td>

                                    <td title="<?php echo e($categoryListVal->note); ?>">
                                        <?php echo e($categoryListVal->note); ?>

                                    </td>
                                    <td>
                                        <?php echo e($categoryListVal->created_at); ?>

                                    </td>
                                    <td>

                                        <a href="<?php echo e(url('admin/product/category/edit'.'/'.$categoryListVal->id)); ?>"
                                           class="btn btn-success btn-xs white"><i
                                                    class="fa fa-edit white"></i>
                                            <?php echo e(admin_language('common_edit')); ?>

                                        </a>
                                        <a onclick="deleteCategory(<?php echo e($categoryListVal->id); ?>)" href="javascript:;"
                                           class="btn btn-danger btn-xs white delete">
                                            <i class="fa fa-times white"></i>
                                            <?php echo e(admin_language('common_delete')); ?>

                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                            </tbody>
                        </table>

                    </div>
                    <!-- /panel content -->


                </div>
            </div>

            <?php echo $__env->make('admin/common/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </section>

    </div>
</div>

<?php echo $__env->make('admin/common/js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    function deleteCategory(id) {
        layer.confirm('<?php echo e(admin_language('common_areYouDelete')); ?>？', {
            title: ['<?php echo e(admin_language('common_tips')); ?>'],     //提示
            btn: ['<?php echo e(admin_language('common_confirm')); ?>', '<?php echo e(admin_language('common_cancel')); ?>'], //按钮
        }, function () {
            window.location = "<?php echo e(url('admin/product/category/delete')); ?>" + "/" + id
        });
    }
</script>
</body>
</html>