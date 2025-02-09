<?php

namespace App\Http\Controllers\owner;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function index()
    {
        $admins = User::where('position', 'admin')->get();
        return view('owner.admins', [
            'admins' => $admins
        ]);
    }

    public function add(Request $request)
    {
        $validate = validator($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm-password' => 'required|same:password',
        ]));
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position' => $request->position,
        ]);

        return back()->with('addSuccess', 'Account added successfully');
    }

    public function delete($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();
        return back()->with('deleteSuccess', 'Account deleted successfully');
    }
}
