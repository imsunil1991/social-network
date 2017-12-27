<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\friendships;
use App\notifcations;
use App\User;
class ProfileController extends Controller {

    public function index($slug) {

     $userData = DB::table('users')
     ->leftJoin('profiles', 'profiles.user_id','users.id')
     ->where('slug', $slug)
     ->get();

        return view('profile.index', compact('userData'))->with('data', Auth::user()->profile);
    }

    public function uploadPhoto(Request $request) {

        $file = $request->file('pic');
        $filename = $file->getClientOriginalName();

        $path = 'public/img';

        $file->move($path, $filename);
        $user_id = Auth::user()->id;

        DB::table('users')->where('id', $user_id)->update(['pic' => $filename]);
        //return view('profile.index');
        return back();
    }

    public function setToken(Request $request){
     $email = $request->email_address;
     //check any user have this email address
     $checkEmail = DB::table('users')->where('email',$email)->get();
     if(count($checkEmail)==0){
       echo "wrong email address";
     }else{
       $randomNumber = rand(1,500);
         $token_sl = bcrypt($randomNumber);
         $token = stripslashes($token_sl);

         $insert_token = DB::table('password_resets')->insert(['email' =>$email, 'token'=>$token,
       'created_at'=>\Carbon\Carbon::now()->toDateTimeString()]);

       //echo "send reset link to this email address";
       $baseUrl = 'http://hardeepcoder.com/laravel/Social-Network/getToken/'.$token;
        $to = $email;
        $subject = "Password reset Link";
        $message = "<a href='$baseUrl'>$token</a>";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <sunilgaja7@gmail.com.com>' . "\r\n";

        mail($to,$subject,$message,$headers);

     }

    }

    public function setPass(Request $request){
      $email = $request->email;
      $pass = $request->pass;
      $cpass = $request->confrim_pass;
      if($pass == $cpass){
        //update the pass for this user
      DB::table('users')->where('email',$email)->update(['password' =>bcrypt($pass)]);
      return back();
      }
      else{
        echo "passwords not matched";
      }

    }

    public function editProfileForm() {
        return view('profile.editProfile')->with('data', Auth::user()->profile);
    }

    public function updateProfile(Request $request) {

        $user_id = Auth::user()->id;

        DB::table('profiles')->where('user_id', $user_id)->update($request->except('_token'));
        return back();
    }

    public function findFriends(Request $request)
    {
        $search_text = $request['search_text'];
        $uid = Auth::user()->id;
        $allUsers = DB::table('profiles')
        ->leftJoin('users', 'users.id', '=', 'profiles.user_id')
        ->where('users.id', '!=', $uid);
            if($search_text != '' && $search_text != NULL ){
                $allUsers = $allUsers->where('users.name', 'LIKE', '%'.$search_text.'%');
            }
        $allUsers = $allUsers->get();

        return view('profile.findFriends', compact('allUsers'));
    }

    public function sendRequest($id) {

        Auth::user()->addFriend($id);

        return back();
    }

    public function requests() {
        $uid = Auth::user()->id;

        $FriendRequests = DB::table('friendships')
                        ->rightJoin('users', 'users.id', '=', 'friendships.requester')
                        ->where('status', '=', Null)
                        ->where('friendships.user_requested', '=', $uid)->get();


        return view('profile.requests', compact('FriendRequests'));
    }

    public function accept($name, $id) {

        $uid = Auth::user()->id;
        $checkRequest = friendships::where('requester', $id)
                ->where('user_requested', $uid)
                ->first();
        if ($checkRequest) {
            // echo "yes, update here";

            $updateFriendship = DB::table('friendships')
                    ->where('user_requested', $uid)
                    ->where('requester', $id)
                    ->update(['status' => 1]);

            $notifcations = new notifcations;
            $notifcations->note = 'accepted your friend request';
            $notifcations->user_hero = $id; // who is accepting my request
            $notifcations->user_logged = Auth::user()->id; // me
            $notifcations->status = '1'; // unread notifications
            $notifcations->save();


            if ($notifcations) {

                return back()->with('msg', 'You are now Friend with ' . $name);
            }
        } else {
            return back()->with('msg', 'You are now Friend with this user');
        }
    }

    public function friends() {
        $uid = Auth::user()->id;

        $friends1 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
                ->where('status', 1)
                ->where('requester', $uid) // who is loggedin
                ->get();
        $all_frnds_id = [];
        foreach ($friends1 as $frnd){
            array_push($all_frnds_id, $frnd->requester);
            array_push($all_frnds_id, $frnd->user_requested);
        }
        $friends2 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.requester')
                ->where('status', 1)
                ->where('user_requested', $uid)
                ->get();
        foreach ($friends2 as $frnd){
            array_push($all_frnds_id, $frnd->requester);
            array_push($all_frnds_id, $frnd->user_requested);
        }


        $friends = array_merge($friends1->toArray(), $friends2->toArray());

        $all_frnds_id = array_unique($all_frnds_id);
        //print_r($all_frnds_id);exit;
        return view('profile.friends', compact('friends'),compact('all_frnds_id'));
    }

    public function requestRemove($id) {

        DB::table('friendships')
                ->where('user_requested', Auth::user()->id)
                ->where('requester', $id)
                ->delete();

        return back()->with('msg', 'Request has been deleted');
    }


}
