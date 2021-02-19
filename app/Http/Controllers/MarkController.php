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
        if (!auth()->user()->hasPermissionTo('see_marks')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
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
        if (!auth()->user()->hasPermissionTo('see_mark')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        return response()->json(Mark::find($id));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->hasPermissionTo('add_mark')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
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
        if (!auth()->user()->hasPermissionTo('update_mark')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
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
        if (!auth()->user()->hasPermissionTo('delete_mark')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        Mark::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }
}
