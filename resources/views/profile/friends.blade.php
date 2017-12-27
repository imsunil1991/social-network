@extends('profile.master')
<?php use App\friendships;
use App\User;?>

@section('content')
<div class="container">

    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}">Home</a></li>
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
        <li><a href="">Friends</a></li>
    </ol>


    <div class="row">
        {{--@include('profile.sidebar')--}}

<?php //print_r($all_frnds_id);exit; ?>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{Auth::user()->name}}, Your Friends</div>

                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                         @if ( session()->has('msg') )
                         <p class="alert alert-success">
                                      {{ session()->get('msg') }}
                                   </p>
                                @endif
                             <?php //echo count($friends);exit;
                             if (count($friends) > 0 ){ ?>
                        @foreach($friends as $uList)

                        <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                            <div class="col-md-2 pull-left">
                                <img src="{{url('')}}/public/img/{{$uList->pic}}" width="80px" height="80px" class="img-rounded"/>
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
                             <p> <a href="{{url('/profile')}}/{{$m_u_data->slug}}">{{ucwords($m_u_data->name)}}</a></p>


                            <?php } }?>
                        </div>
                            <div class="col-md-7 pull-left">
                                <h3 style="margin:0px;"><a href="{{url('/profile')}}/{{$uList->slug}}">{{ucwords($uList->name)}}</a></h3>
                                <p><b>Gender:</b> {{$uList->gender}}</p>
                                   <p><b>Email:</b> {{$uList->email}}</p>
                            </div>

                            <div class="col-md-3 pull-right">

                                     <p>

                                         <a href="{{url('/unfriend')}}/{{$uList->id}}"  class="btn btn-default btn-sm">UnFriend</a>

                                     </p>

                            </div>

                        </div>
                        @endforeach
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
@endsection
