<?php $__env->startSection('content'); ?>

<div class="container">
    
     <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>">Home</a></li>
        <li><a href="<?php echo e(url('/profile')); ?>/<?php echo e(Auth::user()->slug); ?>">Profile</a></li>
         <li><a href="<?php echo e(url('/editProfile')); ?>">Edit Profile</a></li>
        <li><a href="">Change Image</a></li>
    </ol>
    
    
    <div class="row">
        
     
            
        
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(Auth::user()->name); ?></div>

                <div class="panel-body">
                    
                    <div class="col-md-4">
                        Welcome to your profile
                        
                        <img src="<?php echo e(url('')); ?>/public/img/<?php echo e(Auth::user()->pic); ?>" width="100px" height="100px"/><br>
                        <br>
                        <hr>
                        
                        
                        <form action="<?php echo e(url('/')); ?>/uploadPhoto" method="post" enctype="multipart/form-data">
                            
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"/>
                            <input type="file" name="pic" class="form-control"/>
                            
                            <input type="submit" class="btn btn-success" name="btn"/>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('profile.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>