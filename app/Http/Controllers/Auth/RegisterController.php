<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Invitation;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {// da inserire il validazione con user_token
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $now=Carbon::now()->toDateTimeString();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => User::DEFAULT_TYPE,
            //'api_token' => Str::random(60),
        ]);
    }

    public function requestInvitation() {// request an invitation
        return view('auth.request');
    }

    public function showRegistrationForm(Request $request){// need also gdpr
        $invitation_token = $request->get('invitation_token');
        $invitation = Invitation::where('invitation_token', $invitation_token)->firstOrFail();
        $email = $invitation->email;
        return view('auth.register', compact('email'));
    }

    protected function store(Request $request){
        $now=Carbon::now()->toDateTimeString();
        $usr=User::where('email',$request->email)->first();
        if($usr)
           return redirect()->route('login')->with('error', 'You are already registered with this email');

        $validate=$this->validate(request(), [
           'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);

        $invitation=Invitation::where('email',$request->email)->first();
        if($invitation && $validate){
            $user=new User();
            $user->name = request('name');
            $user->email = request('email');
            $user->password = bcrypt(request('password'));
            $user->save();
            $invitation->registered_at=$now;
            $invitation->save();
           return redirect()->route('login')->with('success', 'Registered successful');
        }
        else {
            redirect()->route('login')->with('error', 'Something went wrong or invalid invitation');
        }
    }
}
