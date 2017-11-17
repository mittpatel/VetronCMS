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
<script>
    var updateData = new Array();
</script>
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
                                <a href="<?php echo e(url('admin/plugin/store')); ?>"
                                   style="margin-top: 5px;" class="btn btn-primary btn-xs white fa fa-shopping-cart"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="">
                                    
                                    <?php echo e(admin_language('plugin_PluginStore')); ?>

                                </a>
                            </li>

                            <li>
                                <a href="javascript:;" onclick="DetectionUpdate(1);"
                                   style="margin-top: 5px;" class="btn btn-danger btn-xs white fa fa-refresh"
                                   data-toggle="tooltip" title="" data-placement="bottom" data-original-title="">
                                    
                                    <?php echo e(admin_language('plugin_CheckForUpdates')); ?>

                                </a>
                            </li>

                        </ul>
                    </div>


                    
                    <?php if(count($pluginList['enabled'])==0 && count($pluginList['uninstalled'])==0 && count($pluginList['unenabled'])==0): ?>
                        <div class="panel-title">
                            <h6 class="page-header">
                                <i class="fa fa-refresh text-success"></i>
                                <?php echo e(admin_language('plugin_ThereIsNoDownlo')); ?>

                            </h6>
                        </div>
                    <?php endif; ?>

                    <?php if(count($pluginList['enabled'])>0): ?>
                        <div class="panel-title">
                            
                            <h6 class="page-header">
                                <i class="fa fa-check-square text-success"></i>
                                <?php echo e(admin_language('plugin_EnabledPlugins')); ?>

                            </h6>
                        </div>

                        <div class="panel-body">
                            
                            <?php $__currentLoopData = $pluginList['enabled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$plugin): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                <div class="clearfix search-result"><!-- item -->
                                    <img src="<?php echo e(plugin_assets($plugin->name,$plugin->avatar)); ?>" class="plugin_avater"/>
                                    <h4><?php echo e($plugin->title); ?> <?php echo e($plugin->version); ?> (<?php echo e($plugin->name); ?>)</h4>
                                    
                                    <p class="plugin_athor">
                                        <?php echo e(admin_language('plugin_Author')); ?>：<?php echo e($plugin->author); ?>

                                        &nbsp;&nbsp | &nbsp
                                        <a target="_blank"
                                           href="<?php echo e(url("admin/plugin/action",["score",$plugin->name])); ?>">
                                            <?php echo e(admin_language('plugin_Score')); ?>

                                        </a>
                                        
                                        <a target="_blank"
                                           href="<?php echo e(url("admin/plugin/action",["report",$plugin->name])); ?>"
                                           class="plugin-text-right">
                                            <?php echo e(admin_language('plugin_Report')); ?>

                                        </a>
                                    </p>
                                    <p class="update_<?php echo e($plugin->name); ?> update_update_">
                                        
                                        <?php echo e(admin_language('index_version')); ?> :
                                        <?php echo e($plugin->version); ?>

                                        <span style="color: red;">
                                        </span>
                                    </p>
                                    <script>
                                        updateData.push({
                                            version: "<?php echo e($plugin->version); ?>",
                                            name: "<?php echo e($plugin->name); ?>",
                                            elClass: "update_<?php echo e($plugin->name); ?>"
                                        });
                                    </script>

                                    <p class="plugin-settting">

                                        <span>
                                            <?php $__currentLoopData = $plugin['setting']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$s): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <a target="_blank"
                                                   href="<?php echo e(url($s)); ?>"><?php echo e(plugin_trans($plugin->name,$k)); ?></a>
                                                <?php if(end($plugin['setting'])!=$s): ?>| <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </span>


                                        <span class="plugin-text-right">
                                            
                                            <a onclick="actionPlugin('<?php echo e(url("admin/plugin/action",["disable",$plugin->name])); ?>')"
                                               href="javascript:;"><?php echo e(admin_language('plugin_Disable')); ?></a> &nbsp;
                                            
                                            <a onclick="actionPlugin('<?php echo e(url("admin/plugin/action",["update",$plugin->name])); ?>')"
                                               href="javasxript:;"><?php echo e(admin_language('plugin_ToUpdate')); ?></a>

                                        </span>
                                    </p>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </div>

                    <?php endif; ?>


                    <?php if(count($pluginList['unenabled'])>0): ?>
                        <div class="panel-title">
                            <h6 class="page-header">
                                <i class="fa fa-circle text-warning"></i>
                                <?php echo e(admin_language('plugin_PluginsNotEnabl')); ?>

                            </h6>
                        </div>

                        <div class="panel-body">
                            
                            <?php $__currentLoopData = $pluginList['unenabled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$plugin): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                <div class="clearfix search-result"><!-- item -->
                                    <img src="<?php echo e(plugin_assets($plugin->name,$plugin->avatar)); ?>" class="plugin_avater"/>
                                    <h4><?php echo e($plugin->title); ?> <?php echo e($plugin->version); ?> (<?php echo e($plugin->name); ?>)</h4>
                                    <p class="plugin_athor"><?php echo e(admin_language('plugin_Author')); ?>：<?php echo e($plugin->author); ?>

                                        &nbsp;&nbsp; | &nbsp; <a target="_blank"
                                                                 href="<?php echo e(url("admin/plugin/action",["score",$plugin->name])); ?>">
                                            <?php echo e(admin_language('plugin_Score')); ?>

                                        </a>
                                        
                                        <a target="_blank"
                                           href="<?php echo e(url("admin/plugin/action",["report",$plugin->name])); ?>"
                                           class="plugin-text-right">
                                            <?php echo e(admin_language('plugin_Report')); ?>

                                        </a>
                                    </p>
                                    <p class="update_<?php echo e($plugin->name); ?> update_update_">
                                        
                                        <?php echo e(admin_language('index_version')); ?> :
                                        <?php echo e($plugin->version); ?>

                                        <span style="color: red;">
                                        </span>
                                    </p>
                                    <script>
                                        updateData.push({
                                            version: "<?php echo e($plugin->version); ?>",
                                            name: "<?php echo e($plugin->name); ?>",
                                            elClass: "update_<?php echo e($plugin->name); ?>"
                                        });
                                    </script>
                                    <p class="plugin-settting">
                                        <span class="plugin-text-right">
                                            <a onclick="actionPlugin('<?php echo e(url("admin/plugin/action",["enable",$plugin->name])); ?>')"
                                               href="javascript:;">
                                                <?php echo e(admin_language('plugin_Enable')); ?>

                                            </a> &nbsp;
                                            <a onclick="actionPlugin('<?php echo e(url("admin/plugin/action",["update",$plugin->name])); ?>')"
                                               href="javascript:;">
                                                <?php echo e(admin_language('plugin_ToUpdate')); ?>

                                            </a> &nbsp;
                                            <a onclick="actionPlugin('<?php echo e(url("admin/plugin/action",["uninstall",$plugin->name])); ?>')"
                                               href="javascript:;">
                                                <?php echo e(admin_language('plugin_Uninstall')); ?>

                                            </a>
                                        </span>
                                    </p>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                        </div>
                    <?php endif; ?>

                    <?php if(count($pluginList['uninstalled'])>0): ?>
                        <div class="panel-title">
                            
                            <h6 class="page-header"><i
                                        class="fa fa-circle text-danger"></i><?php echo e(admin_language('plugin_PluginsNotInsta')); ?>

                            </h6>
                        </div>

                        <div class="panel-body">
                            
                            <?php $__currentLoopData = $pluginList['uninstalled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$plugin): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

                                <div class="clearfix search-result"><!-- item -->
                                    <img src="<?php echo e(plugin_assets($plugin->name,$plugin->avatar)); ?>" class="plugin_avater"/>
                                    <h4><?php echo e($plugin->title); ?> <?php echo e($plugin->version); ?> (<?php echo e($plugin->name); ?>)</h4>
                                    <p class="plugin_athor"><?php echo e(admin_language('plugin_Author')); ?>：<?php echo e($plugin->author); ?>

                                        <a onclick="actionPlugin('<?php echo e(url("admin/plugin/action",["install",$plugin->name])); ?>')"
                                           href="javascript:;"
                                           class="plugin-text-right"><?php echo e(admin_language('plugin_Install')); ?></a></p>

                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                        </div>

                    <?php endif; ?>
                </div>

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
            window.location = url
        });

    }
</script>
<script>
    function DetectionUpdate(ii) {
        if(ii==1){
            layer.load();
        }
        $.ajax({
            type: 'GET',
            url: "<?php echo e(trim(CMS_DEVELOPER,'/').'/'.'detection/update'); ?>",
            data: {data: updateData, type: 'plugin'},
            dataTypr: 'json',
            success: function (data) {
                layer.closeAll('loading');
                for (var i in data) {
                    if (data[i].status == 1) {
                        $("." + data[i].elClass).find('span').html(data[i].msg);
                    }
                }
            },
        });
    }
    DetectionUpdate(2);

</script>
</body>
</html>