<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Social-Network</title>
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
        <script src="https://use.fontawesome.com/595a5020bd.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #ddd;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                margin: 0;
            }
            .full-height {
              margin-top:50px
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;

            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px0;
            }
            .head_har{
              background-color: #f6f7f9;
                    border-bottom: 1px solid #dddfe2;
                    border-radius: 2px 2px 0 0;
                    font-weight: bold;
                    padding: 8px 6px;

            }
            .left-sidebar, .right-sidebar{
              background-color:#fff;
              min-height:100%
            }
            .posts_div{margin-bottom:10px !important}
            .posts_div h3{
              margin-top:4px !important;

            }
            #postText{
              border:none;
              height:100px
            }
            .likeBtn{
              color: #4b4f56; font-weight:bold; cursor: pointer;
            }
            .left-sidebar li { padding:10px;
              border-bottom:1px solid #ddd;
            list-style:none; margin-left:-20px}
            .dropdown-menu{min-width:120px; left:-30px}
            .dropdown-menu a{ cursor: pointer;}
            .dropdown-divider {
              height: 1px;
              margin: .5rem 0;
              overflow: hidden;
              background-color: #eceeef;}
              .user_name{font-size:18px;
               font-weight:bold; text-transform:capitalize; margin:3px}
              .all_posts{background-color:#fff; padding:15px;
               margin-bottom:15px; border-radius:5px;
                -webkit-box-shadow: 0 8px 6px -6px #666;
  	            -moz-box-shadow: 0 8px 6px -6px #666;
  	             box-shadow: 0 8px 6px -6px #666;}

#commentBox{ 
  background-color:#ddd; 
  padding:10px; 
  width:99%; margin:0 auto;
  background-color:#F6F7F9;  
  padding:10px;
  margin-bottom:10px
}
#commentBox li { list-style:none; padding:10px; border-bottom:1px solid #ddd}
.commet_form{ padding:10px; margin-bottom:10px}
.commentHand{color:blue}
.commentHand:hover{cursor:pointer}
        </style>

    </head>
    <body>
      <?php if(Route::has('login')): ?>
          <div class="top-right links">
              <?php if(Auth::check()): ?>
              <a href="<?php echo e(url('jobs')); ?>" style="background-color:#283E4A;
              color:#fff; padding:5px 15px 5px 15px; border-radius:5px">Find Job</a>
                  <a href="<?php echo e(url('/home')); ?>">Dashboard
                (<span style="text-transform:capitalize;
                color:green"><?php echo e(ucwords(Auth::user()->name)); ?></span>)</a>
                    <a href="<?php echo e(url('/logout')); ?>">Logout</a>
              <?php else: ?>
                  <a href="<?php echo e(url('/login')); ?>">Login</a>
                  <a href="<?php echo e(url('/register')); ?>">Register</a>
              <?php endif; ?>
          </div>
      <?php endif; ?>
        <div class="flex-center position-ref full-height">



<div class="col-md-12"  id="app">


  <div class="col-md-3 left-sidebar hidden-xs hidden-sm">
<?php if(Auth::check()): ?>
   <ul>
     <li>
       <a href="<?php echo e(url('/profile')); ?>/<?php echo e(Auth::user()->slug); ?>"> <img src="<?php echo e(Config::get('app.url')); ?>/public/img/<?php echo e(Auth::user()->pic); ?>"
       width="32" style="margin:5px"  />
       <?php echo e(Auth::user()->name); ?></a>
     </li>
     <li>
       <a href="<?php echo e(url('/')); ?>"> <img src="<?php echo e(Config::get('app.url')); ?>/public/img/news_feed.png"
       width="32" style="margin:5px"  />
       News Feed</a>
     </li>
     <li>
       <a href="<?php echo e(url('/friends')); ?>"> <img src="<?php echo e(Config::get('app.url')); ?>/public/img/friends.png"
       width="32" style="margin:5px"  />
       Friends </a>
     </li>
     <li>
       <a href="<?php echo e(url('/messages')); ?>"> <img src="<?php echo e(Config::get('app.url')); ?>/public/img/msg.png"
       width="32" style="margin:5px"  />
      Messages</a>
     </li>
     <li>
       <a href="<?php echo e(url('/findFriends')); ?>"> <img src="<?php echo e(Config::get('app.url')); ?>/public/img/friends.png"
       width="32" style="margin:5px"  />
      Find Friends</a>
     </li>

     <li>
       <a href="<?php echo e(url('/jobs')); ?>"> <img src="<?php echo e(Config::get('app.url')); ?>/public/img/jobs.png"
       width="32" style="margin:5px"  />
      Find Jobs</a>
     </li>
   </ul>
   <?php endif; ?>

  </div>

  <div class="col-md-6 col-sm-12 col-xs-12 center-con">
  <?php if(Auth::check()): ?>
      <div class="posts_div">
         <div class="head_har">
              {{msg}}
          </div>
          <div style="background-color:#fff">
            <div class="row">
              <div class="col-md-1 pull-left">
                <img src="<?php echo e(url('../')); ?>/public/img/<?php echo e(Auth::user()->pic); ?>"
                 style="width:50px; margin:5px; padding:5px" class="img-rounded">
              </div>
              <div class="col-md-11 pull-right">
                <form method="post" enctype="multipart/form-data" v-on:submit.prevent="addPost">
                <textarea v-model="content" id="postText" class="form-control"
                placeholder="what's on your mind ?"></textarea>
                <button type="submit" class="btn btn-sm btn-info pull-right" style="margin:10px" id="postBtn">Post</button>
                </form>

                <div v-if="!image">
                <input type="file" @change="onFileChange"/>
                </div>

                <div v-else>
                <img :src="image" style="width:200px"/><br>
                <button @click="uploadImg" class="btn btn-success">Upload</button>
                <button @click="removeImg" class="btn btn-danger">Remove</button>
                </div>

              </div>
            </div>
          </div>
      </div>
      <?php endif; ?>
          <div class="">
             <!--<div class="head_har">  Posts</div> -->

             <div v-for="post,key in posts" >
              <div class="col-md-12 col-sm-12 col-xs-12 all_posts">
            
                  <div class="col-md-1 pull-left">
                    <img :src="'<?php echo e(Config::get('app.url')); ?>/public/img/' + post.user.pic"
                    style="width:50px;">                   
                  </div>

              <div class="col-md-10" style="margin-left:10px">
              <div class="row">
               <div class="col-md-11">
                 <p><a :href="'<?php echo e(url('profile')); ?>/' +  post.user.slug" class="user_name"> {{post.user.name}}</a> <br>
                 <span style="color:#AAADB3">  {{ post.created_at | myOwnTime}}
                 <i class="fa fa-globe"></i></span></p>
               </div>
               <div class="col-md-1 pull-right">
                 <?php if(Auth::check()): ?>
                  <!-- delete button goes here -->
                  <a href="#" data-toggle="dropdown" aria-haspopup="true">
                    <img src="<?php echo e(Config::get('app.url')); ?>/public/img/settings.png" width="20">
                  </a>
                  <div class="dropdown-menu">
                    <li><a>some action here</a></li>
                    <li><a>some more action</a></li>
                    <div class="dropdown-divider"></div>
                    <li v-if="post.user_id == '<?php echo e(Auth::user()->id); ?>'">
                      <a @click="deletePost(post.id)">
                        <i class="fa fa-trash"></i> Delete</a>
                      </li>
                  </div>
                  <?php endif; ?>
               </div>
              </div>
                  </div>

                   <p class="col-md-12" style="color:#000; margin-top:15px; font-family:inherit">
                     {{post.content}}
                   </p>
                  <div style="padding:10px; border-top:1px solid #ddd" class="col-md-12">                 
                    <div class="col-md-4">
                      <?php if(Auth::check()): ?>
                      <p v-if="post.likes.length!=0" style="color:blue">
                      <i class="fa fa-thumbs-up"></i>
                      liked by <b style="color:green"> {{post.likes.length}} </b> persons
                     </p>

                      <p v-else class="likeBtn" @click="likePost(post.id)">
                        no one like <br>
                        <i class="fa fa-thumbs-up"></i> Like
                      </p>

                      <?php endif; ?>
                    </div>

                    <div class="col-md-4">
                    <p @click="commentSeen= !commentSeen" class="commentHand"> 
                     Comments <b>({{post.comments.length}})</b></p>
                    </div>
  
                    </div>
                      
                </div>
                <div id="commentBox" v-if="commentSeen">
                <div class="commet_form">
                   <!-- send comment-->
                   <textarea class="form-control" v-model="commentData[key]"></textarea>                  
                    <button class="btn btn-success" 
                    @click="addComment(post,key)">Send</button>  
                    </div>

                    <ul v-for="comment in post.comments">
                      <li>{{comment.comment}}</li>
                    </ul>
                </div>
           
            </div>
           
          </div>
      </div>

  <div class="col-md-3 right-sidebar hidden-sm hidden-xs" >
      <h3 align="center">Right Sidebar</h3>
   </div>


</div>

        </div>

        <script src="public/js/app.js"></script>
        <script>
$(document).ready(function(){

$('#postBtn').hide();

  $("#postText").hover(function() {
  $('#postBtn').show();
 });

});
</script>
    </body>
</html>
