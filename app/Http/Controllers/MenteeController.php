<?php

namespace App\Http\Controllers;

use App\Mentee;
use Illuminate\Http\Request;

class MenteeController extends Controller
{
    /**
     * Return all mentees
     * 
     * @return mentee
     */
    public function showAll()
    {
        if (!auth()->user()->hasPermissionTo('see_mentees')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentees = Mentee::all();
        foreach ($mentees as $mentee) {
            $mentee = $mentee->applicant->user;
        }
        return response()->json($mentees);
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant du mentee
     * @return Mentee
     */
    public function showOne($id)
    {
        if (!auth()->user()->hasPermissionTo('see_mentee')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentee = Mentee::findOrFail($id);
        $mentee = $mentee->applicant->user;
        return response()->json($mentee);
    }

    public function update($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('update_mentee')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentee = Mentee::findOrFail($id);
        $mentee->update($request->all());
        $mentee->applicant->update($request->all());
        $mentee->applicant->user->update($request->all());
        return response()->json($mentee, 200);
    }

    public function delete($id)
    {
        if (!auth()->user()->hasPermissionTo('delete_mentee')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        mentee::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }

    public function getSkill($id)
    {
        if (!auth()->user()->hasPermissionTo('see_mentee_skills')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentee = Mentee::findOrFail($id);
        return response()->json($mentee->applicant->skills, 200);
    }

    public function setSkill($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('add_mentee_skill')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentee = Mentee::findOrFail($id);
        $mentee->applicant->skills()->attach($request->skill);
        return response()->json($mentee->applicant->skills, 200);
    }

    public function deleteSkill($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('delete_mentee_skill')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentee = Mentee::findOrFail($id);
        $mentee->applicant->skills()->detach($request->skill);
        return response()->json($mentee->applicant->skills, 200);
    }

    public function getArea($id)
    {
        if (!auth()->user()->hasPermissionTo('see_mentee_areas')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentee = Mentee::findOrFail($id);
        return response()->json($mentee->applicant->areas, 200);
    }

    public function setArea($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('add_mentee_area')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentee = Mentee::findOrFail($id);
        $mentee->applicant->areas()->attach($request->area);
        return response()->json($mentee->applicant->areas, 200);
    }

    public function deleteArea($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('delete_mentee_area')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentee = Mentee::findOrFail($id);
        $mentee->applicant->areas()->detach($request->area);
        return response()->json($mentee->applicant->areas, 200);
    }
}
