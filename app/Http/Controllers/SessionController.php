<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Return all Sessions 
     * 
     * @return Session
     */
    public function showAll()
    {
        if (!auth()->user()->hasPermissionTo('see_sessions')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        return response()->json(Session::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant de l'utilisateur
     * @return Session
     */
    public function showOne($id)
    {
        if (!auth()->user()->hasPermissionTo('see_session')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        return response()->json(Session::find($id));
    } 

    public function create(Request $request)
    {
        if (!auth()->user()->hasPermissionTo('create_session')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $this->validate($request, [
            'mentor'    => 'required',
            'mentee'    => 'required',
            'date'      => 'required'
        ]);

        $session = Session::create($request->all());
        return response()->json($session, 201);
    }
    
    public function update($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('update_session')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $this->validate($request, [
            'date' => 'required',
        ]);

        $session = Session::findOrFail($id);
        $session->update($request->all());
        return response()->json($session, 200);
    }

    public function delete($id)
    {
        if (!auth()->user()->hasPermissionTo('delete_session')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        Session::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }
}
