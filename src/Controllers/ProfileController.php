<?php

namespace Laralum\Profile\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use File;
use Hash;
use Illuminate\Http\Request;
use Laralum\Users\Models\User;

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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function publicUpdateProfile(Request $request)
    {
        $notValid = $this->mainUpdateProfile($request);
        //  If $notValid it's true, something fail and then it should be corrected by user
        //  If $notValid is false, profile is updated ok

        if ($notValid) {
            // Validation or update fails
            return redirect()->route('laralum_public::profile.edit')->with('error', $notValid);
        }

        return redirect()->route('laralum_public::profile.index')->with('success', __('laralum_profile::general.profile_updated'));
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $notValid = $this->mainUpdateProfile($request);
        //  If $notValid it's true, something fail and then it should be corrected by user
        //  If $notValid is false, profile is updated ok

        if ($notValid) {
            // Validation or update fails
            return redirect()->route('laralum::profile.edit')->with('error', $notValid);
        }
        // If it's here, validation has been success
        return redirect()->route('laralum::profile.index')->with('success', __('laralum_profile::general.profile_updated'));
    }

    /**
     * Validate public and private forms indifferently, and update info if validations are OK.
     *
     * @param \Illuminate\Http\Request $request
     */
    private function mainUpdateProfile($request)
    {
        $this->validate($request, [
            'name'              => 'max:255',
            'current_password'  => 'required',
        ]);

        $user = User::findOrFail(Auth::id()); // To use Laralum user model

        if (!Hash::check($request->current_password, $user->password)) {
            // Password incorrect
            return __('laralum_profile::general.incorrect_password'); // Update error: incorrect password
        }
        if ($request->hasFile('picture')) {
            $this->validate($request, [
                'picture' => 'image|max:5120',
            ]);

            if ($request->file('picture')->isValid()) {
                $request->file('picture')->move(public_path('/avatars'), md5($user->email));
            } else {
                return __('laralum_profile::general.image_not_valid'); // Update error: image not valid
            }
        } else {
            if ($user->hasAvatar()) {
                if (!$request->save_picture) {
                    File::delete(public_path('/avatars/'.md5($user->email)));
                }
            }
        }
        if ($request->password) {
            $this->validate($request, [
                'password' => 'min:6|confirmed',
            ]);
            $user->update(['password' => bcrypt($request->password)]);
        }

        if ($request->name) {
            $user->update(['name' => $request->name]);
        }

        return 0; // Updated completed okai
    }
}
