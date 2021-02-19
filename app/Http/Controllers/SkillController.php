<?php

namespace App\Http\Controllers;

use App\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Return all skills 
     * 
     * @return Skill
     */
    public function showAll()
    {
        if (!auth()->user()->hasPermissionTo('see_skills')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        return response()->json(Skill::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant de l'aptitude
     * 
     * @return Skill
     */
    public function showOne($id)
    {
        if (!auth()->user()->hasPermissionTo('see_skill')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        return response()->json(Skill::find($id));
    } 

    public function create(Request $request)
    {
        if (!auth()->user()->hasPermissionTo('add_skill')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $this->validate($request, [
            'lib' => 'required',
        ]);

        $skill = Skill::create($request->all());
        return response()->json($skill, 201);
    }
    
    public function update($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('update_skill')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $this->validate($request, [
            'lib' => 'required',
        ]);

        $skill = Skill::findOrFail($id);
        $skill->update($request->all());
        return response()->json($skill, 200);
    }

    public function delete($id)
    {
        if (!auth()->user()->hasPermissionTo('delete_skill')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        Skill::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }
}
