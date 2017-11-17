<!doctype html>
<html lang="en-US">
<?php echo $__env->make('admin/common/head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body>

<div class="container">
    <div id="wrapper" class="clearfix">

        <?php echo $__env->make('admin/common/nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('admin/common/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <section id="middle">
            <?php echo $__env->make('admin/common/crumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div id="content" class="dashboard padding-20">

                <div class="row">

                    <div class="col-md-12">

                        <!-- ------ -->
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-transparent">
                                <strong><?php echo e(admin_language('theme_InputData')); ?></strong>
                            </div>

                            <div class="panel-body">

                                <form method="post" enctype="multipart/form-data">
                                    <fieldset>
                                        <?php echo e(csrf_field()); ?>


                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12">
                                                    <textarea name="contentText" class="form-control"
                                                              rows="20"><?php echo e($content); ?></textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-primary"><?php echo e(admin_language('common_submit')); ?></button>
                                            </div>
                                        </div>
                                    </fieldset>


                                    <input type="hidden" name="path" value="<?php echo e($path); ?>">
                                </form>

                            </div>

                        </div>
                        <!-- /----- -->

                    </div>


                </div>


            </div>

            <?php echo $__env->make('admin/common/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </section>

    </div>
</div>

<?php echo $__env->make('admin/common/js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>