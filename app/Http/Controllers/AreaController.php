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
        return response()->json(Area::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'lib' => 'required',
        ]);

        $area = Area::create($request->all());
        return response()->json($area, 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'lib' => 'required',
        ]);

        $area = Area::findOrFail($id);
        $area->update($request->all());
        return response()->json($area, 200);
    }

    public function delete($id)
    {
        Area::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }
}
