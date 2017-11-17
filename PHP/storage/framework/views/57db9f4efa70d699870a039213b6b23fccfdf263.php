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
                <div id="panel-1" class="panel panel-default">
                    <div class="panel-heading">
							<span class="title elipsis">
								<strong><?php echo e(admin_language('common_lists')); ?></strong>
							</span>

                        <ul class="options pull-right list-inline">

                            <li>
                                <a href="<?php echo e(url('admin/setting/language/add')); ?>"
                                   style="margin-top: 5px;" class="btn btn-primary btn-xs white fa fa-plus"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="">
                                    <?php echo e(admin_language('common_add')); ?>

                                </a>
                            </li>
                            <li>
                                <a href="#" class="opt panel_colapse" data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Colapse"></a>
                            </li>
                            <li>
                                <a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title=""
                                   data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a>
                            </li>
                            <li>
                                <a href="#" class="opt panel_close" data-confirm-title="Confirm"
                                   data-confirm-message="Are you sure you want to remove this panel?"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Close"><i
                                            class="fa fa-times"></i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table" id="datatable_sample">
                                <thead>
                                <tr>
                                    <th><?php echo e(admin_language('language_language')); ?></th>
                                    <th><?php echo e(admin_language('common_status')); ?></th>
                                    <th><?php echo e(admin_language('language_module')); ?></th>
                                    <th></th>
                                    <th style="width: 260px;"><?php echo e(admin_language('common_action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="background-color: #E8E8E8;">
                                    <td colspan="5"
                                        style="font-size: 16px;"><?php echo e(admin_language('language_frontDesk')); ?></td>
                                </tr>
                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($value->modular==1): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                                <?php echo e(admin_language($value->language_key)); ?>

                                            </td>
                                            <td>
                                                <label class="switch switch-success switch-round">
                                                    <input value="<?php echo e($value->name); ?>" class="checkbox_status"
                                                           onchange="changeStatus(<?php echo e($value->id); ?>)" type="checkbox"
                                                           <?php if($value->status==1): ?> checked <?php endif; ?>>
                                                    <span class="switch-label" data-on="on" data-off="off"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <?php echo e(admin_language('language_frontDesk')); ?>

                                            </td>
                                            <td>
                                                <?php if(env('HOME_LOCALE')==$value->folder): ?>
                                                    <?php echo e(admin_language('lang_Default')); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(env('HOME_LOCALE')!=$value->folder): ?>
                                                    <a onclick="activeLang(this,'<?php echo e($value->id); ?>')"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-filter white"></i>
                                                        <?php echo e(admin_language('_langSetAsDefault')); ?>

                                                    </a>
                                                    <a href="<?php echo e(url('admin/setting/language/edit',[$value->folder,$value->file_name])); ?>"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-edit white"></i>
                                                        <?php echo e(admin_language('common_edit')); ?>

                                                    </a>
                                                    <a dataId="<?php echo e($value->id); ?>" onclick="deleteLanguage(this)"
                                                       href="javascript:;" data-id="1"
                                                       class="btn btn-danger btn-xs white delete">
                                                        <i class="fa fa-times white"></i>
                                                        <span><?php echo e(admin_language('common_delete')); ?></span>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(url('admin/setting/language/edit',[$value->folder,$value->file_name])); ?>"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-edit white"></i>
                                                        <?php echo e(admin_language('common_edit')); ?>

                                                    </a>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                                <tr style="background-color: #E8E8E8;">
                                    <td colspan="5"
                                        style="font-size: 16px;"><?php echo e(admin_language('language_backstage')); ?></td>
                                </tr>

                                <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php if($value->modular==2): ?>
                                        <tr class="odd gradeX">
                                            <td>
                                                <?php echo e(admin_language($value->language_key)); ?>

                                            </td>
                                            <td>
                                                <label class="switch switch-success switch-round">
                                                    <input value="<?php echo e($value->name); ?>" class="checkbox_status"
                                                           onchange="changeStatus(<?php echo e($value->id); ?>)" type="checkbox"
                                                           <?php if($value->status==1): ?> checked <?php endif; ?>>
                                                    <span class="switch-label" data-on="on" data-off="off"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <?php echo e(admin_language('language_backstage')); ?>

                                            </td>
                                            <td>
                                                <?php if(env('ADMIN_LOCALE')==$value->folder): ?>
                                                    <?php echo e(admin_language('lang_Default')); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(env('ADMIN_LOCALE')!=$value->folder): ?>

                                                    <a onclick="activeLang(this,'<?php echo e($value->id); ?>')"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-filter white"></i>
                                                        <?php echo e(admin_language('_langSetAsDefault')); ?>

                                                    </a>

                                                    <a href="<?php echo e(url('admin/setting/language/edit',[$value->folder,$value->file_name])); ?>"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-edit white"></i>
                                                        <?php echo e(admin_language('common_edit')); ?>

                                                    </a>
                                                    <a dataId="<?php echo e($value->id); ?>" onclick="deleteLanguage(this)"
                                                       href="javascript:;" data-id="1"
                                                       class="btn btn-danger btn-xs white delete">
                                                        <i class="fa fa-times white"></i>
                                                        <?php echo e(admin_language('common_delete')); ?>

                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(url('admin/setting/language/edit',[$value->folder,$value->file_name])); ?>"
                                                       class="btn btn-success btn-xs white"><i
                                                                class="fa fa-edit white"></i>
                                                        <?php echo e(admin_language('common_edit')); ?>

                                                    </a>
                                                <?php endif; ?>
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

    function deleteLanguage(e) {
        var id = $(e).attr('dataId');
        layer.confirm('<?php echo e(admin_language('common_areYouDelete')); ?>？', {
            title: ['<?php echo e(admin_language('common_tips')); ?>'],     //提示
            btn: ['<?php echo e(admin_language('common_confirm')); ?>', '<?php echo e(admin_language('common_cancel')); ?>'], //按钮
        }, function () {
            window.location = "<?php echo e(url('admin/setting/language/delete')); ?>" + "/" + id
        });
    }

    function changeStatus(e) {
        var ajaxStatus = layer.load();
        $.ajax({
            type: 'GET',
            url: "<?php echo e(url('admin/setting/language/status')); ?>" + '/' + e,
            success: function (data) {
                data = $.parseJSON(data);
                if (data.status == 1) {
                    layer.close(ajaxStatus);
                }
            }
        });
    }

    function activeLang(e, id) {
        layer.confirm('<?php echo e(admin_language('lang_AreYouSureYouWa')); ?>？', {
            title: ['<?php echo e(admin_language('common_tips')); ?>'],     //提示
            btn: ['<?php echo e(admin_language('common_confirm')); ?>', '<?php echo e(admin_language('common_cancel')); ?>'], //按钮
        }, function () {
            window.location  = "<?php echo e(url('admin/setting/language/active')); ?>" + '/' + id;
        });
    }
</script>
</body>
</html>