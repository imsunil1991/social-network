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
                        <div class="thumbnail">
                            <h3 align="center"><?php echo e(ucwords(Auth::user()->name)); ?></h3>
                            <img src="<?php echo e(url('')); ?>/public/img/<?php echo e(Auth::user()->pic); ?>" width="120px" height="120px" class="img-circle"/>
                            <div class="caption">

                                <p align="center"><?php echo e($data->city); ?> - <?php echo e($data->country); ?></p>
                                <p align="center">  <a href="<?php echo e(url('/')); ?>/changePhoto"  class="btn btn-primary" role="button">Change Image</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">


                        <form action="<?php echo e(url('/updateProfile')); ?>" method="post">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>

                            <div class="col-md-6">

                                <div class="input-group">
                                    <span  id="basic-addon1">City Name</span>
                                    <input type="text" class="form-control" placeholder="City Name" name="city" value="<?php echo e($data->city); ?>">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span  id="basic-addon1">Country Name</span>
                                    <input type="text" class="form-control" placeholder="Country Name" name="country" value="<?php echo e($data->country); ?>">
                                </div>


                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <span  id="basic-addon1">About</span>
                                    <textarea type="text" class="form-control" name="about"><?php echo e($data->about); ?></textarea>
                                </div>

                                <br>

                                <div class="input-group">

                                    <input type="submit" class="btn btn-success pull-right" >
                                </div>
                            </div>

                        </form>






                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('profile.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>