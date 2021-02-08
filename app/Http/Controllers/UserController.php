<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
    
    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }
}
