<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Country;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    public function settings()
    {
        return view('users.settings', [
            'countries' => Country::all()
        ]);
    }

    public function deactivate(User $user)
    {
        $user->delete();
        return redirect()->route('index');
    }

    public function updatePersonalInformation(UpdateUser $request)
    {
        Auth::user()->update($request->all());
        Auth::user()->update(['age' => Carbon::parse($request->input('dob'))->age]);

        return redirect()->back()
            ->with('success', trans('strings.updated_successfully'));
    }

    public function all_notifications()
    {
        $notifications = Auth::user()->unreadNotifications;
        Auth::user()->unreadNotifications->markAsRead();
        return view('users.notifications', [
            'notifications' => $notifications
        ]);
    }

    public function notifications()
    {
        return response()->json(Auth::user()->unreadNotifications()->orderBy('created_at','desc')->take(5)->get());
    }

    public function readNotifications()
    {
        return Auth::user()->unreadNotifications->markAsRead();
    }
}
