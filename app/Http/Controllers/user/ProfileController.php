<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use App\Models\UserBook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laravel\Ui\Presets\React;

class ProfileController extends Controller
{



    public function index($id)
    {
        if (Gate::denies('profile', Auth::user())) {
            abort(401);
        }

        $user_profile = User::findOrFail($id);

        return view('user.profile', [
            'user' => $user_profile,
        ]);
    }


    public function profileImageUpdate(Request $request)
    {
        if (Gate::denies('profile', Auth::user())) {
            abort(401);
        }

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('profile_image')) {
            $user = User::findOrFail(Auth::user()->id);
            // delete old image if exist
            if ($user->profile && file_exists(public_path($user->profile))) {
                unlink(public_path($user->profile));
            }
            // save new image
            $image = $request->file('profile_image');
            $imageName = uniqid() . '.' . Auth::user()->name . '.'  . $image->getClientOriginalName();
            $image->move(public_path('users_profile'), $imageName);
            $user->profile = '/users_profile/' . $imageName;
            $user->save();
        }
        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }

    public function nameChange(Request $request)
    {

        if (Gate::denies('profile', Auth::user())) {
            abort(401);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'Name updated successfully.');
    }

    public function emailUpdate(Request $request)
    {

        if (Gate::denies('profile', Auth::user())) {
            abort(401);
        }

        $request->validate([
            'email' => 'required|email|max:255',
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Email updated successfully.');
    }
    public function passwordUpdate(Request $request)
    {

        if (Gate::denies('profile', Auth::user())) {
            abort(401);
        }

        $request->validate([
            'oldpassword' => 'required|string|min:8',
            'newpassword' => 'required|string|min:8|confirmed',
        ]);
        if (!password_verify($request->oldpassword, Auth::user()->password)) {
            return redirect()->back()->with('error', 'Old password is incorrect.');
        }
        if ($request->oldpassword == $request->newpassword) {
            return redirect()->back()->with('error', 'New password must be different from old password.');
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
