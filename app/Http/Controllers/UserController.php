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
    public function showAll()
    {
        return response()->json(User::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant de l'utilisateur
     * @return User
     */
    public function showOne($id)
    {
        return response()->json(User::find($id));
    } 
    
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'firstname' => 'string',
            'lastname'  => 'string',
            'email'     => 'email|unique:user',
            'password'  => 'confirmed',
        ]);

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
