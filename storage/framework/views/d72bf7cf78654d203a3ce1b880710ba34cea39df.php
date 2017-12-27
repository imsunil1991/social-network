<?php $__env->startSection('content'); ?>

<div class="container">

    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>">Home</a></li>
        <li><a href="<?php echo e(url('/profile')); ?>/<?php echo e(Auth::user()->slug); ?>">Profile</a></li>
        <li><a href="">Jobs</a></li>
    </ol>


    <div class="row">
        <?php echo $__env->make('profile.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h4><span style="color:green"><?php echo e(ucwords(Auth::user()->name)); ?></span>, Jobs you may be interested in</h4>Any location Selected industries:  Any industry Selected company size range:  1 to 1,000 employees         </div>

                <div class="panel-body">
                         <?php if( session()->has('msg') ): ?>
                         <p class="alert alert-success">
                                      <?php echo e(session()->get('msg')); ?>

                                   </p>
                                <?php endif; ?>
                  <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="jobDiv">
                     <a href="<?php echo e(url('job')); ?>/<?php echo e($job->id); ?>">
                      <img src="<?php echo e(Config::get('app.url')); ?>/public/img/<?php echo e($job->pic); ?>" class="img-circle company_pic" >
                        <div class="caption">
                        <li><i class="fa fa-briefcase" aria-hidden="true"></i> <?php echo e($job->job_title); ?> </li>

                        <li><i class="fa fa-building-o" aria-hidden="true"></i> <?php echo e(ucwords($job->name)); ?></li>
                      </a>
                                <li> <?php $skills = explode(',',$job->skills)?>
                                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div style="background-color:#283E4A; color:#fff; margin-top:5px; border-radius:10px; width:100%; float:left; padding:3px 15px 3px 15px"><?php echo e($skill); ?></div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  <a href="<?php echo e(url('job')); ?>/<?php echo e($job->id); ?>" style="margin-top:10px; width:100%" class="btn btn-primary">View details</a>
                                </li>
                                </div>
                          </div>




                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('profile.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>