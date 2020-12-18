<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Events\UserRegistered;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use App\User;
use Validator;

class UserController extends Controller
{

    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['valid error'=>$validator->errors()], 401);
        }
        $user = new User();
        $user->first_name = $request->input('first_name');
        // $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->is_active = 0;
        $user->verified = 0;
        $user->save();
        /**************************/
        $user->name = $user->getName();
        $user->update();
        /**************************/
        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        // $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['name'] =  $user->name;
        event(new Registered($user));
        event(new UserRegistered($user));
        $this->guard()->login($user);
        UserVerification::generate($user);
        UserVerification::send($user, 'User Verification', config('mail.recieve_to.address'), config('mail.recieve_to.name'));

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
