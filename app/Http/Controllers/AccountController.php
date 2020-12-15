<?php

namespace App\Http\Controllers;


use App\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    private $imageDirectory='users';
    //return the current authenticated user profile
    public function showAccount(){
        $countries=Country::select('name','id')->get();
        return view('auth.my-account',compact('countries'));
    }

    // method that update the normal information of the current authenticated user
    public function updateInformation(Request $request){
        // to active and show the information tab in frontend
        $request->tab='information';
        $user=auth('web')->user();
        // make some validation to inputs
        $request->validate([
            'name'    =>['required','string','max:191'],
//            'country_id' => ['required', 'numeric','exists:countries,id'],
            'email'   =>['required','string','max:191',Rule::unique('users')->ignore($user->id)],
            'phone'   =>['required',PHONE_PATTERN,'digits:'.PHONE_DIGITS,Rule::unique('users')->ignore($user->id)],
            'city'    => ['required', 'string', 'max:255'],
            'avatar'  =>['image','mimes:jpg,jpeg,png,gif','max:'.AVATAR_MAX_SIZE]
        ]);
        // check if inputs has image already uploaded by the authenticated user
        if($request->hasFile('avatar') && !empty($request->file('avatar'))){

            // check if the old/current avatar not the default avatar if the default not remove it
            if($user->avatar != MAIN.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR.DEFAULT_AVATAR){
                if(File::exists(public_path($user->avatar))){
                    File::delete(public_path($user->avatar));
                }
            }

            // upload the file
            $newName=time().rand(99,999999).'-'.strtolower(str_replace(' ','-',$request->name)).'.'.$request->file('avatar')->getClientOriginalExtension();
            $path=$request->file('avatar')->move(MAIN.DIRECTORY_SEPARATOR.'users',$newName);

        }else{
            // if no uploaded file take the old file
            $path=$user->avatar;
        }
        // prepare the new validated data
        $validatedData=$request->except(['_method','_token','avatar','tab']);
        $validatedData['avatar']=$path;


        // check if update done or not
        if($user->update($validatedData)){
            self::Success();
            auth('web')->loginUsingId($user->id);
        }else
            self::Fail();


        return redirect()->route('my-account.show');

    }

    // method to reset the admin password
    public function resetPassword(Request $request){
        // to active and show the security tab in frontend
        $request->tab='security';
        // make some validation to inputs
        $request->validate([
            'old_password' =>['required','string','min:8'],
            'new_password' =>['required','string','min:8','same:password_confirmation']
        ]);
        $user=auth('web')->user();
        // check if the old password that the user entered equal the current password
        if(Hash::check($request->old_password, $user->password)){
            //  valid old password
            $user->password=Hash::make($request->new_password);
            $user->save();
            // login after save the new password
            auth('web')->loginUsingId($user->id);
            self::Success();
            return redirect()->route('my-account.show');
        }else{
            // invalid old password
            self::Fail(__('backend.error'),__('backend.invalid_old_password'));
            return redirect()->route('my-account.show')->withInput();
        }


    }



}
