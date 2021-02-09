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
        return response()->json(Session::find($id));
    } 

    public function create(Request $request)
    {
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
        $this->validate($request, [
            'date' => 'required',
        ]);

        $session = Session::findOrFail($id);
        $session->update($request->all());
        return response()->json($session, 200);
    }

    public function delete($id)
    {
        Session::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }
}
