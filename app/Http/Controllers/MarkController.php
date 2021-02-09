<?php

namespace App\Http\Controllers;

use App\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Return all marks 
     * 
     * @return Mark
     */
    public function showAll()
    {
        return response()->json(Mark::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant de la note
     * 
     * @return Mark
     */
    public function showOne($id)
    {
        return response()->json(Mark::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'value'     => 'required',
            'mentor'    => 'required',
            'mentee'    => 'required',
        ]);

        $mark = Mark::create($request->all());
        return response()->json($mark, 201);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'value'     => 'required',
            'mentor'    => 'required',
            'mentee'    => 'required',
        ]);

        $mark = Mark::findOrFail($id);
        $mark->update($request->all());
        return response()->json($mark, 200);
    }

    public function delete($id)
    {
        Mark::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }
}
