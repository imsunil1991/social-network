<?php $__env->startSection('content'); ?>

<div class="container">

    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>">Home</a></li>
        <li><a href="<?php echo e(url('/profile')); ?>/<?php echo e(Auth::user()->slug); ?>">Profile</a></li>
        <li><a href="">Find Friends</a></li>
    </ol>


    <div class="row">
        


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(Auth::user()->name); ?>

                    <div class="panel-heading pull-right" style="padding-top: 0px;">
                    <form method="get"/>
                        <input id="search" type ="text" name="search_text" value=""/>
                        <input  type="submit" onclick="function_findfrends(this)" value="Search"/>

                    </form>
                    </div>
                </div>


                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                        <?php //echo count($FriendRequests);exit;
                        if (count($allUsers) > 0 ){ ?>
                        <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                            <div class="col-md-2 pull-left">
                                <img src="<?php echo e(url('')); ?>/public/img/<?php echo e($uList->pic); ?>"
                                width="80px" height="80px" class="img-rounded"/>
                            </div>

                            <div class="col-md-7 pull-left">
                                <h3 style="margin:0px;"><a href="<?php echo e(url('/profile')); ?>/<?php echo e($uList->slug); ?>">
                                  <?php echo e(ucwords($uList->name)); ?></a></h3>
                                <p><i class="fa fa-globe"></i> <?php echo e($uList->city); ?>  - <?php echo e($uList->country); ?></p>
                                <p><?php echo e($uList->about); ?></p>

                            </div>

                            <div class="col-md-3 pull-right">

                                <?php
                                $check = DB::table('friendships')
                                        ->where('user_requested', '=', $uList->id)
                                        ->where('requester', '=', Auth::user()->id)
                                        ->first();

                                if($check ==''){
                                ?>
                                   <p>
                                        <a href="<?php echo e(url('/')); ?>/addFriend/<?php echo e($uList->id); ?>"
                                           class="btn btn-info btn-sm">Add to Friend</a>
                                    </p>
                                <?php } else {?>
                                    <p>Request Already Sent</p>
                                <?php }?>
                            </div>

                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php }
                             elseif (count($allUsers) <= 0 ){ ?>
                            <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                <div class="col-md-6 pull-left">
                                    <h3>No Users Found</h3>
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