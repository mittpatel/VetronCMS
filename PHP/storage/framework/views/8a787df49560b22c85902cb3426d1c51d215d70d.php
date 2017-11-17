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
                                <a href="<?php echo e(url('admin/gallery/category/add')); ?>" style="margin-top: 5px;"
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

                        <div class="row">

                            <!-- LEFT -->
                            <div class="col-md-12">

                                <div class="row">
                                    <?php if($pid!=0): ?>
                                        <div class="col-md-2">
                                            <div style="position: relative" class="pricing-table see_gallery">
                                                <a href="<?php echo e(url('admin/gallery/category')); ?>?p=<?php echo e($ppId); ?>">
                                                    <div>
                                                        <img style="width: 100%;"
                                                             src="<?php echo e(asset('uploads/gallery/back.png')); ?>">
                                                    </div>
                                                </a>

                                            </div>
                                            <div class="plan-title none_back">
                                                <?php echo e(home_language($categoryListVal->language_key)); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryListVal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                        <div class="col-md-2">
                                            <div style="position: relative" class="pricing-table see_gallery">
                                                <a href="<?php if($categoryListVal->isTop==1): ?><?php echo e(url('admin/gallery/category')); ?>?p=<?php echo e($categoryListVal->id); ?><?php else: ?> <?php echo e(url('admin/gallery')); ?>?c=<?php echo e($categoryListVal->id); ?> <?php endif; ?>">
                                                    <div>
                                                        <img style="width: 100%;"
                                                             src="<?php echo e(asset($categoryListVal->cover)); ?>">
                                                    </div>
                                                </a>
                                                <div class="edit-edit" style="display: none">
                                                    <div class="hide_action plan-title"
                                                         style="width:100%;position: absolute;bottom: 0;display: flex;justify-content: space-around;">
                                                <span class=""><a style="color: #000;cursor: pointer;"
                                                                  href="<?php echo e(url('admin/gallery/category/edit')); ?>/<?php echo e($categoryListVal->id); ?>"><i
                                                                id="26" class="fa fa-pencil type_edit"></i></a></span>
                                                        <span class=""><i id="26" style="cursor: pointer;"
                                                                          class="fa fa-trash"
                                                                          onclick="deleteCategory(<?php echo e($categoryListVal->id); ?>)"></i></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="plan-title none_back">
                                                <?php echo e(home_language($categoryListVal->language_key)); ?>


                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


                                </div>


                            </div>


                        </div>

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
            window.location = "<?php echo e(url('admin/gallery/category/delete')); ?>" + "/" + id
        });
    }
    $(".see_gallery").mouseenter(function () {
        $(this).find(".edit-edit").show();
    }).mouseleave(function () {
        $(".edit-edit").hide();
    });
</script>
</body>
</html>