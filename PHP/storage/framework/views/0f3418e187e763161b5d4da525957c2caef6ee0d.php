<header id="header">

    <!-- Mobile Button -->
    <button id="mobileMenuBtn"></button>

    <!-- Logo -->
    <span class="pull-left logo-text">
        <?php echo e(config('aSetting.admin_Name')); ?>

    </span>

    <!--<form method="get" action="" class="search pull-left hidden-xs">
        <button type="button"><i class="fa fa-search"></i></button>
        <input type="text" class="form-control" name="k" placeholder="Search for something..."/>
    </form>-->

    <nav>
        <ul class="nav pull-right">
            <li class="dropdown pull-left">
                <a style="line-height: 50px;" href="<?php echo e(url('/')); ?>" target="_blank" class="dropdown-toggle">

								<span class="user-name">
									<span class="hidden-xs">
										<?php echo e(admin_language('top_Website')); ?> &nbsp; |
									</span>
								</span>
                </a>
            </li>
            <li class="dropdown pull-left">
                <a href="javascript:;" style="line-height: 50px;" class="dropdown-toggle" data-toggle="dropdown"
                   data-hover="dropdown"
                   data-close-others="true" aria-expanded="false">
                    <span class="user-name">
                        <span class="hidden-xs">
                            <?php echo e(admin_language('top_changeLanguage')); ?><i class="fa fa-angle-down"></i>
                        </span>
                    </span>
                </a>

                <ul class="dropdown-menu hold-on-click">
                    <?php $__currentLoopData = $GLOBALS['languageList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $languageListVal): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <li><a href="<?php echo e(url('admin/setting/setLanguage',[$languageListVal->folder])); ?>">&nbsp;&nbsp;<?php echo e(admin_language($languageListVal->language_key)); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                </ul>
            </li>

        </ul>

    </nav>

</header>