<!doctype html>
<html lang="en-US">
<?php echo $__env->make('admin/common/head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style>
	.myclass{
		border: 1px solid #DDDDDD;
		margin-right: 20px;
	}
	.list-unstyled li{
		line-height: 30px;
	}
	
	.myul{
		
		margin-bottom: 10px;
	}
	
	.list-unstyled > .mydescribe{
		line-height: none;
	}
</style>
<body>

<div class="container">
    <div id="wrapper" class="clearfix">

        <?php echo $__env->make('admin/common/nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php echo $__env->make('admin/common/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <section id="middle">
            <?php echo $__env->make('admin/common/crumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div id="content" class="padding-20">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: white;">
							<span class="title elipsis">
								<strong><?php echo e(admin_language('common_lists')); ?></strong> <!-- panel title -->
							</span>

                        <ul class="options pull-right list-inline">
                            <li class="">

                                <a href="<?php echo e(url('admin/setting/theme/add')); ?>" style="margin-top: 5px;" class="btn btn-primary btn-xs white"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="">
                                    <i class="glyphicon glyphicon-open"></i>上传</a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('admin/theme/store')); ?>"
                                   style="margin-top: 5px;" class="btn btn-primary btn-xs"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    <?php echo e(admin_language('theme_store')); ?>

                                </a>
                            </li>
                        </ul>

                    </div>

                </div>
                <?php $__currentLoopData = $themeList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $themeListVal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <div class="col-md-4" style="padding: 0;">

                        <div id="panel-misc-portlet-l4" class="panel panel-default myclass">
                            <div class="panel-heading">
									<span class="elipsis">
										<strong><?php echo e($themeListVal->themeInformation->name); ?></strong>
									</span>
                                <span style="color: #909090;">
                                    <?php if(!$themeListVal->status): ?>
                                        
                                        <?php echo e(admin_language('theme_notInstalled')); ?>

                                    <?php elseif($themeListVal->status==1): ?>
                                        
                                        <span style="color: #007600;"><?php echo e(admin_language('common_active')); ?></span>
                                    <?php elseif($themeListVal->status==2): ?>
                                        
                                        <?php echo e(admin_language('theme_notEnabled')); ?>

                                    <?php endif; ?>
                                </span>

                                
                                <ul class="options pull-right relative list-unstyled">
                                    <li>
                                        <a href="<?php echo e(url('admin/setting/theme',[$themeListVal->onlyFolder])); ?>"
                                           class="btn btn-success btn-xs white">
                                            <i class="fa fa-edit white"></i>
                                            
                                            <?php echo e(admin_language('common_edit')); ?>

                                        </a>
                                    </li>
                                    <?php if(!$themeListVal->status): ?>
                                        <li>
                                            <a onclick="actionTheme('install','<?php echo e($themeListVal->onlyFolder); ?>')" href="#"
                                               class="btn btn-success btn-xs white">
                                                <i class="fa fa-filter white"></i>
                                                
                                                <?php echo e(admin_language('theme_install')); ?>

                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="actionTheme('delete','<?php echo e($themeListVal->onlyFolder); ?>')"
                                               class="btn btn-danger btn-xs white">
                                                <i class="fa fa-times"></i>
                                                
                                                <?php echo e(admin_language('common_delete')); ?>

                                            </a>
                                        </li>
                                    <?php elseif($themeListVal->status==2): ?>
                                        <li>
                                            <a href="#" onclick="actionTheme('enable','<?php echo e($themeListVal->onlyFolder); ?>')"
                                               class="btn btn-success btn-xs white">
                                                <i class="fa fa-filter white"></i>
                                                
                                                <?php echo e(admin_language('theme_enable')); ?>

                                            </a>
                                        </li>
                                        <?php if($themeListVal->config->themeRootPath!='default'): ?>
                                            <li>
                                                <a href="#"
                                                   onclick="actionTheme('uninstall','<?php echo e($themeListVal->onlyFolder); ?>')"
                                                   class="btn btn-danger btn-xs white">
                                                    <i class="fa fa-times"></i>
                                                    
                                                    <?php echo e(admin_language('theme_Uninstall')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>

                                    <?php endif; ?>

                                </ul>
                                
                            </div>
                            <!-- panel content -->
                            <div class="panel-body">
                                <img style="width: 100%;"
                                     src="<?php echo e(asset('template/home/'.$themeListVal->config->themeRootPath.'/'.$themeListVal->config->preview)); ?>">
                            </div>
                            
                            <div class="panel-body" style="min-height: 215px;">
                            	<h4><strong><?php echo e(admin_language('theme_TemplateName')); ?>：</strong> <?php echo e($themeListVal->themeInformation->name); ?></h4>
								<ul class="list-unstyled myul">
									<li><strong><?php echo e(admin_language('theme_Edition')); ?>:</strong> <?php echo e($themeListVal->themeInformation->version); ?></li>
									<li><strong><?php echo e(admin_language('theme_Author')); ?>:</strong> <?php echo e($themeListVal->themeInformation->author); ?></li>
									<li><strong><?php echo e(admin_language('theme_Date')); ?>:</strong> <?php echo e($themeListVal->themeInformation->date); ?></li>
									<li style="line-height: 15px;max-height: 45px;min-height: 45px;overflow: hidden;"><strong><?php echo e(admin_language('theme_Describe')); ?>:</strong> <?php echo e($themeListVal->themeInformation->describe); ?>...</li>
								</ul>
								<div class="panel-body">
	                            	<a href="<?php echo e(url('admin/setting/theme/delete/cache')); ?>" class="btn btn-danger btn-xs white">
	                                    <i class="fa fa-times"></i>
	                                    	<?php echo e(admin_language('theme_WipeCache')); ?>

	                                </a>
	                            </div>
                            </div>                            
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

            </div>

            <?php echo $__env->make('admin/common/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </section>

    </div>
</div>

<?php echo $__env->make('admin/common/js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>

    function actionTheme(a, e) {
        /*确认要执行此操作吗*/
        layer.confirm('<?php echo e(admin_language('theme_areYouSureYouWantToPerformThisOperation')); ?>', {
            title: ['<?php echo e(admin_language('common_tips')); ?>'],     //提示
            btn: ['<?php echo e(admin_language('common_confirm')); ?>', '<?php echo e(admin_language('common_cancel')); ?>'], //按钮
        }, function () {
            window.location = "<?php echo e(url('admin/setting/theme/action')); ?>?action=" + a + "&theme=" + e
        });
    }

</script>
</body>
</html>