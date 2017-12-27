<?php use App\friendships;
use App\User;?>

<?php $__env->startSection('content'); ?>
<div class="container">

    <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/home')); ?>">Home</a></li>
        <li><a href="<?php echo e(url('/profile')); ?>/<?php echo e(Auth::user()->slug); ?>">Profile</a></li>
        <li><a href="">Friends</a></li>
    </ol>


    <div class="row">
        

<?php //print_r($all_frnds_id);exit; ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo e(Auth::user()->name); ?>, Your Friends</div>

                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                         <?php if( session()->has('msg') ): ?>
                         <p class="alert alert-success">
                                      <?php echo e(session()->get('msg')); ?>

                                   </p>
                                <?php endif; ?>
                             <?php //echo count($friends);exit;
                             if (count($friends) > 0 ){ ?>
                        <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                            <div class="col-md-2 pull-left">
                                <img src="<?php echo e(url('')); ?>/public/img/<?php echo e($uList->pic); ?>" width="80px" height="80px" class="img-rounded"/>
                            </div>
                            <?php
                            $main_uid = Auth::user()->id;
                            $uid = $uList->id;

                            $friends1 = DB::table('friendships')
                            ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
                            ->where('status', 1)
                            ->where('requester', $uid) // who is loggedin
                            ->get();
                            $all_frnds_id1 = [];
                            foreach ($friends1 as $frnd){
                            array_push($all_frnds_id1, $frnd->requester);
                            array_push($all_frnds_id1, $frnd->user_requested);
                            }
                            $friends2 = DB::table('friendships')
                            ->leftJoin('users', 'users.id', 'friendships.requester')
                            ->where('status', 1)
                            ->where('user_requested', $uid)
                            ->get();
                            foreach ($friends2 as $frnd){
                            array_push($all_frnds_id1, $frnd->requester);
                            array_push($all_frnds_id1, $frnd->user_requested);
                            }
                            $all_frnds_id1 = array_unique($all_frnds_id1);
                            //print_r($all_frnds_id1);exit;
                            $friends_ids = array_intersect($all_frnds_id, $all_frnds_id1);
                            $mutualuserData = DB::table('users')
                            ->leftJoin('profiles', 'profiles.user_id','users.id')
                            ->whereIn('user_id', $friends_ids)
                            ->get(); //print_r($mutualuserData);exit;?>
                            <div class="col-md-7 pull-left">
                            <p><b>Mutuals:</b></p>
                           <?php foreach($mutualuserData as $m_u_data){
                               if($m_u_data->user_id != $uid && $m_u_data->user_id != $main_uid){?>
                             <p> <a href="<?php echo e(url('/profile')); ?>/<?php echo e($m_u_data->slug); ?>"><?php echo e(ucwords($m_u_data->name)); ?></a></p>


                            <?php } }?>
                        </div>
                            <div class="col-md-7 pull-left">
                                <h3 style="margin:0px;"><a href="<?php echo e(url('/profile')); ?>/<?php echo e($uList->slug); ?>"><?php echo e(ucwords($uList->name)); ?></a></h3>
                                <p><b>Gender:</b> <?php echo e($uList->gender); ?></p>
                                   <p><b>Email:</b> <?php echo e($uList->email); ?></p>
                            </div>

                            <div class="col-md-3 pull-right">

                                     <p>

                                         <a href="<?php echo e(url('/unfriend')); ?>/<?php echo e($uList->id); ?>"  class="btn btn-default btn-sm">UnFriend</a>

                                     </p>

                            </div>

                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php }
                             elseif (count($friends) <= 0 ){ ?>
                             <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                                 <div class="col-md-2 pull-left">
                                     <h3>No Friends Yet</h3>
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