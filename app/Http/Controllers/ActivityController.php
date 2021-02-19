<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Session;
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
        if (!auth()->user()->hasPermissionTo('see_activities')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
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
        if (!auth()->user()->hasPermissionTo('see_activity')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        return response()->json(Activity::find($id));
    } 

    public function create(Request $request)
    {
        if (!auth()->user()->hasPermissionTo('add_activity')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $this->validate($request, [
            'desc'          => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
            'session'       => 'required'
        ]);

        $activity = Activity::create($request->all());
        return response()->json($activity, 201);
    }
    
    public function update($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('update_activity')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $this->validate($request, [
            'desc'          => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required'
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($request->all());
        return response()->json($activity, 200);
    }

    public function delete($id)
    {
        if (!auth()->user()->hasPermissionTo('delete_activity')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        Activity::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }

    public function showSession($id)
    {
        if (!auth()->user()->hasPermissionTo('see_activity_session')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $activity = Activity::findOrFail($id);
        $session = Session::findOrFail($activity->session);
        return response()->json($session, 200);
    }
}
