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
        return view('laralum_profile::public.profile', ['user' => User::findOrFail(Auth::id())]);
    }

    /**
     * Display a public form to edit the logged in user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicEditProfile()
    {
        return view('laralum_profile::public.edit', ['user' => User::findOrFail(Auth::id())]);
    }

    /**
     * Update profile from public form and return the public profile view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function publicUpdateProfile(Request $request)
    {
        $this->mainUpdateProfile($request, 'laralum_public::profile.edit');
        return redirect()->route('laralum_public::profile')->with('success', trans('laralum_profile::profile.profile_updated'));
    }



    /**
     * Display the logged in user's profile in laralum administration.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('laralum_profile::laralum.profile', ['user' => User::findOrFail(Auth::id())]);
    }


    /**
     * Display a form to edit the logged in user's profile in laralum administrations.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        return view('laralum_profile::laralum.edit', ['user' => User::findOrFail(Auth::id())]);
    }


    /**
     *  Update profile from laralum administration form and return the profile view of laralum administration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $this->mainUpdateProfile($request);
        return redirect()->route('laralum::profile')->with('success', trans('laralum_profile::profile.profile_updated'));
    }

    /**
     * Validate public and private forms indifferently, and update info if validations is OK
     *
     * @param  $request
     * @param  $goTo
     */
    private function mainUpdateProfile($request, $goTo = 'laralum::profile.edit')
    {
        $this->validate($request, [
            'name'              => 'max:255',
            'current_password'  => 'required',
        ]);

        $user = User::findOrFail(Auth::id()); // To use Laralum user model

        if ( !Hash::check($request->current_password, $user->password )){
            // Password incorrect
            return redirect()->route($goTo)->with('error', 'Incorrect password');
        }
        if ( $request->hasFile('picture') ) {
            $this->validate($request, [
                'picture' => 'image|max:5120',
            ]);

            if ( $request->file('picture')->isValid() ) {
                $request->file('picture')->move(public_path('/avatars'), md5($user->email));
            } else {
                return redirect()->route($goTo)->with('error', 'picture is not valid. Try with another picture');
            }
        } else {
            if ( $user->hasAvatar() ) {
                if ( !$request->save_picture ) {
                    File::delete(public_path('/avatars/'.md5($user->email)));
                }
            }
        }
        if( $request->password ){

            $this->validate($request, [
                'password'          => 'min:6|confirmed',
            ]);
            $user->update(['password' => bcrypt($request->password)]);
        }

        if( $request->name ) {
            $user->update(['name' => $request->name]);
        }
    }

}
