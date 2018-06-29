<?php

namespace App\Http\Controllers\Auth;

use App\Subscription;
use App\User;
use App\Vote;
use App\Workout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    //
    public function dashboard()
    {
        $user = User::find(Auth::id());

        return view('user.dashboard', [
            'user'  => $user
        ]);
    }

    public function updateProfile(Request $request) {
        $userId = Auth::id();
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users,email,'.$userId,
            'password'  => 'confirmed'
        ]);

        $user = User::find($userId);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->email_update = $request->input('email_update') === null ? 0 : 1;

        if($request->filled('password'))
            $user->password = Hash::make($request->input('password'));

        $user->save();

        if(!$subscribe = Subscription::where('user_id', $userId)->first())
            $subscribe = new Subscription();

        $subscribe->subscription = $request->input('newsletter') === null ? 0 : 1;
        $subscribe->user_id = $userId;
        $subscribe->save();

        return Redirect::back()->with('success', 'Profile Updated');
    }

    //
    public function delete()
    {
        $user = User::find(Auth::id());

        $user->delete();

        return redirect('/');
    }
}
