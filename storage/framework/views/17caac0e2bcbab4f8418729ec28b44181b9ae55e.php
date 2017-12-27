<?php $__env->startSection('content'); ?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>">Home</a></li>


    </ol>

    <div class="row">

         


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>


            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('profile.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>