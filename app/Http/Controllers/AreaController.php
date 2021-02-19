<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Return all areas 
     * 
     * @return Area
     */
    public function showAll()
    {
        if (!auth()->user()->hasPermissionTo('see_areas')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        return response()->json(Area::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant du domaine
     * @return Area
     */
    public function showOne($id)
    {
        if (!auth()->user()->hasPermissionTo('see_area')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        return response()->json(Area::find($id));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->hasPermissionTo('add_area')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $this->validate($request, [
            'lib' => 'required',
        ]);

        $area = Area::create($request->all());
        return response()->json($area, 201);
    }

    public function update($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('update_area')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $this->validate($request, [
            'lib' => 'required',
        ]);

        $area = Area::findOrFail($id);
        $area->update($request->all());
        return response()->json($area, 200);
    }

    public function delete($id)
    {
        if (!auth()->user()->hasPermissionTo('delete_area')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        Area::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }
}
