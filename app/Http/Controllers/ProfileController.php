<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Session;
use File;

class ProfileController extends Controller
{

    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function edit2(Request $request): View
    {
        return view('profile.editProfile', [
            'user' => $request->user(),
        ]);
    }

    public function update2(Request $request)
    {
        $profile = User::find($request->id);
        
        $profile->name = $request->name;
        $profile->phoneNumber = $request->phone;
        $profile->gender = $request->gender;
        $profile->address = $request->address;
        $profile->update();
        Session::flash('message', 'Profile has been updated Successfully');
        return redirect()->route('profile.show');

    }

    public function addProfileImage(Request $request): View
    {
        return view('profile.addImage', [
            'user' => $request->user(),
        ]);
    }

    public function editProfileImage(Request $request): View
    {
        return view('profile.editImage', [
            'user' => $request->user(),
        ]);
    }
    
    public function userProfile(Request $req)
    {
        $user = User::find($req->id);
        return view('profile.showProfile', compact('user'));
    }
    
    


    public function pictureInsert(Request $req)
    {
       
            $profile = User::find($req->id);
            if($req->hasFile('image')){
                $file = $req->file('image');
                $filename = uniqid(). $file->getClientOriginalName();
                $file->move('images/profiles', $filename);
                $profile->profile_picture = $filename;
            }
            $profile->save();
            Session::flash('message', 'Profile Picture has been added Successfully');
            return redirect()->route('profile.show');
    }

    public function pictureUpdate(Request $request)
    {
        $profile = User::find($request->id);
        if($request->hasFile('image')){
            $des = public_path('images/profiles/'.$request->oldimage);
            if(File::exists($des))
            {
                File::delete($des);
            }
            $file = $request->file('image');
            $filename = uniqid(). $file->getClientOriginalName();
            $file->move('images/profiles', $filename);
            $profile->profile_picture = $filename;

        }
       
        $profile->update();
        Session::flash('message', 'Profile Picture has been updated Successfully');
        return redirect()->route('profile.show');

    }

    public function pictureRemove(Request $req)
    {
         $profile = User::find($req->id);
         
        $image_path = public_path('images/profiles/'.$profile->profile_picture);
        if(file_exists($image_path)) {
          unlink($image_path);
        }
        $profile->profile_picture = 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png';
        $profile->update();
        Session::flash('message', 'profile has been removed Successfully');
        return redirect()->route('profile.show');
    }








    
}
