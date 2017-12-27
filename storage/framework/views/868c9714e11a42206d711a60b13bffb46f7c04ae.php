<?php $__env->startSection('content'); ?>



<div class="container">

    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>">Home</a></li>
        <li><a href="<?php echo e(url('/profile')); ?>/<?php echo e(Auth::user()->slug); ?>">Profile</a></li>

    </ol>

    <div class="row">

      
<?php $__currentLoopData = $userData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e($uData->name); ?></div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <h3 align="center"><?php echo e($uData->name); ?></h3>
                                <img src="<?php echo e(url('')); ?>/public/img/<?php echo e($uData->pic); ?>" width="120px" height="120px" class="img-circle"/>
                                <div class="caption">

                                    <p align="center"><?php echo e($uData->city); ?> - <?php echo e($uData->country); ?></p>
                                    <?php if($uData->user_id == Auth::user()->id): ?>
                                    <p align="center"><a href="<?php echo e(url('/editProfile')); ?>"
                                      class="btn btn-primary" role="button">Edit Profile</a></p>
                                      <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <h4 class=""><span class="label label-default">About</span></h4>
                            <p> <?php echo e($uData->about); ?> </p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('profile.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>