<?php

namespace Laralum\Profile\Controllers;
use App\Http\Controllers\Controller;
use Laralum\Users\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;
use File;

class ProfileController extends Controller
{
    /**
     * Display the logged in user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicProfile()
    {
        return view('laralum_profile_public::profile');
    }

    /**
     * Display the logged in user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicEditProfile()
    {
        return view('laralum_profile_public::edit');
    }

    /**
     * Display the logged in user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function publicUpdateProfile(Request $request)
    {
        $this->mainUpdateProfile($request, 'laralum::public.profile.edit');
        return redirect()->route('laralum_public::profile');
    }



    /**
     * Display the logged in user's profile in laralum administration.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('laralum_profile::profile');
    }


    /**
     * Display the logged in user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        return view('laralum_profile::edit');
    }


    /**
     * Display the logged in user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $this->mainUpdateProfile($request);
        return redirect()->route('laralum::profile');
    }

    private function mainUpdateProfile($request, $goTo = 'laralum::profile.edit')
    {

        $this->validate($request, [
            'name'              => 'max:255',
            'current_password'  => 'required',
        ]);

        $user = User::findOrFail(Auth::id()); //for use laralum user model


        if (!Hash::check($request->current_password, $user->password )){
            # Password incorrect
            return redirect()->route($goTo)->with('error', 'Incorrect password');
        }
        if ($request->hasFile('photo')) {
            $this->validate($request, [
                'photo' => 'image|max:5120',
            ]);
            if ($request->file('photo')->isValid()) {
                $request->file('photo')->move(public_path('/avatars'), md5($user->email));
            } else {
                return redirect()->route($goTo)->with('error', 'Photo is not valid. Try with another photo');
            }
        } else {
            if ($user->hasAvatar()) {
                if (!$request->save_photo) {
                    File::delete(public_path('/avatars/'.md5($user->email)));
                }
            }
        }
        if($request->password){
            $this->validate($request, [
                'password'          => 'min:6|confirmed',
            ]);
            $user->update(['password' => bcrypt($request->password)]);

        }
        if ($request->name) {
            $user->update(['name' => $request->name]);
        }
    }

}
