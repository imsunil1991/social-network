<?php $__env->startSection('content'); ?>
<div class="container">

    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>">Home</a></li>
        <li><a href="<?php echo e(url('/profile')); ?>/<?php echo e(Auth::user()->slug); ?>">Profile</a></li>
        <li><a href="">Edit Profile</a></li>
    </ol>


    <div class="row">
        


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(Auth::user()->name); ?></div>

                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                         <?php if( session()->has('msg') ): ?>
                         <p class="alert alert-success">
                                      <?php echo e(session()->get('msg')); ?>

                                   </p>
                                <?php endif; ?>
                        <?php //echo count($FriendRequests);exit;
                        if (count($FriendRequests) > 0 ){ ?>
                        <?php $__currentLoopData = $FriendRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                            <div class="col-md-2 pull-left">
                                <img src="<?php echo e(url('')); ?>/public/img/<?php echo e($uList->pic); ?>" width="80px" height="80px" class="img-rounded"/>
                            </div>

                            <div class="col-md-7 pull-left">
                                <h3 style="margin:0px;"><a href=""><?php echo e(ucwords($uList->name)); ?></a></h3>

                                <p><b>Gender:</b> <?php echo e($uList->gender); ?></p>
                                <p><b>Mutual Friends:</b> <?php echo e($uList->gender); ?></p>
                                   <p><b>Email:</b> <?php echo e($uList->email); ?></p>

                            </div>

                            <div class="col-md-3 pull-right">

                                     <p>
                                        <a href="<?php echo e(url('/accept')); ?>/<?php echo e($uList->name); ?>/<?php echo e($uList->id); ?>"  class="btn btn-info btn-sm">Confirm</a>

                                         <a href="<?php echo e(url('/requestRemove')); ?>/<?php echo e($uList->id); ?>"  class="btn btn-default btn-sm">Remove</a>

                                     </p>

                            </div>

                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php }
                     elseif (count($FriendRequests) <= 0 ){ ?>
                                 <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                     <div class="col-md-6 pull-left">
                                         <h3>No Requests Avaialable</h3>
                                     </div>
                                 </div>
                    <?php } ?>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('profile.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>