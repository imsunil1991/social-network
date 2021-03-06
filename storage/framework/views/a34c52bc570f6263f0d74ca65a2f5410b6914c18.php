<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://use.fontawesome.com/595a5020bd.js"></script>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

<style>
.left-sidebar li { padding:10px;
  border-bottom:1px solid #ddd;
list-style:none; margin-left:-20px}
.msgDiv li:hover{
  cursor:pointer;
}
.jobDiv{border:1px solid #ddd; margin:10px; width:30%; float:left; padding:10px; color:#000}
.caption li {list-style:none !important; padding:5px}
.jobDiv .company_pic{width:50px; height:50px; margin:5px}
.jobDetails h4{border:1px solid green; width:60%;
padding:5px; margin:0 auto; text-align:center; color:green}
.jobDetails .job_company{padding-bottom:10px; border-bottom:1px solid #ddd; margin-top:20px}
.jobDetails .job_point{color:green; font-weight:bold}
.jobDetails .email_link{padding:5px; border:1px solid green; color:green}
</style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed"
                        data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="<?php echo e(url('#')); ?>">
                            <?php echo e(config('app.name', 'Social-Network')); ?>

                        </a>


                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            <?php if(Auth::check()): ?>

                            <li><a href="<?php echo e(url('/findFriends')); ?>">Find Friends </a></li>
                              <li><a href="<?php echo e(url('/requests')); ?>">My Requests
                                      <span style="color:green; font-weight:bold;
                                       font-size:16px">(<?php echo e(App\friendships::where('status', Null)
                                                  ->where('user_requested', Auth::user()->id)
                                                  ->count()); ?>)</span></a></li>
                        
                            <?php endif; ?>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            <?php if(Auth::guest()): ?>
                            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                            <li><a href="<?php echo e(route('register')); ?>">Register</a></li>
                            <?php else: ?>




                            <li>
                                <a href="<?php echo e(url('/friends')); ?>" title="friends">
                                  <img src="<?php echo e(Config::get('app.url')); ?>/public/img/friends.png" width="30"/>
                                 </a>
                            </li>



                    <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="<?php echo e(url('')); ?>/public/img/<?php echo e(Auth::user()->pic); ?>" width="30px" height="30px" class="img-circle"/>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">

                                    <li> <a href="<?php echo e(url('/profile')); ?>/<?php echo e(Auth::user()->slug); ?>" >   Profile  </a> </li>
                                    <li> <a href="<?php echo e(url('editProfile')); ?>" >  Edit Profile  </a> </li>

                                    <li>
                                        <a href="<?php echo e(route('logout')); ?>"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </li>


                                </ul>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>

            <?php echo $__env->yieldContent('content'); ?>
            <div >

                <div class="container"> <p class="pull-right" style="padding: 5px;">Social-Network - &copy; 2017</p></div>
            </div>
        </div>

        <script src="<?php echo Config::get('app.url');?>/public/js/profile.js"></script>
        <script type="text/javascript">
               $(document).ready(function() {
                   $('#tooltip1').tooltip();
               });
               </script>
</body>
</html>
