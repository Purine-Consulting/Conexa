<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Return all Activities 
     * 
     * @return Activity
     */
    public function showAll()
    {
        return response()->json(Activity::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant de l'utilisateur
     * @return Activity
     */
    public function showOne($id)
    {
        return response()->json(Activity::find($id));
    } 

    public function create(Request $request)
    {
        $this->validate($request, [
            'desc'          => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
            'session'       => 'required'
        ]);

        $Activity = Activity::create($request->all());
        return response()->json($Activity, 201);
    }
    
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'desc'          => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required'
        ]);

        $Activity = Activity::findOrFail($id);
        $Activity->update($request->all());
        return response()->json($Activity, 200);
    }

    public function delete($id)
    {
        Activity::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }
}
