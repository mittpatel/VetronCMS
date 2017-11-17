<header id="page-header">
    <h1><a href="<?php echo e(url('admin')); ?>" style="color: #1B1819;"><?php echo e(admin_language('common_home')); ?></a></h1>
    <ol class="breadcrumb">
        
        <li><a href="<?php echo e(url('admin/'.session('breadcrumb')['url'])); ?>"><?php echo e(session('breadcrumb')['modular']); ?></a></li>
        <li class="active"><?php echo e(session('breadcrumb')['action']); ?></li>
    </ol>
</header>