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
use App\Http\Requests\UserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', [
            'roles' => $roles,
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role;
        if ($request->is_active === "on") $user->is_active = true;
        else $user->is_active = false;

        $user->save();

        return Redirect::to('/users')->withOk("L'utilisateur a été crée.");
    }

    public function edit($id): View
    {
        $roles = Role::all();
        $user = User::find($id);


        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // Vérifier si chaque champ a une valeur différente de celle dans la base de données
        if ($request->input('username') !== $user->username) {
            $user->username = $request->input('username');
        }

        if ($request->input('firstname') !== $user->firstname) {
            $user->firstname = $request->input('firstname');
        }

        if ($request->input('lastname') !== $user->lastname) {
            $user->lastname = $request->input('lastname');
        }

        if ($request->input('email') !== $user->email) {
            $user->email = $request->input('email');
        }

        $password = $request->input('password');
        if (!empty($password)) {
            // Mettre à jour le mot de passe seulement s'il est renseigné
            $user->password = Hash::make($password);
        }

        if ($request->input('role') !== $user->role_id) {
            $user->role_id = $request->input('role');
        }

        $is_active = boolval($request->input('is_active'));
        if ($is_active !== $user->is_active) {
            $user->is_active = $is_active;
        }

        $user->save();

        return redirect('/users')->withOk("L'utilisateur a été modifié.");
    }

    // public function update(Request $request)
    // {
    //     $user = User::find(1);
    //     $user->username = $request->username;
    //     $user->firstname = $request->firstname;
    //     $user->lastname = $request->lastname;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $user->role_id = $request->role;
    //     if ($request->is_active === "on") $user->is_active = true;
    //     else $user->is_active = false;

    //     $user->save();

    //     return Redirect::to('/users')->withOk("L'utilisateur a été modifié.");
    // }

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
            'image' => $user->image,
            'role_id' => $user->role_id,
        ];
    }

    public function getAUser($id)
    {
        return User::find($id);
    }
}
