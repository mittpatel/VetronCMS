<aside id="aside">

    <div class="userinfo">
        <div class="avatar">
            <a href="<?php echo e(url('admin/profile')); ?>">
                <img src="<?php echo e(asset(session('vetronCmsLogin')->header)); ?>" class="img-responsive img-circle"
                     alt="Jellal Scarlet">
            </a>
        </div>
        <div class="info">
            <span class="username"><?php echo e(session('vetronCmsLogin')->name); ?></span>
            <br>
            <span class="useremail"><?php echo e(session('vetronCmsLogin')->email); ?></span>
        </div>
    </div>
    <nav id="sideNav">
        <ul class="nav nav-list">
            <li class="<?php if($other['navActive']=='/'): ?> active <?php endif; ?>">
                <a class="dashboard" href="<?php echo e(url('/admin')); ?>">
                    <i class="main-icon fa fa-dashboard"></i> <span><?php echo e(admin_language('menu_home')); ?></span>
                </a>
            </li>
            <?php $__currentLoopData = $GLOBALS['menuDate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$menu): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <?php if($menu->p_id==0): ?>
                    <li class="<?php if($other['navActive']==$menu->active): ?> active <?php endif; ?>">
                        <a href="<?php if($menu->route=='javascript'): ?> javascript:; <?php endif; ?>">
                            <i class="fa fa-menu-arrow pull-right"></i>
                            <i class=" main-icon <?php echo e($menu->icon); ?>"></i>
                            <span><?php echo e(admin_language($menu->language_key)); ?></span>
                        </a>
                        <ul>
                            <?php $__currentLoopData = $GLOBALS['menuDate']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_son=>$menu_son): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <?php if($menu->id==$menu_son->p_id): ?>
                                    <?php if($menu_son->auth=='admin/plugin'): ?>
                                        
                                    <?php endif; ?>
                                    <li class="<?php if($menu_son->active==$other['navActiveSon']): ?> active <?php endif; ?>">
                                        <a href="<?php echo e(url($menu_son->route)); ?>"><?php echo e(admin_language($menu_son->language_key)); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


        </ul>

        <h3><?php echo e(admin_language('common_more')); ?></h3>
        <ul class="nav nav-list">
            <li class="<?php if($other['navActive']=='navProfile'): ?> active <?php endif; ?>">
                <a href="<?php echo e(url('admin/profile')); ?>">
                    <i class="main-icon fa fa-user"></i>
                    <span><?php echo e(admin_language('menu_profile')); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(url('admin/logout')); ?>">
                    <i class="main-icon fa fa-sign-out"></i>
                    <span><?php echo e(admin_language('menu_logout')); ?></span>
                </a>
            </li>
        </ul>

    </nav>

    <span id="asidebg"><!-- aside fixed background --></span>
</aside>