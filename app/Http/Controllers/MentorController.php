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
        $mentor = Mentor::findOrFail($id);
        $mentor = $mentor->applicant->user;
        return response()->json($mentor);
    }

    public function update($id, Request $request)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->update($request->all());
        $mentor->applicant->update($request->all());
        $mentor->applicant->user->update($request->all());
        return response()->json($mentor, 200);
    }

    public function delete($id)
    {
        Mentor::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }

    public function getSkill($id)
    {
        $mentor = Mentor::findOrFail($id);
        return response()->json($mentor->applicant->skills, 200);
    }

    public function setSkill($id, Request $request)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->applicant->skills()->attach($request->skill);
        return response()->json($mentor->applicant->skills, 200);
    }

    public function deleteSkill($id, Request $request)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->applicant->skills()->detach($request->skill);
        return response()->json($mentor->applicant->skills, 200);
    }
}
