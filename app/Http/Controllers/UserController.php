<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Throwable;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function edit(Request $request): View
    {
        $user = User::find($request->id);

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function active(Request $request)
    {
        User::find($request->id)->update(['is_active' => 1]);

        return Redirect::to('/users');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        User::find($request->id)->update(['is_active' => 0]);

        return Redirect::to('/users');
    }

    public function login(LoginRequest $request)
    {
        try {
            $request->authenticate();
        } catch (Throwable $e) {
            return response()->json(['error' => 'Verifiez les informations de connexion'], 401);
        }

        $user = Auth::user();

        return [
            'id' => $user->id,
            'username' => $user->username,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'role_id' => $user->role_id,
        ];
    }
}
