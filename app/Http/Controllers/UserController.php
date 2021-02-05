<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    /**
     * Return all users 
     * 
     * @return User
     */
    public function showAllUsers()
    {
        return response()->json(User::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant de l'utilisateur
     * @return User
     */
    public function showOneUser($id)
    {
        return response()->json(User::find($id));
    }
}
