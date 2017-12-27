@extends('profile.master')

@section('content')

<div class="container">

    <ol class="breadcrumb">
        <li><a href="{{url('/home')}}">Home</a></li>
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
        <li><a href="">Find Friends</a></li>
    </ol>


    <div class="row">
        {{--@include('profile.sidebar')--}}


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{Auth::user()->name}}
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
                        @foreach($allUsers as $uList)

                        <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                            <div class="col-md-2 pull-left">
                                <img src="{{url('')}}/public/img/{{$uList->pic}}"
                                width="80px" height="80px" class="img-rounded"/>
                            </div>

                            <div class="col-md-7 pull-left">
                                <h3 style="margin:0px;"><a href="{{url('/profile')}}/{{$uList->slug}}">
                                  {{ucwords($uList->name)}}</a></h3>
                                <p><i class="fa fa-globe"></i> {{$uList->city}}  - {{$uList->country}}</p>
                                <p>{{$uList->about}}</p>

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
                                        <a href="{{url('/')}}/addFriend/{{$uList->id}}"
                                           class="btn btn-info btn-sm">Add to Friend</a>
                                    </p>
                                <?php } else {?>
                                    <p>Request Already Sent</p>
                                <?php }?>
                            </div>

                        </div>
                        @endforeach
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

@endsection
