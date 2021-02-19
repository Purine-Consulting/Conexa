<?php

namespace App\Http\Controllers;

use App\Mentor;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    /**
     * Return all mentors
     * 
     * @return Mentor
     */
    public function showAll()
    {
        if (!auth()->user()->hasPermissionTo('see_mentors')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentors = Mentor::all();
        foreach ($mentors as $mentor) {
            $mentor = $mentor->applicant->user;
        }
        return response()->json($mentors);
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant du mentor
     * @return User
     */
    public function showOne($id)
    {
        if (!auth()->user()->hasPermissionTo('see_mentor')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentor = Mentor::findOrFail($id);
        $mentor = $mentor->applicant->user;
        return response()->json($mentor);
    }

    public function update($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('update_mentor')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentor = Mentor::findOrFail($id);
        $mentor->update($request->all());
        $mentor->applicant->update($request->all());
        $mentor->applicant->user->update($request->all());
        return response()->json($mentor, 200);
    }

    public function delete($id)
    {
        if (!auth()->user()->hasPermissionTo('delete_mentor')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        Mentor::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }

    public function getSkill($id)
    {
        if (!auth()->user()->hasPermissionTo('see_mentor_skills')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentor = Mentor::findOrFail($id);
        return response()->json($mentor->applicant->skills, 200);
    }

    public function setSkill($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('add_mentor_skill')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentor = Mentor::findOrFail($id);
        $mentor->applicant->skills()->attach($request->skill);
        return response()->json($mentor->applicant->skills, 200);
    }

    public function deleteSkill($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('delete_mentor_skill')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentor = Mentor::findOrFail($id);
        $mentor->applicant->skills()->detach($request->skill);
        return response()->json($mentor->applicant->skills, 200);
    }

    public function getArea($id)
    {
        if (!auth()->user()->hasPermissionTo('see_mentor_area')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentor = Mentor::findOrFail($id);
        return response()->json($mentor->applicant->areas, 200);
    }

    public function setArea($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('add_mentor_area')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentor = Mentor::findOrFail($id);
        $mentor->applicant->areas()->attach($request->area);
        return response()->json($mentor->applicant->areas, 200);
    }

    public function deleteArea($id, Request $request)
    {
        if (!auth()->user()->hasPermissionTo('delete_mentor_area')) {
            return response()->json(['Message' => "Action non-autorisée"], 401);
        }
        $mentor = Mentor::findOrFail($id);
        $mentor->applicant->areas()->detach($request->area);
        return response()->json($mentor->applicant->areas, 200);
    }
}
