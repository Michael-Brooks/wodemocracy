<?php

namespace App\Http\Controllers;

use App\Jobs\SendUpdateEmail;
use App\User;
use App\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.index');
    }

    public function listWorkouts()
    {
        Workout::pending(4);
        $workouts = Workout::pending()->get();

        return view('admin.list_workouts', [
            'workouts'  => $workouts
        ]);
    }

    public function updateWorkout(Request $request, $workoutId)
    {
        switch ($request->input('status')) {
            case 0:
                Workout::pending($workoutId);
                break;
            case 1:
                Workout::approve($workoutId);
                break;
            case 2:
                Workout::reject($workoutId);
                break;
            case 3:
                Workout::postpone($workoutId);
                break;
        }

        return Redirect::back()->with('success', 'Workout Updated');
    }

    public function deleteWorkout()
    {
        // Delete workout
    }

    public function listUsers()
    {
        $user = User::find(Auth::id());
        $roles = Role::all();

        if ($user->hasRole('admin')) {
            $users = User::all();

            return view('admin.list_users', [
                'users' => $users,
                'roles' => $roles,
            ]);
        }

        return abort(404);
    }

    public function updateUser(Request $request, $userId)
    {
        // Update user roles
        if($userId === 1)
            return Redirect::back();

        $user = User::find($userId);
        $user->syncRoles([$request->input('role')]);

        return Redirect::back()->with('success', 'Update successful');
    }

    public function deleteUser(Request $request, $userId)
    {
        // Delete users
        if($userId === 1)
            return Redirect::back();

        $user = User::find($userId);
        $user->delete();

        return Redirect::back()->with('success', 'User Deleted');
    }

    public function ShowEmailForm()
    {
        return view('admin.email_form');
    }

    public function SendEmailToUsers(Request $request)
    {
        $users = User::where('email_update', 1)->get();
        foreach($users as $user) {
            dispatch(new SendUpdateEmail($user, $request->input('message')));
        }

        return Redirect::back()->with('success', 'Message Sent');
    }
}
