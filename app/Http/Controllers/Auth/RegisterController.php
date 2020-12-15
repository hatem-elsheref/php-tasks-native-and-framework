<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Rules\ValidEmail;
use App\User;
use App\Country;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        $countries=Country::select('name','id')->get();
        return view('auth.register',compact('countries'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255',new ValidEmail() ,'unique:users'],
            'phone'      => ['required', PHONE_PATTERN, 'digits:'.PHONE_DIGITS, 'unique:users'],
//            'country_id' => ['required', 'numeric','exists:countries,id'],
            'city'     => ['required', 'string', 'max:255'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'avatar'     => ['nullable','image','mimes:jpg,png,jpeg,gif','max:'.AVATAR_MAX_SIZE],
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



        $path=MAIN.'/users/'.DEFAULT_AVATAR;
        if (!empty($data['avatar'])){
            $uploadedFile=$data['avatar'];
            $newName=time().rand(99,999999).'-'.strtolower(str_replace(' ','-',$data['name'])).'.'.$uploadedFile->getClientOriginalExtension();
            $path=$uploadedFile->move(MAIN.DIRECTORY_SEPARATOR.'users',$newName);
        }

        return User::create([
            'name' => $data['name'],
//            'country_id' => \App\Country::where('code','SA')->value('id'),
            'country_id' => 187, //187 it the id of saudi arabia in database
            'city' => $data['city'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'avatar'=>$path,
            'role'=>'student'
        ]);
    }
}
